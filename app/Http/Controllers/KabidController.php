<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KabidController extends Controller
{
    public function dashboard()
    {
        return view('kabid.dashboard');
    }
}
