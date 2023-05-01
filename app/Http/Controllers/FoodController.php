<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the food item.
     */
    public function index()
    {
        return view('food.index');
    }

    /**
     * Show the form for creating a new food item.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created food item in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        //
    }

    /**
     * Display the specified food item.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified food item.
     */
    public function edit(Food $food)
    {
        //
    }

    /**
     * Update the specified food item in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        //
    }

    /**
     * Remove the specified food item from storage.
     */
    public function destroy(Food $food)
    {
        //
    }
}