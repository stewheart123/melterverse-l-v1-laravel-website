<?php
namespace App\Http\Controllers;
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
        return view('uploadfile');
    }

    public function store(Request $request)
    {
        // add in db query and add file locations, descriptions - fill in new user pack entry...
        $pack_folder_name = $request->input('folder');
        // dd($pack_folder_name);
        //Auth::user()->name;
        $bundle_path = public_path( 'bundles\\'. Auth::user()->name . Auth::user()->id . '\\' . $pack_folder_name);

        $image_path = public_path( 'bundles\\'. Auth::user()->name . Auth::user()->id . '\images');

        if(!File::isDirectory($bundle_path)){

            File::makeDirectory($bundle_path, 0777, true, true);
        }

        if(!File::isDirectory($image_path)){

            File::makeDirectory($image_path, 0777, true, true);
        }
        
            $request->validate([
            //application/octet-stream
            'folder'      =>  'required',
            'file'        =>  ['required','mimetypes:application/octet-stream'],
            'image'       =>  ['required','mimes:jpeg,bmp,png'],
            'description' =>  'required',
            //'image.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
            ]);
        if ($file = $request->hasFile('file')) {
             
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = $bundle_path ;
            $file->move($destinationPath,$fileName);
            //return redirect('/upload');
        }
        if ($file = $request->hasFile('image')) {
             
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = $image_path ;
            $file->move($destinationPath,$fileName);
            //return redirect('/upload');
            $message = "upload successful";
            return view('/uploadfiles')->with(['message' => $message]);
        }
    }
}