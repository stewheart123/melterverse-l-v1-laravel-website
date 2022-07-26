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

        Auth::user()->name;
    $path = public_path( 'bundles\\'. Auth::user()->name . Auth::user()->id . '\test');

    if(!File::isDirectory($path)){

        File::makeDirectory($path, 0777, true, true);

    }
        
        $request->validate([
            //application/octet-stream
            'file' =>  ['required','mimetypes:application/octet-stream'],
            //'image.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
        ]);
        if($file = $request->hasFile('file')) {
             
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = $path ;
            $file->move($destinationPath,$fileName);
            //return redirect('/upload');
            $message = "upload successful";
            return view('/uploadfiles')->with(['message' => $message]);
        }
    }
}