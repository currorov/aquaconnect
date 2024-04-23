<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class IndexController extends Controller
{
    function uploadIndex() {
        session(["form_login" => "0"]);
        $arrayEvents = Event::all();

        return view('index')->with('events', $arrayEvents);
    }

    function activeLogin() {
        session(["form_login" => "1"]);

        $arrayEvents = Event::all();

        return view('index')->with('events', $arrayEvents);
    }

    function activeRegister() {
        session(["form_login" => "2"]);

        $arrayEvents = Event::all();

        return view('index')->with('events', $arrayEvents);
    }

    function checkLogin(Request $req) {
        $this->validate($req, [
            'usernameLogin' => 'required',
            'passwordLogin' => 'required'
        ]);

        $username = $req->usernameLogin;
        $password = $req->passwordLogin;
        if(auth::attempt(['name' => $username, 'password' => $password])) {
            $user = User::where('name', $username)->first();

            if($user->image != null) {
                session(['userImage' => $user->image]);
            }
            session(["form_login" => "0"]);

            return redirect()->route('index');
        }

        return back()->withErrors([
            "passwordLogin" => "Credenciales incorrectos"
        ])->onlyInput('passwordLogin');
    }

    function checkRegister(Request $req) {
        $this->validate($req, [
            'nameRegister' => 'required|regex:/^[a-zA-Z]+$/',
            'surnameRegister' => 'required|regex:/^[a-zA-Z]+$/',
            'usernameRegister' => 'required',
            'mailRegister' => 'required|email',
            'passwordRegister' => 'required|min:8',
            'ageRegister' => 'required|max:100',
            'imageRegister' => 'nullable|image',
        ]);        

        $emalRepeat = User::where("email", $req->mailRegister)->first();
        if(is_null($emalRepeat)){
            $username = $req->usernameRegister;
            $password = $req->passwordRegister;

            $user = new User();
            $user->name = $req->nameRegister;
            $user->surname = $req->surnameRegister;
            $user->email = $req->mailRegister;
            $user->age = $req->ageRegister;
            $user->password = bcrypt($req->passwordRegister);
            
            if ($req->hasFile('imageRegister')) {
                $image = $req->file('imageRegister'); 
                $imageData = base64_encode(file_get_contents($image));
            
                $user->image = $imageData;
            }
            
            $user->save();
            
            if(auth::attempt(['name' => $username, 'password' => $password])) {
                $band = User::where('name', $username)->first();
    
                session(['activeBand' => $band]);
                session(['bandname' => $band->bandname]);
    
                if($user->image != null) {
                    session(['userImage' => $user->image]);
                }
                session(["form_login" => "0"]);
    
                return redirect()->route('index');
            }
        } else {
            return back()->withErrors([
                "imageRegister" => "Email already exists"
            ])->withInput();
        }
    }
}
