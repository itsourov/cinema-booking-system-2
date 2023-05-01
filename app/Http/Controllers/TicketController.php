<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Show;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the ticket.
     */
    public function index()
    {
        $dateTime = Carbon::now()->toDateTimeString();
        $tickets = Ticket::where('user_id', auth()->user()->id)->latest()->with('show')->paginate(10);
        return view('tickets.index', [
            'tickets' => $tickets,
            'dateTime' => $dateTime,
        ]);
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified ticket.
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



        $dateTime = Carbon::now()->toDateTimeString();
        return view('tickets.payment', [
            'ticket' => $ticket,
            'dateTime' => $dateTime,
            'price' => $price,
        ]);
    }

    /**
     * Show the form for editing the specified ticket.
     */
    public function edit(Ticket $ticket)
    {
    }

    /**
     * Update the specified ticket in storage.
     */
    public function cancel(Request $request, Ticket $ticket)
    {
        DB::beginTransaction();



        if ($ticket->type != 'virtual') {
            foreach ($ticket->seat_number as $key => $seat) {
                $row = substr($seat, 0, 1);
                $col = substr($seat, 1, 2);

                $json = json_decode(Show::where('id', $ticket->show->id)->first()->seat);



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
            'payment_status' => 'unpaid',
        ]);
        auth()->user()->movies()->detach($ticket->show->movie->id);
        DB::commit();
        return back()->with('message', 'Ticket Cancled ');

    }

    /**
     * Remove the specified ticket from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('ticket.index'))->with('message', 'Ticket Deleted');
    }

    public function download(Ticket $ticket)
    {

        $ticket = $ticket->loadMissing(['user', 'show.movie']);
        // return $ticket;
        $pdf = Pdf::loadView('tickets.pdf', [
            "data" => json_encode($ticket),
        ]);
        return $pdf->stream();
    }
    public function vr_show(Ticket $ticket)
    {
        if ($ticket->type != 'virtual') {
            return back()->with('message', 'Permission denied');
        }
        return view('tickets.vr-show', [
            'ticket' => $ticket,
        ]);
    }
}