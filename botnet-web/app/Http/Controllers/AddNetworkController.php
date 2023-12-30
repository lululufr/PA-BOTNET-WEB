<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddNetworkController extends Controller
{
    public function index()
    {
        $username = auth()->user()->prenom;
        $name = auth()->user()->nom;
        return view('addnetwork', ['username' => $username, 'name' => $name]);
    }

    public function addnetwork(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        return view('network');
    }
}