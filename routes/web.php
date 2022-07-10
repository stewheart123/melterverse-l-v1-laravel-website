<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/hello', function() {
    $usdc = "15";

    return view('hello' , compact('usdc'));
});

Route::get('/map-editor', function(){
    return view('web-gl');
});

Route::get('/news', function(){
    return view('news');
});

Route::get('/instructions', function(){
    return view('instructions');
});

Route::get('/wallet', function(){
    return view('user/wallet');
});

Route::get('/maps', function(){
    return view('user/maps');
});

Route::get('/friends', function(){
    return view('user/friends');
});

