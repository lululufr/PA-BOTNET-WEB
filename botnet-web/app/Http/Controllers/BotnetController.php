<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotnetController extends Controller
{
    
    public function start()
    {

        $test = system('ipconfig', $return);


      
    }

}
