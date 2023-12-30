<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddNetwork;

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

        // Validation des données
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Traitement de l'image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName); 

        // Création de l'instance et enregistrement dans la base de données
        $network = new AddNetwork();
        $network->name = $request->name;
        $network->image = $imageName;
        $network->save();

        
        return redirect()->route('network')->with('success', 'Réseau créé avec succès.');


    }
}