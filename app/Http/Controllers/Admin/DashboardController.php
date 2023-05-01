<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{

    // show dashboard. haven't figured it out what to put here.
    public function index(): View
    {
        return view('admin.dashboard');
    }
}