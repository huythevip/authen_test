<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class PagesController extends Controller
{

    public function home() {

        if ( isset( $_COOKIE['rememberToken'] ) ) {
            $cookieValue = $_COOKIE['rememberToken'];
            $decryptEmail_1 = substr(base64_decode($cookieValue), 7);
            $decryptEmail_2 = substr(base64_decode($decryptEmail_1), 3);
            if ( User::where('email', '=', $decryptEmail_2)->count() > 0 ) {
                session_start();
                $_SESSION['userSession'] = $decryptEmail_2;
            };
        };

        return view('pages.welcome');

    }

    public function index() {
        return view('pages.index');
    }

}
