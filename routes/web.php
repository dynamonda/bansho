<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('hello', 'App\Http\Controllers\HelloController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/book', [App\Http\Controllers\BookController::class, 'index'])->name('book');
Route::post('/book/search', [App\Http\Controllers\BookController::class, 'search'])->name('book.search');
Route::get('/book/search/page', [App\Http\Controllers\BookController::class, 'searchPage'])->name('book.search.page');

Route::post('/book/ajax/add', [App\Http\Controllers\BookController::class, 'add'])->name('book.ajax.add');
Route::post('/book/ajax/delete', [App\Http\Controllers\BookController::class, 'delete'])->name('book.ajax.delete');

Route::get('/note', [App\Http\Controllers\NoteController::class, 'index'])->name('note');
Route::get('/note/{note_id}', [App\Http\Controllers\NoteController::class, 'show'])->name('note.show');

// Note Api
Route::get('/note/vue/{note_id}', [App\Http\Controllers\NoteController::class, 'getnote'])->name('note.vue.get');
Route::put('/note/vue/{note_id}', [App\Http\Controllers\NoteController::class, 'updatenote']);
Route::get('/note/vue/list/{user_id}', [App\Http\Controllers\NoteController::class, 'getNotes']);
Route::post('/note/vue/create', [App\Http\Controllers\NoteController::class, 'createNote']);
Route::post('/note/vue/delete/{note_id}', [App\Http\Controllers\NoteController::class, 'deleteNote']);

// SendDebug
/*
 *  Route::get('/send-debug', 'SendDebugController@index');
 *  これは古いバージョンの書き方
 */
Route::get('/debug/send-debug', [App\Http\Controllers\SendDebugController::class, 'index']);
Route::post('/debug/send-debug', [App\Http\Controllers\SendDebugController::class, 'add']);
