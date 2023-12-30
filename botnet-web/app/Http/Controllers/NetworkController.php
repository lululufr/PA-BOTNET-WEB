<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Network;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = auth()->user()->prenom;
        $name = auth()->user()->nom;
        return view('network', ['username' => $username, 'name' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Traitement de l'image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName); 

        // Création de l'instance et enregistrement dans la base de données
        $network = new Network();
        $network->nom = $request->nom;
        $network->image = $imageName;
        $network->save();

        
        return redirect()->route('network')->with('success', 'Réseau créé avec succès.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
