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
        $notes = \App\Models\Note::whereUser_id($user_id)->get();

        return view('/note/index', compact('user_id', 'user', 'profile', 'notes'));
    }

    public function show(Request $request, int $note_id)
    {
        $user_id = Auth::id();
        $user = Auth::user();
        $profile = \App\Models\Profile::whereUser_id($user_id)->get()[0];
        $notes = \App\Models\Note::whereUser_id($user_id)->get();

        $selected_note = \App\Models\Note::find($note_id);

        return view('/note/show', compact('user_id', 'user', 'profile', 'notes', 'selected_note'));
    }


    public function getnote(int $note_id)
    {
        $note = \App\Models\Note::find($note_id);

        return $note;
    }
}
