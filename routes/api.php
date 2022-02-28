<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post("login",[apiController::class,'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// view
// http://ezmultisystem/api/getUsers
Route::GET("getUsers",[apiController::class,'getUsers']);


// //push the Data into the Database
// http://ezmultisystem/api/getDataFromOutside
Route::POST("getDataFromOutside",[apiController::class,'getDataFromOutside']);
Route::POST("registerUser",[apiController::class,'registerUser']);
Route::POST("loginUser",[apiController::class,'loginUser']);




// //Update
// Route::PUT("")

// //Delete
// Route::DLETE("")
