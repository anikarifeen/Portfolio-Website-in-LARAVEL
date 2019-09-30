<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PhotoController extends Controller
{  
    private $table = 'photos';
    public function create($gallery_id){
        // Check Logged In
        if(!Auth::check()){
             return \Redirect::route('gallery.index');
         }
       return view('Photo/create',compact('gallery_id'));
    }
     //Store Photo 
    public function store(Request $request){
        $gallery_id = $request->input('gallery_id');
        $title = $request->input('title');
        $description = $request->input('description');
        $location = $request->input('location');
        $image = $request->file('image');
        $owner_id = 1;
        
        //Check image Upload
        if($image){
             $image_filename = $image->getClientOriginalName();
            $image->move(public_path('images'),$image_filename);
        }
    else {
            $image_filename ='noimage.jpg';
 }
   //Insert into DB
            DB::table('photos')->insert([
            'title' => $title,
            'description' => $description,
            'location' => $location,
            'gallery_id' => $gallery_id,
            'image' => $image_filename,
            'owner_id'    => $owner_id
            ]);
            
           \Session::flash('message','Portfolio Added Successfully');
           
      
           //Redirect
           return \Redirect::route('gallery.show',array('id' => $gallery_id));
    }
    //Show Portfolio Details 
    public function details($id){
         $photo = DB::table($this->table)->where('id',$id)->first();
          //Render view
          
         return view('photo/details',  compact('photo'));
    }
        public function destroy($id,$gallery_id){
        $photo = DB::table($this->table)->where('id',$id)->delete();
            \Session::flash('message','Portfolio Deleted Successfully');
           
      
           //Redirect
           return \Redirect::route('gallery.show',array('id' => $gallery_id));
        }
        
        public function edit($id){
             // Check Logged In
        if(!Auth::check()){
             return \Redirect::route('gallery.index');
         }
          $photo = DB::table($this->table)->where('id',$id)->first();
          //Render view
          
         return view('photo/edit',  compact('photo'));
        }
// Update Portfolio
        
        public function updatedata(Request $request){
        $id = $request->input('id');
        $gallery_id = $request->input('gallery_id');
        $title = $request->input('title');
        $description = $request->input('description');
        $location = $request->input('location');
        $image = $request->file('image');
        $owner_id = 1;
        
        //Check image Upload
        if($image){
             $image_filename = $image->getClientOriginalName();
            $image->move(public_path('images'),$image_filename);
             DB::table($this->table)->where('id',$id)->update([
            'title' => $title,
            'description' => $description,
            'location' => $location,
            'gallery_id' => $gallery_id,
            'image' => $image_filename,
            'owner_id'    => $owner_id
            ]);
        }
    else {
            DB::table($this->table)->where('id',$id)->update([
           'title' => $title,
            'description' => $description,
            'location' => $location,
            'gallery_id' => $gallery_id,
            'owner_id'    => $owner_id
                 ]);
 }
   //Insert into DB
           
            
           \Session::flash('message','Portfolio Updated Successfully');
           
      
           //Redirect
           return \Redirect::route('gallery.show',array('id' => $gallery_id));
    }
        }
    

