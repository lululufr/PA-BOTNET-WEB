<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

#Route pour afficher la page de connexion
Route::get('/', [\App\Http\Controllers\LoginController::class, 'index']);

#Route pour se connecter
Route::post('/', [\App\Http\Controllers\LoginController::class, 'login']);

#Route pour afficher la page de d'inscription
Route::get('register', [\App\Http\Controllers\RegisterController::class, 'index']);

#Route pour enregistrer les données du formulaire d'inscription
Route::post('register', [\App\Http\Controllers\RegisterController::class, 'register']);

// Middleware 'auth' ajouté pour protéger les routes nécessitant une authentification
Route::middleware(['auth'])->group(function () {
    Route::get('home', [\App\Http\Controllers\HomeController::class, 'index']);
    Route::get('users', [\App\Http\Controllers\UsersController::class, 'index']);
    Route::get('stats', [\App\Http\Controllers\StatsController::class, 'index']);
    Route::post('network', [\App\Http\Controllers\NetworkController::class, 'create']);
    Route::get('network', [\App\Http\Controllers\NetworkController::class, 'index'])->name('network');
    Route::get('network/{id}', [\App\Http\Controllers\NetworkController::class, 'show'])->name('network.show');
    Route::delete('network/{id}', [NetworkController::class, 'destroy'])->name('network.destroy');

});