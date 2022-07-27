<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BlockPack;
use App\Models\UserDetail;
use Auth;
use Illuminate\Support\Facades\DB;

class MarketplaceController extends Controller
{
    //
    public function ShowAllBlockPacks(){
        
        $block_packs = DB::table('block_packs')->where('bp_availability','=','public')->get();

        $user_block_packs = DB::table('user_details')->where('ud_linking_id','=', Auth::user()->id )->first();
        $purchase_pack_array = '';
        if($user_block_packs) {
            $purchase_pack_array = explode(',' , $user_block_packs->ud_packs_purchased );
        }
        //gets block pack ids with $user_block_packs->ud_packs_purchased
        //break out the individual pack ids into a list?
        //return two lists one of the unpurchased and the other is purchased - use the packs_purchased as queries for purchased list, 
        //

        return view('marketplace' , compact('block_packs', 'purchase_pack_array'));
    }
}
