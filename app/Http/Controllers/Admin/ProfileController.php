<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{

    // display profile info with ediable form
    public function index(): View
    {
        return view('admin.profile.index', [
            'user' => auth()->user(),
        ]);
    }
}