<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Songs;
use App\Models\MusicDirectors;
use App\Models\Singers;
use App\Models\Movies;
use App\Models\Lyricists;
use App\Models\Artists;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SongsController extends Controller
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
   
      // \DB::enableQueryLog();       
        
        $songs = Songs::leftjoin('movies', 'movies.id', '=', 'songs.movies')            
        ->orderBy('songs.id', 'desc')
        ->select(['songs.*', 'movies.id as movies_id', 'movies.name as movies_name', 'movies.year'])
        ->paginate(5);
        
        $songs_data['songs'] = $songs;      
    
        $songs_data['music_directors']    = Artists::where('music_director',1)->pluck('name','id');  
             
        // dd($songs->toArray()); 
        // dd(\DB::getQueryLog());

        return view('songs.index', compact('songs_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $song_data['movies']             = Movies::pluck('name','id');   

        $song_data['singers']            = Artists::where('singer',1)->pluck('name','id'); 
        $song_data['lyricists']          = Artists::where('lyricist',1)->pluck('name','id'); 
        $song_data['music_directors']    = Artists::where('music_director',1)->pluck('name','id');  

        return view('songs.create', compact('song_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'name'=>'required',
            'music_directors'=>'required',
            'singers'=>'required',
            'movies'=>'required',            
            'lyricists'=>'required',
            'lyrics_tamil'=>'required'
        ]);      
        
        Songs::create($request->all());       

        return redirect()->route('songs.create')->with('success', 'Song successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $song = Songs::find($id);
       
        $song_data['song']               = $song;
        $song_data['movies']             = Movies::pluck('name', 'id');

        $song_data['singers']            = Artists::where('singer',1)->pluck('name','id'); 
        $song_data['lyricists']          = Artists::where('lyricist',1)->pluck('name','id'); 
        $song_data['music_directors']    = Artists::where('music_director',1)->pluck('name','id'); 
    
        return view('songs.show',compact('song_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {       
        $song = Songs::find($id);       
        
        $song_data['songs']              = $song;
        $song_data['movies']             = Movies::pluck('name','id');

        $song_data['singers']            = Artists::where('singer',1)->pluck('name','id'); 
        $song_data['lyricists']          = Artists::where('lyricist',1)->pluck('name','id'); 
        $song_data['music_directors']    = Artists::where('music_director',1)->pluck('name','id');        

        return view('songs.edit',compact('song_data'));
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
            'name'=>'required',
            'music_directors'=>'required',
            'singers'=>'required',
            'movies'=>'required',            
            'lyricists'=>'required',            
            'lyrics_tamil'=>'required'
          ]);

          //dd($request->all());

          Songs::find($id)->update($request->all());
          return redirect()->route('songs.index')->with('success','Song was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $song = Songs::find($id);           

        if(File::exists(public_path('uploads/songs/'.$song->image_path))){
            File::delete(public_path('uploads/songs/'.$song->image_path));
        }

        $song->delete();
        return redirect()->route('songs.index')->with('success','Song was successfully deleted!');
    }
}
