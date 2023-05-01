<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodOrder;
use Illuminate\Http\Request;

class FoodOrderController extends Controller
{
    /**
     * show a list of food orders
     */
    public function index()
    {
        $orders = FoodOrder::latest()->paginate(10);
        return view('admin.food-order.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * update status of a specifiq food order
     */
    public function update(Request $request, FoodOrder $foodOrder)
    {
        $validated = $request->validate([
            'order_status' => 'required',


        ]);

        $foodOrder->update($validated);
        return redirect(route('admin.fo.index'))->with('message', 'Food Created');
    }
}