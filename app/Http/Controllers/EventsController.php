<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    function createEvent() {
        return view('createEvent');
    }
}
