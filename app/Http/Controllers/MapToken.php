<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use Auth;
use Illuminate\Support\Facades\DB;

class MapToken extends Controller
{
    public function CreateMapToken() {
        $map_token_bytes = random_bytes(3);
        $map_token = bin2hex($map_token_bytes);
        $token_return_string = "token: " . $map_token; 

        $user_account_details = UserDetail::where('ud_linking_id','=', Auth::user()->id )->first();
        if($user_account_details != null) {
            $affected = DB::table('user_details')
            ->where('ud_linking_id', Auth::user()->id)
            ->update(['ud_editor_session_key' => $map_token ]);
        }
        return view('map-editor-section', compact('token_return_string'));
    }
}