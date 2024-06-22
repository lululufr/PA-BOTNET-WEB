<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotnetController extends Controller
{

    function parseCommandOutput($output) {
        $options = [];
        $option_regex = "/(\-\-?\w+(?: \w+)?(?: \[.*?\])?(?: \| \-\-?\w+(?: \w+)?(?: \[.*?\])?)?)\s{2,}(.+)/";

        foreach ($output as $line) {
            if (preg_match($option_regex, $line, $matches)) {
                $flag = trim($matches[1]);
                $description = trim($matches[2]);
                $options[$flag] = $description;
            }
        }
        return $options;
    }

    public function aide_botnet(){
        $path = env('PATH_PYTHON_EXECUTABLE');

        // Exécute la commande ipconfig et récupère le résultat dans $output
        exec($path.'PA-BOTNET-PYSRV/venv/bin/python '.$path.'PA-BOTNET-PYSRV/main.py --help', $output, $return);

        // Appelle la fonction pour parser la sortie de la commande
        $output_propre = $this->parseCommandOutput($output);

        return redirect('/home')->with('output', $output_propre);

    }

    public function start_botnet(Request $request)
    {

        $path = env('PATH_PYTHON_EXECUTABLE');

        // Récupérer le port du formulaire
        $port = $request->input('port');

        // Validation basique pour s'assurer que le port est un entier et dans la plage adéquate
        if (!is_numeric($port) || $port < 1023 || $port > 65535) {
            return redirect('/home')->with('output', "Port invalide. Choisissez un port entre 1023 et 65535.");
        }


        // Commande pour activer l'environnement virtuel et démarrer le serveur Python avec le port spécifié
        $command = "nohup ".$path."PA-BOTNET-PYSRV/venv/bin/python3 ".$path."PA-BOTNET-PYSRV/main.py --start --port $port > /dev/null 2>&1 & echo $!";
        exec($command, $output, $return);

        // Le PID du processus lancé
        $pid = $output[0];

        return redirect('/home')->with('output', "Processus démarré avec le PID $pid sur le port $port");
    }


    public function botnet_is_running(): bool
    {
        $command = 'pgrep -c -f "python3"';
        $result = exec($command);

        if ($result != 0 ){
            return true;
        } else {
            return false;
        }
    }



    public function stop_botnet()
    {
        $command = 'killall python3';
        exec($command, $output, $return);

        return redirect('/home')->with('output', "Serveur stoppé.");
    }


}
