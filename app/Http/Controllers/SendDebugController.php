<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tweet;

class SendDebugController extends Controller
{
    public function index()
    {
        $hello = "Hello World, in SendDebug!";
        $tweets = Tweet::all();
        $users = User::all();

        return view('senddebug', compact('hello', 'tweets', 'users'));
    }

    public function result(Request $request)
    {
        $comment = $request->comment;
        $data = [
            'result' => '「' . $comment .'」と入力されました',
        ];
        
        return view('senddebug-result', $data);
    }
}
