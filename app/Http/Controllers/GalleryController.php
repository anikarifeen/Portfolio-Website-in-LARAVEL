<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class GalleryController extends Controller
{
private $table = 'galeries';

    public function index(){
        $galleries = DB::table($this->table)->get();
        //render view
        return view('Gallery/index',compact('galleries'));
       
    }
    //Store Gallery
     public function create(){
         if(!Auth::check()){
             return \Redirect::route('gallery.index');
         }
        return view('Gallery/create');
    }
    //Show Gallery Photo
    public function store(Request $request){
        $name = $request->input('name');
        $description = $request->input('description');
        $cover_image = $request->file('cover_image');
        $owner_id = 1;
        
        //Check image Upload
        if($cover_image){
             $cover_image_filename = $cover_image->getClientOriginalName();
            $cover_image->move(public_path('images'),$cover_image_filename);
        }
    else {
            $cover_image_filename ='noimage.jpg';
 }
   //Insert into DB
            DB::table('galeries')->insert([
            'name' => $name,
            'description' => $description,
            'cover_image' => $cover_image_filename,
            'owner_id'    => $owner_id
            ]);
            
           \Session::flash('message','Photo Added Successfully');
           
           //Redirect
           return \Redirect::route('gallery.index');
        }
    
    public function show($id){
        
        //Get gallery
          $gallery = DB::table($this->table)->where('id',$id)->first();
          $photos = DB::table('photos')->where('gallery_id',$id)->get();
          //Render view
          
         return view('gallery/show',  compact('photos','gallery'));

    }
}
