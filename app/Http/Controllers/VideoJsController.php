<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoJsController extends Controller
{

    //show the video player
    public function view()
    {
        return view('video-js.view');
    }
}