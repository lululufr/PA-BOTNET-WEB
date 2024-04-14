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
        $username = auth()->user()->firstname;
        $name = auth()->user()->lastname;


        // Récupérer tous les groupes depuis la base de données
        $groups = Network::all();
        return view('network', ['username' => $username, 'name' => $name, 'groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
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
        $network = new Network();
        $network->name = $request->name;
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
        $username = auth()->user()->firstname;
        $name = auth()->user()->lastname;
    
        $group = Network::findOrFail($id);
    
        // Modification ici pour utiliser la table intermédiaire
        $victims = Victims::join('victim_groups', 'victims.id', '=', 'victim_groups.victim_id')
                            ->where('victim_groups.group_id', $id)
                            ->select('victims.*') // Sélectionner toutes les colonnes de la table victims
                            ->get();
    
        return view('network.show', [
            'group' => $group, 
            'username' => $username, 
            'name' => $name, 
            'victims' => $victims
        ]);
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
