<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\UsersEvent;
use Illuminate\Support\Facades\Auth;


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
        $event->personas_apuntadas = 0;
        $event->id_user = Auth::id();
        $event->save();

        return redirect()->route('index');
    }

    function miseventos($userId) {
        session(["form_login" => "0"]);
        $arrayEvents = Event::where('id_user', $userId)->get();

        return view('index')->with('events', $arrayEvents);
    }

    function eventosapuntado($userId) {
        session(["form_login" => "0"]);
        $idEvents = UsersEvent::where('id_user', $userId)->pluck('id_event');
        $arrayEvents = Event::whereIn('id', $idEvents)->get();

        return view('index')->with('events', $arrayEvents);
    }
}
