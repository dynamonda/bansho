<?php

namespace App\Http\Controllers;

use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Book;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = $this->getLoginUser();
        $books = $user->books;

        return view('/book/index', compact('books'));
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
        $data = $request->get('data');
        $data = json_decode($data);

        // 本がbooksテーブルに存在しなければ、挿入する
        Log::debug('data=' . print_r($data, true));

        $isExist = $this->existBook($data);
        $book = null;

        if ($isExist) {
            Log::debug('bookExist=true');

            $book = $this->findBook($data->isbn);
            Log::debug('  title=' . $book->title);
            Log::debug('  isbn=' . $book->isbn);
            Log::debug('  data=' . print_r($book->detail, true));
        } else {
            Log::debug('bookExist=false');

            $book = new Book();
            $book->title = $data->title;
            $book->author = $data->author;
            $book->isbn = $data->isbn;
            $book->detail = $data;

            // 保存
            $book->save();
        }

        // books_users中間テーブルに挿入する
        $user = $this->getLoginUser();
        $this->tryRegist($user, $book);

        return $data->isbn;
    }

    /**
     * ajax消去用
     */
    public function delete(Request $request)
    {
        $isbn = $request->get('isbn');
        
        Log::debug('delete isb=' . $isbn);

        // @todo; 結合テーブルから削除
    }

    /**
     * 現在ログイン中のユーザーを返す
     */
    private function getLoginUser(): User
    {
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();

        return $user;
    }

    /**
     * APIを利用して書籍検索を行う
     *
     * @param string $title 本のタイトル
     * @param int $page ページ数（指定しない場合は-1を入力）
     * @return 検索結果
    */
    private function searchFromAPI(string $title, int $page)
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
    private function checkHaveBooks(object $data)
    {
        $user = $this->getLoginUser();
        foreach ($data->Items as $item) {
            $book = $this->findBook($item->Item->isbn);

            if ($book === null) {
                $item->Item->is_have = false;
            } else {
                $item->Item->is_have = $this->isHaveBook($user, $book);
            }
        }

        return $data;
    }

    /**
     * DBに本が登録済みか？
     */
    private function existBook(object $book): bool
    {
        return DB::table('books')->where('isbn', $book->isbn)->exists();
    }

    /**
     * userはbookを持っているか？
     */
    private function isHaveBook(User $user, Book $book): bool
    {
        return DB::table('books_users')
            ->where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->exists();
    }

    /**
     * books_usersに登録済みか？
     *
     * @return DBに追加したか？
     */
    private function tryRegist(User $user, Book $book): bool
    {
        $isHave = $this->isHaveBook($user, $book);

        if ($isHave === false) {
            $isInsert = DB::table('books_users')->insert([
                'book_id' => $book->id,
                'user_id' => $user->id
            ]);

            if ($isInsert) {
                Log::debug('[BookController.tryRegist] 新しく登録しました');
            } else {
                Log::debug('[BookController.tryRegist] 登録に失敗しました');
            }

            return $isInsert;
        } else {
            Log::debug('[BookController.tryRegist] 既に登録済みです');
        }

        return false;
    }

    /**
     * DBからBookを取得する
     * 
     * @return Bookもしくはnull
     */
    private function findBook(string $isbn): ?Book
    {
        return Book::where('isbn', $isbn)->first();
    }
}
