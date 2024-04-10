<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class IndexController extends Controller
{
    function uploadIndex() {
        $arrayEvents = Event::all();

        return view('index')->with('events', $arrayEvents);
    }
}
