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

Route::get('/note', [App\Http\Controllers\NoteController::class, 'index'])->name('note');
Route::get('/note/{note_id}', [App\Http\Controllers\NoteController::class, 'show'])->name('note.show');

// Note Api
Route::get('/note/vue/{note_id}', [App\Http\Controllers\NoteController::class, 'getnote'])->name('note.vue.get');

// SendDebug
/* 
 *  Route::get('/send-debug', 'SendDebugController@index');
 *  これは古いバージョンの書き方
 */
Route::get('/debug/send-debug', [App\Http\Controllers\SendDebugController::class, 'index']);
Route::post('/debug/send-debug', [App\Http\Controllers\SendDebugController::class, 'add']);
