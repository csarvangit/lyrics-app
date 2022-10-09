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

    /*  $songs = Songs::leftjoin('music_directors', 'music_directors.id', '=', 'songs.music_directors')
        ->leftjoin('singers', 'singers.id', '=', 'songs.singers')
        ->leftjoin('movies', 'movies.id', '=', 'songs.movies')
        ->leftjoin('lyricists', 'lyricists.id', '=', 'songs.lyricists')
        ->leftjoin('artists', 'artists.id', '=', 'songs.artists') 
        ->orderBy('songs.id', 'desc')
        ->select(['songs.id', 'songs.name','music_directors.name as music_directors', 'singers.name as singers', 'movies.name as movies', 'lyricists.name as lyricists', 'artists.name as artists'])
        ->paginate(5);  */  
        
        
        $songs = Songs::leftjoin('movies', 'movies.id', '=', 'songs.movies')             
        ->orderBy('songs.id', 'desc')
        ->select(['songs.*', 'movies.id as movies_id', 'movies.name as movies_name'])
        ->paginate(5);
        
        $songs_data['songs'] = $songs;
        $songs_data['music_directors'] = MusicDirectors::all();
        $songs_data['singers'] = Singers::all();
        $songs_data['lyricists'] = Lyricists::all();
        $songs_data['artists'] = Artists::all();
              
             
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
        $song_data['music_directors']    = MusicDirectors::pluck('name','id');
        $song_data['singers']            = Singers::pluck('name','id');
        $song_data['movies']             = Movies::pluck('name','id');
        $song_data['lyricists']          = Lyricists::pluck('name','id');
        $song_data['artists']            = Artists::pluck('name','id'); 
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
            'artists'=>'required',
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
        $song_data['music_directors']    = MusicDirectors::pluck('name','id');
        $song_data['singers']            = Singers::pluck('name','id');
        $song_data['movies']             = Movies::pluck('name', 'id');
        $song_data['lyricists']          = Lyricists::pluck('name','id');
        $song_data['artists']            = Artists::pluck('name','id'); 
    
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
        $song_data['music_directors']    = MusicDirectors::pluck('name','id');
        $song_data['singers']            = Singers::pluck('name','id');
        $song_data['movies']             = Movies::pluck('name','id');
        $song_data['lyricists']          = Lyricists::pluck('name','id');
        $song_data['artists']            = Artists::pluck('name','id');  

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
            'artists'=>'required',
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
        return redirect()->route('songs.index')->with('success','Song lyrics was successfully deleted!');
    }
}
