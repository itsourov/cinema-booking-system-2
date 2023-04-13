<?php

namespace App\Http\Controllers;

use App\Models\FoodOrder;
use Carbon\Carbon;
use App\Models\Show;
use App\Models\Ticket;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function ticketPayemtn(Request $request, Ticket $ticket)
    {

        $price = 0;
        $quantity = 1;
        if ($ticket->type == 'virtual') {
            $price = $ticket->show->virtual_ticket_price;
            $quantity = $ticket->qty;
        } else {
            foreach ($ticket->seat_number as $key => $seat) {
                $row = substr($seat, 0, 1);
                $col = substr($seat, 1, 2);
                $price += json_decode(Show::where('id', $ticket->show->id)->first()->seat)->$row->$col->price;
            }
        }

        $stripe = new \Stripe\StripeClient(config('services.stripe.skey'));

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'gbp',
                        'product_data' => [
                            'name' => json_encode($ticket->seat_number) . " for " . $ticket->show->title,
                        ],
                        'unit_amount' => $price * 100,
                    ],
                    'quantity' => $quantity,
                ]
            ],
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'customer_email' => auth()->user()->email,

            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('ticket.index'),
        ]);

        $ticket->update(['stripe_session_id' => $checkout_session->id]);
        return redirect($checkout_session->url);

    }

    public function successTicket(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.skey'));

        try {
            $session = $stripe->checkout->sessions->retrieve(
                $request->session_id,
                []
            );
            $ticket = Ticket::where('stripe_session_id', $session->id)->first();
            if (!$ticket) {
                throw new \Exception("No product found for this payment. Contact support with this id:" . $session->id, 404);

            } else {
                if ($ticket->type != 'virtual') {

                    foreach ($ticket->seat_number as $key => $seat) {
                        $row = substr($seat, 0, 1);
                        $col = substr($seat, 1, 2);

                        $json = json_decode(Show::where('id', $ticket->show->id)->first()->seat);

                        if ($json->$row->$col->status != 'available') {
                            return 'Ticket ' . $row . $col . ' is no longer available to book. we will refund you';
                        }

                        $json->$row->$col->status = "booked";
                        $json->$row->$col->user_id = auth()->user()->id;



                        Show::where('id', $ticket->show->id)->first()->update([
                            'seat' => json_encode($json),

                        ]);

                    }
                }


                $ticket->update([
                    'paid_amount' => $session->amount_total,
                    'payment_status' => $session->payment_status,
                    'payment_time' => Carbon::now()->toDateTimeString(),
                ]);
                auth()->user()->movies()->syncWithoutDetaching($ticket->show->movie->id);

                return redirect(route('ticket.index'))->with('message', 'Ticket Payment Done');
            }


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function FoodOrderpayment(Request $request, FoodOrder $foodOrder)
    {

        // return $foodOrder;

        $lineItemsData = [];
        foreach ($foodOrder->foods as $food) {

            $lineItemsData[] = [
                'price_data' => [
                    'currency' => 'gbp',
                    'product_data' => [
                        'name' => $food['name'],
                    ],
                    'unit_amount' => $food['price'] * 100,
                ],
                'quantity' => $food['qty'],
            ];
        }

        $stripe = new \Stripe\StripeClient(config('services.stripe.skey'));

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItemsData,
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'customer_email' => auth()->user()->email,

            'success_url' => route('stripe.food-order.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('food-order.index'),
        ]);

        $foodOrder->update(['stripe_session_id' => $checkout_session->id]);
        return redirect($checkout_session->url);
    }

    public function successFoodOrder(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.skey'));

        try {
            $session = $stripe->checkout->sessions->retrieve(
                $request->session_id,
                []
            );
            $foodOrder = FoodOrder::where('stripe_session_id', $session->id)->first();
            if (!$foodOrder) {
                throw new \Exception("No Food order found for this payment. Contact support with this id:" . $session->id, 404);

            } else {


                $foodOrder->update(['payment_status' => 'paid']);

                return redirect(route('food-order.show', $foodOrder->id))->with('message', 'Food order Payment Done');
            }


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}