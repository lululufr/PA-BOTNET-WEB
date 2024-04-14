<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VictimGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Vérifier dans la table Victim_groups si la victime appartient déjà à un groupe, et récupérer toutes celles qui n'ont pas de groupe
        $victims = DB::table('victims')
            ->leftJoin('victim_groups', 'victims.id', '=', 'victim_groups.victim_id')
            ->whereNull('victim_groups.victim_id')
            ->select('victims.*')
            ->get();

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
