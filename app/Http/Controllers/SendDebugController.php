<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendDebugController extends Controller
{
    public function index()
    {
        $hello = "Hello World, in SendDebug!";

        return view('senddebug', compact('hello'));
    }
}
