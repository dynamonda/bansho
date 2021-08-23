<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('/book/index');
    }

    public function search(Request $request)
    {
        $title = $request->get('bookTitle');

        return view('/book/index', compact('title'));
    }
}
