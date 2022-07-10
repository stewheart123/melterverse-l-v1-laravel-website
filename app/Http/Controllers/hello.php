<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class hello extends Controller
{
    public function index() {
        
        $usdc = "15";
    
        return view('hello' , compact('usdc'));
    }

}
