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
       // $songs = Songs::paginate(5);

      // \DB::enableQueryLog();

         /*  $songs = Songs::leftjoin('music_directors', 'music_directors.id', '=', 'songs.music_directors')
              ->leftjoin('singers', 'singers.id', '=', 'songs.singers')
              ->leftjoin('movies', 'movies.id', '=', 'songs.movies')
              ->leftjoin('lyricists', 'lyricists.id', '=', 'songs.lyricists')
              ->leftjoin('artists', 'artists.id', '=', 'songs.artists') 
              ->orderBy('songs.id', 'desc')
              ->select(['songs.id', 'songs.name','music_directors.name as music_directors', 'singers.name as singers', 'movies.name as movies', 'lyricists.name as lyricists', 'artists.name as artists'])
              ->paginate(5);

      $songs2 = Songs::leftjoin('music_directors',  DB::raw("json_extract(music_directors, '$[0].music_directors.id')"),"=","songs.music_directors")
              ->leftjoin('singers', 'singers.id', '=', 'songs.singers')
              ->leftjoin('movies', 'movies.id', '=', 'songs.movies')
              ->leftjoin('lyricists', 'lyricists.id', '=', 'songs.lyricists')
              ->leftjoin('artists', 'artists.id', '=', 'songs.artists') 
              ->orderBy('songs.id', 'desc')
              ->select(['songs.id', 'songs.name','music_directors.name as music_directors', 'singers.name as singers', 'movies.name as movies', 'lyricists.name as lyricists', 'artists.name as artists'])
              ->paginate(5);   

        $songs3 = Songs::leftjoin('music_directors',  function ($join) {
                                    $join->on(function ($on) {
                                        $on->whereRaw('JSON_CONTAINS(songs.music_directors, music_directors.id)');
                                    });
                                })
              ->leftjoin('singers',  function ($join) {
                        $join->on(function ($on) {
                                $on->whereRaw('JSON_CONTAINS(singers.id, songs.singers)');
                            });
                        })
              ->leftjoin('movies', 'movies.id', '=', 'songs.movies')
              ->leftjoin('lyricists',  function ($join) {
                            $join->on(function ($on) {
                                $on->whereRaw('JSON_CONTAINS(lyricists.id, songs.lyricists)');
                            });
                        })
              ->leftjoin('artists',  function ($join) {
                            $join->on(function ($on) {
                                $on->whereRaw('JSON_CONTAINS(artists.id, songs.artists)');
                            });
                        })
              ->orderBy('songs.id', 'desc')
              ->select(['songs.id', 'songs.name', 'music_directors.name as music_directors', 'singers.name as singers', 'movies.name as movies', 'lyricists.name as lyricists', 'artists.name as artists'])
              ->paginate(5);      
             
              $songs = Songs::leftjoin('music_directors', 'music_directors.id', '=', 'songs.music_directors')
              ->leftjoin('singers', 'singers.id', '=', 'songs.singers')
              ->leftjoin('movies', 'movies.id', '=', 'songs.movies')
              ->leftjoin('lyricists', 'lyricists.id', '=', 'songs.lyricists')
              ->leftjoin('artists', 'artists.id', '=', 'songs.artists') 
              ->orderBy('songs.id', 'desc')
              ->select(['songs.id', 'songs.name','music_directors.name as music_directors', 'singers.name as singers', 'movies.name as movies', 'lyricists.name as lyricists', 'artists.name as artists'])
              ->paginate(5);   */  
              
              
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
         /*  $this->validate($request, [
            'name'=>'required|string|max:255',
            'artist'=>'required|string|max:255',
            'lyrics'=>'required'
        ]); */

        $this->validate($request, [
            'name'=>'required',
            'languages'=>'required',
            'music_directors'=>'required',
            'singers'=>'required',
            'movies'=>'required',            
            'lyricists'=>'required',
            'artists'=>'required',
            'lyrics'=>'required'
        ]);
       // Songs::create($request->all());

        /* $songs_data['name'] = $request->name;
        $songs_data['languages'] = $request->languages;
        $songs_data['lyrics'] = $request->lyrics;

        $songs_data['music_directors'] = json_encode($request->artists);
        $songs_data['singers'] = json_encode($request->singers);
        $songs_data['movies'] = json_encode($request->movies);
        $songs_data['lyricists'] = json_encode($request->lyricists);
        $songs_data['artists'] = json_encode($request->artists);  
        Songs::create($songs_data); */

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
        return view('songs.show',compact('song'));
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
        return view('songs.edit',compact('song'));
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
            'title' => 'required',
            'artist'=>'required',
            'body' => 'required',
          ]);
          Songs::find($id)->update($request->all());
          return redirect()->route('songs')->with('success','Song was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Songs::find($id)->delete();
        return redirect()->route('songs')->with('success','Song lyrics was successfully deleted!');
    }
}
