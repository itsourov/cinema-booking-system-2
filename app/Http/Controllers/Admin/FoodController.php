<?php

namespace App\Http\Controllers\Admin;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    /**
     * Display a listing of the foods.
     */
    public function index()
    {
        $foods = Food::latest()->paginate(10);


        return view('admin.foods.index', [
            'foods' => $foods
        ]);
    }


    /**
     * Show the form for creating a new food.
     */
    public function create()
    {

        return view('admin.foods.create');
    }

    /**
     * process request from create form and then create a new food item
     */
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

    /**
     * Show the form for editing a existing food.
     */
    public function edit(Food $food)
    {

        return view('admin.foods.edit', [
            'food' => $food,
        ]);
    }

    /**
     * process request from edit form and then update the info
     */
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
     * Remove the specified food from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return redirect(route('admin.foods.index'))->with('message', 'Food deleted');
    }
}