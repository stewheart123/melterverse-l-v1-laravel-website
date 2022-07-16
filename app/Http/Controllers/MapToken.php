<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;

class MapToken extends Controller
{
    public function CreateMapToken() {
         
         $map_token_bytes = random_bytes(3);
         $map_token = bin2hex($map_token_bytes);
        //dd($map_token);
        return view('map-editor-section', compact('map_token'));
    }
}
