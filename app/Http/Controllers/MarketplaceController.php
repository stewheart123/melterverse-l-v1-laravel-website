<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BlockPack;
use App\Models\UserDetail;
use Auth;
use Illuminate\Support\Facades\DB;

class MarketplaceController extends Controller
{
    /**
     * Returns both purchased and available public block packs as arrays
     *  
     */
    public function ShowAllBlockPacks(){
        
        //returns array of purchased blocks into a string
        $user_block_packs = DB::table('user_details')->where('ud_linking_id','=', Auth::user()->id )->first();
        
        $purchase_pack_array = [''];
        if($user_block_packs) {
            //splits the string back into an array
            $purchase_pack_array = explode(',' , $user_block_packs->ud_packs_purchased );
        }
        //passes array as arguments to include or remove from all block packs respectively
        $purchased_block_packs = DB::table('block_packs')->whereIn('bp_id', $purchase_pack_array )->where('bp_availability','=','public')->get();
        $available_block_packs = DB::table('block_packs')->where('bp_availability','=','public')->whereNotIn('bp_id', $purchase_pack_array)->get();

        return view('marketplace' , compact('available_block_packs', 'purchased_block_packs'));
    }

    /** receives a single bp_id
     * uses auth->id 
     * gets user-details - via ud_linking matching auth->ID
     * get packs purchased
     * checks each pack purchased if matches the input bp_id
     * if not, appends/ updates the ud_packs_purchased string
     * redirects to the marketplace view again / via above controller so the db logic is called again.
     *  */ 
    public function AddBlockPackToAccount(){

    }
}
