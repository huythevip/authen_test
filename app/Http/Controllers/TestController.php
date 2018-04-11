<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct() {
        $this->middleware('guest.manual');
    }

    public function about() {
        return view('pages.about');
    }
}
