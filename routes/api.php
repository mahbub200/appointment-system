<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/doctors/today', 'FrontendController@doctorToday');
Route::get('/doctors/today', [App\Http\Controllers\FrontendController::class,'doctorToday']);

//Route::post('/finddoctors', 'FrontendController@findDoctors');
//Route::post('/finddoctors', [App\Http\Controllers\FrontendController::class,'findDoctors']);
