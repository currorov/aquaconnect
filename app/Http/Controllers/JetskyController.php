<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jetsky;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\JetskyInfoMail;
use Illuminate\Support\Facades\Mail;


class JetskyController extends Controller
{
    function addJetsky() {
        return view('addJetsky');
    }

    function submitAddJetsky(Request $req) {
        $this->validate($req, [
            'marca' => 'required',
            'modelo' => 'required',
            'fecha' => 'required',
            'hora' => 'required|numeric',
            'descripcion' => 'required',
            'image' => 'required|image',
            'matricula' => 'required',
        ]);
        $matriRepeat = Jetsky::where("matricula", $req->matricula)->first();
        if(is_null($matriRepeat)){
            $jetsky = new Jetsky();
            $jetsky->brand = $req->marca;
            $jetsky->model = $req->modelo;
            $jetsky->date = $req->fecha;
            $jetsky->hours = $req->hora;
            $jetsky->description = $req->descripcion;
            $jetsky->matricula = $req->matricula;
            $jetsky->user_id = Auth::id();

            if ($req->hasFile('image')) {
                $image = $req->file('image'); 
                $imageData = base64_encode(file_get_contents($image));
            
                $jetsky->image = $imageData;
            }

            $jetsky->save();

            return redirect()->route('index');
        } else {
            return back()->withErrors([
                "image" => "Ya existe una moto de agua con esta matrícula"
            ])->withInput();
        }

    }

    function deleteJetsky($id) {
        $jetsky = Jetsky::find($id);

        $jetsky->delete();
        return redirect()->route('index');
        
    }

    function infoJetsky($id) {
        $id_user = Auth::id();
        $jetsky = Jetsky::find($id);
        $user = User::find($id_user);
        $userJetsky = User::find($jetsky->user_id);

        if ($jetsky && $user) {
            Mail::to($user->email)->send(new JetskyInfoMail($user, $userJetsky, $jetsky));
            
            return redirect()->route('index');
        } else {
            return redirect()->route('index');
        }
    }
    
}
