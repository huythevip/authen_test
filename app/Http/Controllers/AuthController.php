<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Session;
class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth.manual')->except(['logout']);
    }

    public function getLoginForm() {
        return view('auth.login');
    }

    public function login(request $request) {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        //Use inputted email and couldn't find that email in db:
        if ( User::where('email', '=', $request->email)->count() == 0 ) {
            Session::flash('messageFail', 'Incorrect username or password');
            return redirect()->route('login.get');
        }
        //Found email in db:
        else{
            $user = User::where('email', '=', $request->email)->first();
        };
        $encryptInputPassword = Hash::make($request->password);
        if ( $user->password == $encryptInputPassword ) {
            if ( !$user->activated ) {
                Session::flash('messageFail', 'You have not activated your account! Please check your email!');
                return redirect()->route('login.get');
            }
            else {
                $_SESSION['userSession'] = $user->email;
            };
            if ( $request->remember ) {
                $encryptCookie = base64_encode('devstic'.base64_encode('huy'.$user->email));
                setcookie('rememberToken', $encryptCookie, time() + 60*60*24*30);
            };


            if ( isset( $_SESSION['previous'] )) {
                return redirect($_SESSION['previous']);
            } else {
              return redirect()->route('index');
            };

        }
        else {
            Session::flash('messageFail', 'Incorrect username or password');
            return redirect()->route('login.get');

        };

        }

    public function logout() {
        setcookie('rememberToken');
        session_start();
        session_destroy();
        return redirect()->route('home');
    }
}


