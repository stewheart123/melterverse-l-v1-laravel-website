<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelloController extends Controller
{
    public function index() {   
        $usdc = "15";

        $user = DB::table('users')->where('name', Auth::user()->name )->first();
 
        $db_return = $user->email;
    
        return view('hello' , compact('db_return'));
    }
}
