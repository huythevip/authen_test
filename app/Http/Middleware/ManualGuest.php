<?php

namespace App\Http\Middleware;


use Closure;
use App\User;

class ManualGuest {

    public function handle($request, Closure $next)
    {   session_start();
        $_SESSION['previous'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if ( isset($_SESSION['userSession']) ) {
            if ( User::where('email', '=', $_SESSION['userSession'])->count() > 0 ) {
                return $next($request);
            };

        }
        else {
        return redirect()->route('login.get');
        };
    }

}