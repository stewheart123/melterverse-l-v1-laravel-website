<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BlockPack;
use App\Models\UserDetail;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;

class MarketplaceController extends Controller
{
    /**
     * Returns both purchased and available public block packs as arrays
     * 
     * Create new area for 'my packs - each with an edit button that navigates to an edit page 
     * will need to pass a page for the instance id or name 
     */
    public function index(){
        
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
        //dd($available_block_packs);

        $your_created_packs = DB::table('block_packs')->where('bp_author_id', '=', Auth::user()->id )->get();
        
        return view('marketplace' , compact('available_block_packs', 'purchased_block_packs', 'your_created_packs'));
    }

    /** 
     * explodes purchase string into an array, 
     *  result, if unique, 
     * adds new string to end
     *  */ 
    public function store(Request $request){
        $new_purchase_string = $request->pack_id_order;
        $user_block_packs = DB::table('user_details')->where('ud_linking_id','=', Auth::user()->id )->first();
        $purchase_pack_array = [''];
        $notDuplicate = true;
        
            //splits the string back into an array
            if($user_block_packs->ud_packs_purchased) {
                $purchase_pack_array = explode(',' , $user_block_packs->ud_packs_purchased );
                foreach($purchase_pack_array as $purchase_strings) {
                    if($purchase_strings == $request->pack_id_order ) {
                        $notDuplicate = false;
                    }
                }
            }
            else {
                $user_block_packs->ud_packs_purchased = '';
            }
            if ($notDuplicate == true) {

                $affected = DB::table('user_details')
                ->where('ud_linking_id', Auth::user()->id)
                ->update(['ud_packs_purchased' => $user_block_packs->ud_packs_purchased .','. $new_purchase_string ]);
            }
        return redirect()->action([MarketplaceController::class, 'index']);
    }

    /**
     
     * must also delete the file and image locations
     */
    public function destroy(Request $request){
        $block_pack = $request->block_pack;
        $block_pack_to_delete = BlockPack::where('bp_id', $block_pack)->where('bp_author_id', Auth::user()->id);
        $block_pack_to_delete->delete();
        return redirect('marketplace');
    }
    /**
     * NEED TO ADD IN FUNCTION THAT CHECKS EVERY USER DETAILS, REMOVING THE PURCHASED BLOCK PACK ID FROM
     * PURCHASED BLOCKS AS THEY NO LONGER EXIST
     * 
     *
     */
     
}
