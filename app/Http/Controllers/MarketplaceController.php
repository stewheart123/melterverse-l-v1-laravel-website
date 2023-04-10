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
                $trimmed_purchase_string = $user_block_packs->ud_packs_purchased .','. $new_purchase_string;
                $trimmed_purchase_string = trim($trimmed_purchase_string , ',');
                $affected = DB::table('user_details')
                ->where('ud_linking_id', Auth::user()->id)
                ->update(['ud_packs_purchased' => $trimmed_purchase_string ]);
            }
        return redirect()->action([MarketplaceController::class, 'index']);
    }

    /**
     
     * Deletes files and folders for the block pack
     * also deletes instances of purchase from each user
     */
    public function destroy(Request $request){
        $block_pack = $request->block_pack;
        $block_pack_extract_details = DB::table('block_packs')->where('bp_id', $block_pack)->first();
        
        $all_users = DB::table('user_details')->get();
        foreach( $all_users as $user ){
            $purchase_pack_array = [''];
            $willUpdate = false;
            if( $user->ud_packs_purchased ){
                //splits the string back into an array
                $purchase_pack_array = explode(',' , $user->ud_packs_purchased );
                $new_purchase_string = '';
                    // checks each pack id against the one being deleted
                    foreach( $purchase_pack_array as $pack_item => $value ){
                        if( $value == $block_pack ) {
                            unset($purchase_pack_array[$pack_item]); 
                           $willUpdate = true; 
                        }
                        else {
                            if($pack_item != (count($purchase_pack_array) -1 ) ){
                                $new_purchase_string .= $value .',';
                            } 
                        }
                    }
                        $new_purchase_string = trim($new_purchase_string, ',');
                        //if did contain string to be deleted, reconstituted string is updated back into the user detail
                    if( $willUpdate) {
                        DB::table('user_details')
                        ->where('ud_linking_id', $user->ud_linking_id)
                        ->update(['ud_packs_purchased' => $new_purchase_string ]);
                    }
            }

        }
        
        /**
         * deletes image but not image folder as currently used for any pack the user owns -
         * might need to refactor into the pack folder to avoid breaking links when removing 
         * image being shared by 2 user packs
         */
        $array_for_image_name = explode('/',$block_pack_extract_details->bp_image_location);
        $bundle_image_name = $array_for_image_name[count($array_for_image_name) -1 ];
        unlink(public_path('bundles\\'. Auth::user()->name . Auth::user()->id . '\images\\'. $bundle_image_name));
        
        /**
         * Removes file and folder
         */
        $array_for_file_name = (explode('/',$block_pack_extract_details->bp_file_location));
        $bundle_file_name = $array_for_file_name[count($array_for_file_name) -1 ];
        unlink(public_path('bundles\\'. Auth::user()->name . Auth::user()->id . '\\' . $block_pack_extract_details->bp_display_name.'\\'. $bundle_file_name));
        rmdir(public_path('bundles\\'. Auth::user()->name . Auth::user()->id . '\\' . $block_pack_extract_details->bp_display_name.'\\'));
        $block_pack_to_delete = BlockPack::where('bp_id', $block_pack)->where('bp_author_id', Auth::user()->id);
        $block_pack_to_delete->delete();

        return redirect('marketplace');
    }
     
}
