<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
class AuthController extends Controller
{
    public function getLoginForm() {
        if ( Session::get('authenticated') == true ){

            Session::flash('messageSuccess', 'You\'re logged in!');
            return redirect()->route('index');
        };
        return view('auth.login');
    }

    public function getRegistrationForm() {
        return view('auth.register');
    }

    public function postRegister(request $request) {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6|max:60'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = md5($request->password);
        $user->save();

        $subPassword = substr(md5($request->password), 0, 5);
        $base64Password = base64_encode($subPassword);
        setcookie('AuthenCookie',$base64Password);

        Session::flash('messageSuccess', 'Successfully registered new user!');
        return redirect()->route('home');
    }

    public function login(request $request) {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

            session_start();
            $user = User::where('email', '=', $request->email)->first();
            $encryptInputPassword = md5($request->password);

            if ( $encryptInputPassword == $user->password ) {
                Session::put('authenticated', true);
                Session::flash('messageSuccess', 'You\'re logged in!');
                return redirect()->route('index');
            }
            else {
                Session::flash('messageFail', 'Incorrect email or password');
                return redirect()->route('login.get');
            }

        }

    public function logout() {
        Session::put('authenticated', false);
        return redirect()->route('home');
    }


    }


