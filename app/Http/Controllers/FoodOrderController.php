<?php

namespace App\Http\Controllers;

use App\Models\FoodOrder;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreFoodOrderRequest;
use App\Http\Requests\UpdateFoodOrderRequest;

class FoodOrderController extends Controller
{
    /**
     * Display a listing of the food-order.
     */
    public function index()
    {
        return view('food-order.index', [
            'orders' => FoodOrder::paginate(10),

        ]);
    }

    /**
     * Show the form for creating a new food-order.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created food-order in storage.
     */
    public function store(StoreFoodOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified food-order.
     */
    public function show(FoodOrder $foodOrder)
    {
        return view('food-order.show', [
            'order' => $foodOrder,
        ]);
    }

    /**
     * Show the form for editing the specified food-order.
     */
    public function edit(FoodOrder $foodOrder)
    {
        //
    }

    /**
     * Update the specified food-order in storage.
     */
    public function cancel(Request $request, FoodOrder $foodOrder)
    {


        $foodOrder->update(['payment_status' => 'unpaid']);
        return back()->with('message', 'Food order cancled');
        //TODO: issue refund function

    }

    /**
     * Remove the specified food-order from storage.
     */
    public function destroy(FoodOrder $foodOrder)
    {
        $foodOrder->delete();
        return redirect(route('food-order.index'))->with('message', 'Food order Deleted');
    }
}