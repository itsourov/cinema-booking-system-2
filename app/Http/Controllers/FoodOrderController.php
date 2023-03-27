<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFoodOrderRequest;
use App\Http\Requests\UpdateFoodOrderRequest;
use App\Models\FoodOrder;

class FoodOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('food-order.index', [
            'orders' => FoodOrder::paginate(10),

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
    public function store(StoreFoodOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodOrder $foodOrder)
    {
        return view('food-order.show', [
            'order' => $foodOrder,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodOrder $foodOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodOrderRequest $request, FoodOrder $foodOrder)
    {

        if ($request->payment_status == 'paid') {
            $foodOrder->update($request->validated());
            return back()->with('message', 'Food order Payment Done');
        } else {
            $foodOrder->update($request->validated());
            return back()->with('message', 'Food order cancled');
            //TODO: issue refund function
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodOrder $foodOrder)
    {
        $foodOrder->delete();
        return redirect(route('food-order.index'))->with('message', 'Food order Deleted');
    }
}
