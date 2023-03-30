<?php

namespace App\Http\Livewire\Shows;

use App\Models\Ticket;
use Livewire\Component;

class TicketBooking extends Component
{

    public $show;
    public $seats = [];
    public $price = 0;
    public $seatType = 'physical';
    public $virtualSeatQty = 0;


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
            'qty' => count($seatNumbers),
        ]);

        foreach ($this->show->movie->genres as $genre) {
            auth()->user()->genres()->syncWithoutDetaching($genre->id);
        }
        auth()->user()->movies()->syncWithoutDetaching($this->show->movie->id);
        if ($ticket) {
            session()->flash('message', 'Redirecting to payment page');
            return redirect()->route('ticket.show', $ticket->id);
        }
    }

    public  function makeVirtualTicket()
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $ticket = Ticket::create([
            'seat_number' => 'virtual seat',
            'type' => 'virtual',
            'qty' => $this->virtualSeatQty,
            'user_id' => auth()->user()->id,
            'show_id' => $this->show->id,
        ]);
        foreach ($this->show->movie->genres as $genre) {
            auth()->user()->genres()->syncWithoutDetaching($genre->id);
        }
        auth()->user()->movies()->syncWithoutDetaching($this->show->movie->id);
        if ($ticket) {
            session()->flash('message', 'Redirecting to payment page');
            return redirect()->route('ticket.show', $ticket->id);
        }
    }
    public function add()
    {
        $this->virtualSeatQty++;

        $this->price = ($this->show->virtual_ticket_price * $this->virtualSeatQty);
    }
    public function subtract()
    {
        if ($this->virtualSeatQty > 0) {
            $this->virtualSeatQty--;
        }
    }
}
