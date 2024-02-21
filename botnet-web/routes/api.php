<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('wdlst/{list}', [\App\Http\Controllers\ApiWordlist::class, 'receive']);
Route::get('mlw', [\App\Http\Controllers\ApiMlwController::class, 'malwdwn']);

Route::get('test', [\App\Http\Controllers\ApiWordlist::class, 'test']);

    //Route::get('/mlw', [\App\Http\Controllers\RegisterController::class, 'register']);


