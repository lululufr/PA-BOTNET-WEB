<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {

        $username = auth()->user()->prenom;
        $name = auth()->user()->nom;

        // Récupérer tous les utilisateurs
        $users = User::all();

        return view('users', ['username' => $username, 'name' => $name, 'users' => $users]);
    }
}
