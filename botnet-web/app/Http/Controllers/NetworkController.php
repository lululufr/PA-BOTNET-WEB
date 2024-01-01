<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Network;
use App\Models\Victims;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = auth()->user()->prenom;
        $name = auth()->user()->nom;


        // Récupérer tous les groupes depuis la base de données
        $groupes = Network::all();
        return view('network', ['username' => $username, 'name' => $name, 'groupes' => $groupes]);
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
    public function show($id)
    {
        $username = auth()->user()->prenom;
        $name = auth()->user()->nom;

        $groupe = Network::findOrFail($id);

        $victims = Victims::where('groupe', $id)->get();

        return view('network.show', ['groupe' => $groupe, 'username' => $username, 'name' => $name, 'victims' => $victims]);
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
        // Trouver le réseau par son ID
        $network = Network::findOrFail($id);

        // Supprimer l'image associée (si elle existe)
        if (file_exists(public_path('images/' . $network->image))) {
            unlink(public_path('images/' . $network->image));
        }
       
        // Supprimer le réseau de la base de données
        $network->delete();
       
        return redirect()->route('network')->with('success', 'Réseau supprimé avec succès.');
    }
}
