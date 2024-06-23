<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolsController extends Controller
{

    public function index()
    {

        return view('tools');

    }


    public function phising_send()
    {

        //send email



        return view('tools')->with('message', 'Email envoyer avec succès !');
    }

}
