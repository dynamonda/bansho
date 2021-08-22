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

        # /でviewsフォルダから参照するらしい
        return view('/debug/senddebug', compact('hello', 'tweets', 'users'));
    }

    public function add(Request $request)
    {
        // 登録する


        // 結果を返す
        $hello = "Add comment to 「" . $request->comment . "」";
        $tweets = Tweet::all();
        $users = User::all();

        return view('/debug/senddebug', compact('hello', 'tweets', 'users'));
    }

    public function result(Request $request)
    {
        $comment = $request->comment;
        $data = [
            'result' => '「' . $comment .'」と入力されました',
        ];

        return view('/debug/senddebug-result', $data);
    }
}
