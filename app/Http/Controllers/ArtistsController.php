<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artists;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ArtistsController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artists::paginate(8);
        return view('artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $fileName = time().'.'.$request->image_path->extension();  
     
        $request->image_path->move(public_path('uploads/artists'), $fileName);
 
        $artists['name'] = $request->name;
        $artists['image_path'] = $fileName;

        Artists::create($artists);

        return redirect()->route('artists.create')->with('success', 'Artist successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artist = Artists::find($id);
        return view('artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
          ]);
           
          $artist['name'] = $request->name;
          
          if( $request->image_path ){
            $fileName = time().'.'.$request->image_path->extension();  
     
            $request->image_path->move(public_path('uploads/artists'), $fileName);    
            
            $artist['image_path'] = $fileName;  
          }                   

          Artists::find($id)->update($artist);
          return redirect()->route('artists.index')->with('Artists','Artist was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artist = Artists::find($id);
      
       /*  if (Storage::disk('public')->exists('/uploads/artists/'.$artist->image_path)) {
            //unlink("uploads/songs/".$song->image_path);    
            Storage::disk('public')->delete('/uploads/artists/'.$artist->image_path); 
        } 
        if(file_exists(public_path('/uploads/artists/'.$artist->image_path))){
            unlink("uploads/artists/".$artist->image_path);
        } */

        if(File::exists(public_path('uploads/artists/'.$artist->image_path))){
            File::delete(public_path('uploads/artists/'.$artist->image_path));
        }

        $artist->delete();
        return redirect()->route('artists.index')->with('success','Artist was successfully deleted!');
    }
}
