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

#Route pour afficher la page d'accueil
Route::get('home', [\App\Http\Controllers\HomeController::class, 'index']);

#Route pour afficher la page des utilisateurs
Route::get('users', [\App\Http\Controllers\UsersController::class, 'index']);

#Route pour afficher la page des stats
Route::get('stats', [\App\Http\Controllers\StatsController::class, 'index']);

#Route pour afficher la page d'ajout d'un réseau
Route::get('addnetwork', [\App\Http\Controllers\AddNetworkController::class, 'index']);

#Route pour ajouter un nouveau réseau
Route::post('addnetwork', [\App\Http\Controllers\AddNetworkController::class, 'addnetwork']);

#Route pour afficher la de tous les réseaux
Route::get('network', [\App\Http\Controllers\NetworkController::class, 'index']);