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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/hello', [App\Http\Controllers\HelloController::class,'index']);

Route::post('token', [App\Http\Controllers\MapToken::class, 'CreateMapToken']);

Route::get('/map-editor', function(){
    return view('web-gl');
});

Route::get('/map-editor-new', function(){
    return view('map-editor-section');
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

Route::get('/marketplace', [App\Http\Controllers\MarketplaceController::class,'index']);
Route::post('/addBlockPackToAccount', [App\Http\Controllers\MarketplaceController::class, 'store']);
// Route::get('/marketplace', function(){
//     return view('marketplace');
// });

Route::get('/upload', function(){
    return view('uploadfiles');
});

// Route::get('/uploadfile','UploadController@index');   
Route::get('/uploadfile', [App\Http\Controllers\UploadController::class, 'index']);
Route::post('/uploadfile', [App\Http\Controllers\UploadController::class, 'store']);