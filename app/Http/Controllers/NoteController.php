<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

use App\Models\Note;

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

    public function createNote(Request $request)
    {
        Log::debug('[createNote] 開始');

        $note = Note::create([
            'user_id' => Auth::id(),
            'title' => '新しいノート',
            'body' => '',
        ]);

        Log::debug('[createNote] 作成');

        $mess = [
            'note' => $note,
        ];

        return $mess;
    }

    private function getNoteData(int $note_id)
    {
        $note = Note::find($note_id);
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
        $notes = Note::whereUser_id($user_id)
            ->orderBy('updated_at', 'desc')
            ->get();

        return $notes;
    }
}
