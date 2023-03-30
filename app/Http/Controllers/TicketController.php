<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Show;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dateTime =  Carbon::now()->toDateTimeString();
        $tickets =   Ticket::where('user_id', auth()->user()->id)->latest()->with('show')->paginate(10);
        return view('tickets.index', [
            'tickets' => $tickets,
            'dateTime' => $dateTime,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $price = 0;
        if ($ticket->type == 'virtual') {
            $price = $ticket->show->virtual_ticket_price * $ticket->qty;
        } else {
            foreach ($ticket->seat_number as $key => $seat) {
                $row = substr($seat, 0, 1);
                $col = substr($seat, 1, 2);
                $price += json_decode(Show::where('id', $ticket->show->id)->first()->seat)->$row->$col->price;
            }
        }



        $dateTime =  Carbon::now()->toDateTimeString();
        return view('tickets.payment', [
            'ticket' => $ticket,
            'dateTime' => $dateTime,
            'price' => $price,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        DB::beginTransaction();
        $ticket->update($request->validated());


        $price = 0;
        if ($ticket->type == 'virtual') {
            $price = $ticket->show->virtual_ticket_price * $ticket->qty;
        } else {
            foreach ($ticket->seat_number as $key => $seat) {
                $row = substr($seat, 0, 1);
                $col = substr($seat, 1, 2);
                $price += json_decode(Show::where('id', $ticket->show->id)->first()->seat)->$row->$col->price;
            }
        }

        if ($request->payment_status == 'paid') {


            if ($ticket->type != 'virtual') {

                foreach ($ticket->seat_number as $key => $seat) {
                    $row = substr($seat, 0, 1);
                    $col = substr($seat, 1, 2);

                    $json =   json_decode(Show::where('id', $ticket->show->id)->first()->seat);

                    if ($json->$row->$col->status != 'available') {
                        DB::rollBack();
                        return back()->with('message', 'Ticket ' . $row . $col . ' is no longer available to book');
                    }

                    $json->$row->$col->status = "booked";
                    $json->$row->$col->user_id = auth()->user()->id;



                    Show::where('id', $ticket->show->id)->first()->update([
                        'seat' => json_encode($json),

                    ]);
                }
            }

            $ticket->update([
                'paid_amount' => $price,
                'payment_time' => Carbon::now()->toDateTimeString(),
            ]);

            DB::commit();
            return back()->with('message', 'Ticket Payment Done');
        } else {
            if ($ticket->type != 'virtual') {
                foreach ($ticket->seat_number as $key => $seat) {
                    $row = substr($seat, 0, 1);
                    $col = substr($seat, 1, 2);

                    $json =   json_decode(Show::where('id', $ticket->show->id)->first()->seat);



                    if ($json->$row->$col->status != 'booked' || $json->$row->$col->user_id != auth()->user()->id) {
                        DB::rollBack();
                        return back()->with('message', 'Ticket ' . $row . $col . ' is invalid');
                    }
                    $json->$row->$col->status = "available";
                    $json->$row->$col->user_id = '';


                    Show::where('id', $ticket->show->id)->first()->update([
                        'seat' => json_encode($json),

                    ]);
                }
            }
            $ticket->update([
                'paid_amount' => null,
                'payment_time' => null,
            ]);
            DB::commit();
            return back()->with('message', 'Ticket Cancled ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('ticket.index'))->with('message', 'Ticket Deleted');
    }

    public function download(Ticket $ticket)
    {

        $ticket =  $ticket->loadMissing(['user', 'show.movie']);
        // return $ticket;
        $pdf = Pdf::loadView('tickets.pdf', [
            "data" => json_encode($ticket),
        ]);
        return $pdf->stream();
    }
    public function vr_show(Ticket $ticket)
    {
        return $ticket;
    }
}
