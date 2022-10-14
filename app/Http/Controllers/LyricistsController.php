<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Songs;
use App\Models\MusicDirectors;
use App\Models\Singers;
use App\Models\Movies;
use App\Models\Lyricists;
use App\Models\Artists;
use Illuminate\Support\Facades\File;

class LyricistsController extends Controller
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
        $lyricists = Lyricists::paginate(8);
        return view('lyricists.index', compact('lyricists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lyricists.create');
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
     
        $request->image_path->move(public_path('uploads/lyricists'), $fileName);
 
        $lyricists['name'] = $request->name;
        $lyricists['image_path'] = $fileName;

        Lyricists::create($lyricists);

        return redirect()->route('lyricists.create')->with('success', 'Lyricist successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $songs_data['lyricists'] = Lyricists::find($id);           
        
        $songs = Songs::leftjoin('movies', 'movies.id', '=', 'songs.movies')                  
        ->orderBy('songs.id', 'desc')
        ->select(['songs.*', 'movies.id as movies_id', 'movies.name as movies_name', 'movies.year'])
        ->whereJsonContains("lyricists", $id)
        ->paginate(10);
        
        $songs_data['songs']              = $songs;     
        $songs_data['singers']            = Singers::pluck('name','id');    
        $songs_data['music_directors']    = MusicDirectors::pluck('name', 'id');            
    
        return view('lyricists.show',compact('songs_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lyricist = Lyricists::find($id);
        return view('lyricists.edit', compact('lyricist'));
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
           
          $lyricist['name'] = $request->name;
          
          if( $request->image_path ){
            $fileName = time().'.'.$request->image_path->extension();  
     
            $request->image_path->move(public_path('uploads/lyricists'), $fileName);    
            
            $lyricist['image_path'] = $fileName;  
          }                   

          Lyricists::find($id)->update($lyricist);
          return redirect()->route('lyricists.index')->with('Lyricist','Movie was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lyricist = Lyricists::find($id);
       
        if(File::exists(public_path('uploads/lyricists/'.$lyricist->image_path))){
            File::delete(public_path('uploads/lyricists/'.$lyricist->image_path));
        }

        $lyricist->delete();
        return redirect()->route('lyricists.index')->with('success','Lyricist was successfully deleted!');
    }
}
