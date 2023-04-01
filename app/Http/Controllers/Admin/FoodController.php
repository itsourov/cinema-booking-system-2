<?php

namespace App\Http\Controllers\Admin;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::latest()->paginate(10);


        return view('admin.foods.index', [
            'foods' => $foods
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.foods.create');
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',

        ]);

        Food::create($validated);
        return redirect(route('admin.foods.index'))->with('message', 'Food Created');
    }


    public function edit(Food $food)
    {

        return view('admin.foods.edit', [
            'food' => $food,
        ]);
    }
    public function update(Food $food, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',

        ]);

        $food->update($validated);
        return redirect(route('admin.foods.index'))->with('message', 'Food Created');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return redirect(route('admin.foods.index'))->with('message', 'Food deleted');
    }
}
