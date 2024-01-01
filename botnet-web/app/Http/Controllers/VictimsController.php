<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Victims;
use App\Models\Network;

class VictimsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = auth()->user()->prenom;
        $name = auth()->user()->nom;

        // Récupérer toutes les victimes qui n'ont pas de groupe
        $victims = Victims::where('groupe', null)->get();

        // Récupérer tous les groupes
        $groupes = Network::all();

        return view('victims', ['username' => $username, 'name' => $name, 'victims' => $victims, 'groupes' => $groupes]);
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
        $groupe = $request->input('groupe');

        // Attribuer le groupe à la victime
        $victim->groupe = $groupe;

        // Sauvegarder la victime
        $victim->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
