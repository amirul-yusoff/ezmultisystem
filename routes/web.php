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
    return view('first-page'); 
});
Route::get('/categories', function () {
    return view('categories'); 
});
Route::get('/contact-us', function () {
    return view('contact-us'); 
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/first_page', [App\Http\Controllers\HomeController::class, 'first_page']);
Route::get('/second_page', [App\Http\Controllers\HomeController::class, 'second_page']);

Route::group(['middleware' => ['guest']], function() {
    
});