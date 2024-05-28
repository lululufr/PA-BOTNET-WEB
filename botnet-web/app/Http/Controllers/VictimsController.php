<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Victims;
use App\Models\Network;
use App\Models\VictimGroup;

class VictimsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = auth()->user()->firtsname;
        $name = auth()->user()->lastname;
    
        $victims = Victims::doesntHave('victimGroups')->get();
    
        // Récupérer tous les groupes
        $groups = Network::all();
    
        return view('victims', ['username' => $username, 'name' => $name, 'victims' => $victims, 'groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        // Récupérer l'id de la victime
        $victim = Victims::find($id);
    
        // Récupérer l'id du groupe
        $groupId = $request->input('group'); // Assurez-vous que cela correspond au 'name' dans le <select>
    
        // Créer une nouvelle association dans victim_groups
        $victimGroup = new VictimGroup();
        $victimGroup->victim_id = $victim->id;
        $victimGroup->group_id = $groupId;
        $victimGroup->save();
    
        return redirect()->route('victims.index')->with('success', 'Victime ajoutée au groupe avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
