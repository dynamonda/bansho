<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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
        $notes = $this->getNotes($user_id);

        return view('/note/index', compact('user_id', 'user', 'notes'));
    }

    public function show(Request $request, int $note_id)
    {
        $user_id = Auth::id();
        $user = Auth::user();
        $notes = $this->getNotes($user_id);
        $selected_note = $this->getNoteData($note_id);

        return view('/note/show', compact('user_id', 'user', 'notes', 'selected_note'));
    }

    // =========
    // Vue用

    public function getnote(int $note_id)
    {
        $note = $this->getNoteData($note_id);

        $data = [
            'note' => $note,
            'body' => json_decode($note->body),
        ];

        return $data;
    }

    public function updatenote(Request $request, $note_id)
    {
        $data = $request->get('data');
        $body = $data['body'];
        $title = $data['title'];

        $note = $this->getNoteData($note_id);

        $encoded = json_encode($body);
        $note->body = $encoded;
        $note->title = $title;
        $note->update();

        $mess = [
            'data' => $data,
            'note' => $note,
            'title' => $data['title']
        ];

        return $mess;
    }

    private function getNoteData(int $note_id)
    {
        $note = \App\Models\Note::find($note_id);
        return $note;
    }

    /**
     * ユーザーのNoteを取得する
     * 
     * vueからも呼び出しされている
     * Todo: 後で分割予定
     */
    public function getNotes(int $user_id)
    {
        $notes = \App\Models\Note::whereUser_id($user_id)
            ->orderBy('updated_at', 'desc')
            ->get();

        return $notes;
    }
}
