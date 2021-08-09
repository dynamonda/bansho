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

// SendDebug
/* 
 *  Route::get('/send-debug', 'SendDebugController@index');
 *  これは古いバージョンの書き方
 */
Route::get('/send-debug', [App\Http\Controllers\SendDebugController::class, 'index']);