<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::id();
        $user = Auth::user();
        $profile = \App\Models\Profile::whereUser_id($user_id)->get()[0];

        return view('note', compact('user_id', 'user', 'profile'));
    }
}
