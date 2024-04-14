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

        return view('home', [
            'username' => $username,
            'name' => $name,
            'months' => json_encode($months), // Convertir en format JSON pour le script du graphique
            'userRegistrationCounts' => json_encode($userRegistrationCounts),
            'networkCount' => $networkCount,
        ]);
    }


    public function aide_botnet()
    {

    
            // Exécute la commande ipconfig et récupère le résultat dans $output
            exec('/home/debian/PA-BOTNET-PYSRV/venv/bin/python /home/debian/PA-BOTNET-PYSRV/main.py --help', $output, $return);
            // Convertit le tableau $output en une chaîne de caractères
            $outputString = implode("\n", $output);
        
            
            return redirect('/home')->with('output', $outputString);
        
    }



    public function start_botnet()
    {

    
            // Exécute la commande ipconfig et récupère le résultat dans $output
            exec('/home/debian/PA-BOTNET-WEB/launcher-python.sh', $output, $return);
            // Convertit le tableau $output en une chaîne de caractères
            $outputString = implode("\n", $output);
        
            
            return redirect('/home')->with('output', $outputString);
        
    }





}
