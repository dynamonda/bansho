<?php

namespace App\Http\Controllers;

use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $result = $this->searchFromAPI($title);

        return view('/book/index', compact('title', 'result'));
    }

    public function searchFromAPI(string $title)
    {
        $api_key = config('myapp.rakuten_book_api_id');

        $searchUrl = 
            "https://app.rakuten.co.jp/services/api/BooksBook/Search/20170404?format=json&title=" .
            urlencode($title) . "&applicationId=" . $api_key;
        
        // curlを起動
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $searchUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response);
        return $result;
    }
}
