<?php
namespace App\Http\Controllers;
use App\Models\BlockPack;
use Illuminate\Http\Request;
use DB;
use Auth;
use File;
class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $availability = ['draft' , 'private' , 'public'];
        return view('uploadfiles', compact('availability'));
    }

    public function store(Request $request)
    {
        $pack_folder_name = $request->input('folder');
        //bundle path may need altering        
        $bundle_path = public_path( 'bundles\\'. Auth::user()->name . Auth::user()->id . '\\' . $pack_folder_name);
        $image_path = public_path( 'bundles\\'. Auth::user()->name . Auth::user()->id . '\images');
        $image_name = $request->file('image');
        $image_name = $image_name->getClientOriginalName();
        $image_url = '/bundles/'. Auth::user()->name . Auth::user()->id . '/images/' . $image_name;

        if(!File::isDirectory($bundle_path)){

            File::makeDirectory($bundle_path, 0777, true, true);
        }

        if(!File::isDirectory($image_path)){

            File::makeDirectory($image_path, 0777, true, true);
        }

            $request->validate([
            'folder'       =>  'required|min:3',
            'file'         =>  ['required','mimetypes:application/octet-stream'],
            'image'        =>  ['required','mimes:jpeg,bmp,png'],
            'description'  =>  'required',
            ]);

        if ($file = $request->hasFile('file')) {
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = $bundle_path ;
            $file->move($destinationPath,$fileName);
        
            if ($img = $request->hasFile('image')) {
                $img = $request->file('image') ;
                $imgName = $img->getClientOriginalName() ;
                $destinationPath = $image_path ;
                $img->move($destinationPath,$imgName);
            }
            $t = time();
            BlockPack::create([
                'bp_id'                  => 'BP_ID_' . Auth::user()->id . $t,
                'bp_production_name'     => $pack_folder_name,
                'bp_display_name'        => $pack_folder_name,
                'bp_author_id'           => Auth::user()->id,
                'bp_file_location'       => $bundle_path,
                'bp_genre_ids'           => '',
                'bp_availability'        => $request->input('availability'),
                'bp_description'         => $request->input('description'),
                'bp_total_purchases'     => 0,
                'bp_total_views'         => 0,
                'bp_price'               => 0,
                'bp_pack_contents'       => '',
                'bp_additional_currency' => '',
                'bp_image_location'      => $image_url
            ]);

            $availability = ['draft' , 'private' , 'public'];
            $message = "upload successful";
            
            return view('/uploadfiles')->with([
                'message' => $message,
                'availability' => $availability            
            ]);
        
        }       
    }
}