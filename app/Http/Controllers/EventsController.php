<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class EventsController extends Controller
{
    function createEvent() {
        return view('createEvent');
    }

    function submitCreateEvent(Request $req) {
        $this->validate($req, [
            'nombre' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
            'location' => 'required',
            'desc_ubi' => 'required',
            'desc_event' => 'required',
        ]);

        $event = new Event();
        $event->title = $req->nombre;
        $event->date = $req->fecha;
        $event->time = $req->hora;
        $event->location = $req->location;
        $event->desc_location = $req->desc_ubi;
        $event->desc_event = $req->desc_event;
        $event->personas_apuntadas = 1;
        $event->id_user = 1;
        $event->save();

        return view('index');
    }
}
