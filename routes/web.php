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
Route::get('/', function () {
    return view('dashboard'); 
});
Route::get('/categories', function () {
    return view('categories'); 
});
Route::get('/contact-us', function () {
    return view('contact-us'); 
});
Route::get('/first-page', function () {
    return view('first-page'); 
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\contactUsController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/', [App\Http\Controllers\contactUsController::class, 'index']); 
Route::get('/first_page', [App\Http\Controllers\HomeController::class, 'first_page']);
Route::get('/second_page', [App\Http\Controllers\HomeController::class, 'second_page']);

// Profile
Route::get('/profile/index', [App\Http\Controllers\ProfileController::class, 'index']);
Route::get('/profile/view', [App\Http\Controllers\ProfileController::class, 'view']);

// Members
// Admin Members
Route::get('/admin-members', [App\Http\Controllers\AdminMembersController::class, 'index']);
Route::get('/admin-members/edit', [App\Http\Controllers\AdminMembersController::class, 'edit']);

// Restaurants Members
Route::get('/restaurants-members', [App\Http\Controllers\RestaurantsMembersController::class, 'index']);

// Riders Members
Route::get('/riders-members', [App\Http\Controllers\RidersMembersController::class, 'index']);


Route::group(['middleware' => ['guest']], function() {
    
});

Route::get('/email', [App\Http\Controllers\EmailController::class, 'create']);
Route::post('/email', [App\Http\Controllers\EmailController::class, 'sendEmail'])->name('send.email');