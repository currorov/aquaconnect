<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UsersEvent;
use App\Models\Jetsky;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailRecoverPassword;



class IndexController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); 
    }

    function uploadIndex() {
        session(["form_login" => "0"]);
        $arrayEvents = Event::all();
        $arrayUserEvent = UsersEvent::all();
        $arrayJetsky = Jetsky::all();
        return view('index')->with('events', $arrayEvents)
                            ->with('userEvents', $arrayUserEvent)
                            ->with('jetskys', $arrayJetsky);
    }

    function activeLogin() {
        session(["form_login" => "1"]);

        $arrayEvents = Event::all();
        $arrayUserEvent = UsersEvent::all();
        $arrayJetsky = Jetsky::all();
        return view('index')->with('events', $arrayEvents)
                            ->with('userEvents', $arrayUserEvent)
                            ->with('jetskys', $arrayJetsky);
    }

    function activeRegister() {
        session(["form_login" => "2"]);

        $arrayEvents = Event::all();
        $arrayUserEvent = UsersEvent::all();
        $arrayJetsky = Jetsky::all();
        return view('index')->with('events', $arrayEvents)
                            ->with('userEvents', $arrayUserEvent)
                            ->with('jetskys', $arrayJetsky);
    }

    function recoverPassword() {
        session(["form_login" => "3"]);

        $arrayEvents = Event::all();
        $arrayUserEvent = UsersEvent::all();
        $arrayJetsky = Jetsky::all();
        return view('index')->with('events', $arrayEvents)
                            ->with('userEvents', $arrayUserEvent)
                            ->with('jetskys', $arrayJetsky);
    }

    function checkRecover(Request $req) {
        $this->validate($req, [
            'mail' => 'required|email',
        ]);

        $user = User::where("email", $req->mail)->first();
        if(!is_null($user)){
            $cadenaAleatoria = '';
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $numCaracteres = strlen($caracteres);
            
            for ($i = 0; $i < 10; $i++) {
                $caracterAleatorio = $caracteres[rand(0, $numCaracteres - 1)];
                $cadenaAleatoria .= $caracterAleatorio;
            }
        
            $user->password = bcrypt($cadenaAleatoria);
            
            $user->save();
            
            Mail::to($user->email)->send(new MailRecoverPassword($user, $cadenaAleatoria));

            return redirect()->route('index');
        } else {
            return back()->withErrors([
                "mail" => "Email no existe"
            ])->withInput();
        }
    }

    function checkLogin(Request $req) {
        $this->validate($req, [
            'usernameLogin' => 'required',
            'passwordLogin' => 'required'
        ]);

        $username = $req->usernameLogin;
        $password = $req->passwordLogin;
        if(auth::attempt(['username' => $username, 'password' => $password])) {
            $user = User::where('username', $username)->first();

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
            $user->username = $req->usernameRegister;
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
            
            if(auth::attempt(['username' => $username, 'password' => $password])) {
                $user = User::where('username', $username)->first();
    
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

    public function apuntaseAlEvento($eventId, $userId) {
        $usersEvent = new UsersEvent();
        $usersEvent->id_event = $eventId;
        $usersEvent->id_user = $userId;

        $usersEvent->save();

        $event = Event::where('id', $eventId)->first();

        $event->personas_apuntadas = $event->personas_apuntadas + 1;
        $event->save();
        return redirect()->route('index');
    }

    public function borrarDelEvento($eventId, $userId) {
        UsersEvent::where('id_event', $eventId)
              ->where('id_user', $userId)
              ->delete();
        
        $event = Event::where('id', $eventId)->first();

        $event->personas_apuntadas = $event->personas_apuntadas - 1;
        $event->save();
        return redirect()->route('index');
    }
}
