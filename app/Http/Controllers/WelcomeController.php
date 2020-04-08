<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // use... 지금 쓰지 않으므로 지워도 된다.

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
