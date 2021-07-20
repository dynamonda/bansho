<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// テスト用コントローラー
class HelloController extends Controller
{
    public function index()
    {
        $str_1 = 'Hello';
        $str_2 = 'World';

        // viewの第一引数でどのビューに渡すのか指定（以下はhelloビュー）
        return view('hello', compact('str_1', 'str_2'));
    }
}
