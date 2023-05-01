<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateTicketRequest;
use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{

    //display a list of tickets from all users
    public function index()
    {
        $tickets = Ticket::latest()->paginate(10);
        $dateTime = Carbon::now()->toDateTimeString();
        return view('admin.tickets.index', [
            'tickets' => $tickets,
            'dateTime' => $dateTime,
        ]);
    }


    //show edit form of a specifiq ticket
    public function edit(Request $request, Ticket $ticket)
    {
        $dateTime = Carbon::now()->toDateTimeString();

        return view('admin.tickets.edit', [
            'ticket' => $ticket,
            'dateTime' => $dateTime,
        ]);
    }

    //update a ticket 
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());
        return redirect(route('admin.tickets.index'))->with('message', 'Ticket updated');
    }
}