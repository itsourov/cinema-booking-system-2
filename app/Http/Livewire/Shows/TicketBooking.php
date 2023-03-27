<?php

namespace App\Http\Livewire\Shows;

use App\Models\Ticket;
use Livewire\Component;

class TicketBooking extends Component
{

    public $show;
    public $seats = [];
    public $price = 0;


    protected $listeners = ['countPrice'];


    public function render()
    {
        return view('livewire.shows.ticket-booking');
    }

    public function countPrice()
    {

        $this->price = 0;
        foreach ($this->seats as $key => $seat) {
            $row = substr($seat, 0, 1);
            $col = substr($seat, 1, 2);
            $this->price += json_decode($this->show->seat)->$row->$col->price;
        }
    }
    public function makeTicket()
    {

        if (!auth()->user()) {
            return redirect()->route('login');
        }
        $seatNumbers = $this->seats;


        $ticket = Ticket::create([
            'seat_number' => $seatNumbers,
            'user_id' => auth()->user()->id,
            'show_id' => $this->show->id,
        ]);
        if ($ticket) {
            session()->flash('message', 'Redirecting to payment page');
            return redirect()->route('ticket.show', $ticket->id);
        }
    }
}
