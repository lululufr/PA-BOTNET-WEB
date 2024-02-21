<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiWordlist extends Controller
{
    public function receive($list): bool|string
    {
        $cheminFic = storage_path("wordlist/".$list.".txt");


        if (!file_exists($cheminFic)) {
            abort(404, 'Fichier non trouvé');
        }

        //Télécharger le fichier
        return redirect($cheminFic);

    }

    public function test($list): bool|string
    {
        $cheminFic = storage_path("wordlist/".$list.".txt");


        if (!file_exists($cheminFic)) {
            abort(404, 'Fichier non trouvé');
        }

        //Télécharger le fichier
        return response()->download($cheminFic, 'test.txt', [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment',
        ]);

    }

    //windows//Invoke-WebRequest -Uri http://botnet-web.test/api/wdlst/test -OutFile test.txt
    //linux//wget http://botnet-web.test/api/wdlst/test

}
