<?php

namespace App\Http\Middleware;


use Closure;
use App\User;

class ManualAuth {

    public function handle($request, Closure $next)
    {   session_start();
        if ( isset($_SESSION['userSession']) ) {
            if ( User::where('email', '=', $_SESSION['userSession'])->count() > 0 ) {
                return redirect()->route('index');
            };

        }
        else {
            return $next($request);
        };
    }

}