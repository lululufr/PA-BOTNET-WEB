<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $formFields = $request->validate([
            'nom'=> 'required|min:2',
            'prenom'=> 'required|min:2',
            'email'=> 'required',
            'password'=> 'required|min:6'
        ]);

        //create user
        $user = new User();
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
//
        $user->email = $request->input('email');
        $user->password = bcrypt($formFields['password']);
//
        //$user->verify_token = rand(100000,999999);

        $user->save();

        return redirect('/')->with('success', 'Votre compte a bien été créé !');
    }

}
