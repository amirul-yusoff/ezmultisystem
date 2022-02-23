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

// Route::get('/', function () {
//     return view('first-page'); 
// });
// Route::get('/', function () {
//     return view('dashboard'); 
// });
// Route::get('/categories', function () {
//     return view('categories'); 
// });
// Route::get('/contact-us', function () {
//     return view('contact-us'); 
// });
// Route::get('/first-page', function () {
//     return view('first-page'); 
// });

Auth::routes();

//diffrent from resouce

// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/first_page', [App\Http\Controllers\HomeController::class, 'first_page']);
Route::get('/second_page', [App\Http\Controllers\HomeController::class, 'second_page']);

//contact-us
Route::get('/contact-us', [App\Http\Controllers\contactUsController::class, 'index'])->name('contact-us');

//Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// dashboardController
Route::get('/dashboard', [App\Http\Controllers\dashboardController::class, 'index'])->name('dashboard');

// Profile
Route::get('/profile/index', [App\Http\Controllers\ProfileController::class, 'index']);
Route::get('/profile/view', [App\Http\Controllers\ProfileController::class, 'view']);

// -----------------------------------------------------------------------Members-----------------------------------------------------------------------
// Admin Members
Route::get('/admin-members', [App\Http\Controllers\AdminMembersController::class, 'index']);
Route::get('/admin-members/view/{id}', [App\Http\Controllers\AdminMembersController::class, 'view'])->name('admin-members.view');
Route::get('/admin-members/edit/{id}', [App\Http\Controllers\AdminMembersController::class, 'edit'])->name('admin-members.edit');
Route::PUT('/admin-members/update/{id}', [App\Http\Controllers\AdminMembersController::class, 'update'])->name('admin-members.update');
Route::PUT('/admin-members/upload/{id}', [App\Http\Controllers\AdminMembersController::class, 'upload'])->name('admin-members.upload');

// Restaurants Members
Route::get('/restaurants-members', [App\Http\Controllers\RestaurantsMembersController::class, 'index']);

// Riders Members
Route::get('/riders-members', [App\Http\Controllers\RidersMembersController::class, 'index']);

//-----------------------------------------------------------------Permission Management-----------------------------------------------------------------
Route::get('/permission-management', [App\Http\Controllers\PermissionManagementController::class, 'index']);
Route::get('/permission-management/show/{id}', [App\Http\Controllers\PermissionManagementController::class, 'show'])->name('permission-management.show');
Route::get('/permission-management/edit/{id}', [App\Http\Controllers\PermissionManagementController::class, 'edit'])->name('permission-management.edit');

//Roles
Route::get('/roles', [App\Http\Controllers\RolesController::class, 'index']);

//Permissions
Route::get('/permissions', [App\Http\Controllers\PermissionsController::class, 'index']);

Route::group(['middleware' => ['guest']], function() {
});

Route::get('/email', [App\Http\Controllers\EmailController::class, 'create']);
Route::post('/email', [App\Http\Controllers\EmailController::class, 'sendEmail'])->name('send.email');