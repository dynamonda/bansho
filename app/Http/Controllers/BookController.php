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
        $result = $this->searchFromAPI($title, -1);

        return view('/book/index', compact('title', 'result'));
    }

    public function searchPage(Request $request)
    {
        $title = $request->get('bookTitle');
        $page = $request->get('page');
        $result = $this->searchFromAPI($title, $page);

        return view('/book/index', compact('title', 'result'));
    }

    /**
     * ajax登録用
     */
    public function add(Request $request)
    {
        $isbn = $request->get('isbn');

        return $isbn;
    }

    /**
     * APIを利用して書籍検索を行う
     *
     * @param string $title 本のタイトル
     * @param int $page ページ数（指定しない場合は-1を入力）
     * @return 検索結果
    */
    public function searchFromAPI(string $title, int $page)
    {
        $api_key = config('myapp.rakuten_book_api_id');

        $searchUrl =
            "https://app.rakuten.co.jp/services/api/BooksBook/Search/20170404?format=json&title=" .
            urlencode($title) .
            "&applicationId=" . $api_key;

        // ページ指定を追加
        if ($page > -1) {
            $searchUrl .= "&page=" . $page;
        }

        // curlを起動
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $searchUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response);

        // 本を持っているかどうかを調べる
        $result = $this->checkHaveBooks($result);

        return $result;
    }

    /**
     * 本をもっているかどうかを調べ、結果をobjectに追加する
     */
    public function checkHaveBooks(object $data)
    {
        foreach ($data->Items as $item)
        {
            $item->is_have = false;
        }

        return $data;
    }
}
