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

class MoviesController extends Controller
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
        $movies = Movies::paginate(8);
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create');
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
            'year' => 'required',
        ]);

        $fileName = time().'.'.$request->image_path->extension();  
     
        $request->image_path->move(public_path('uploads/movies'), $fileName);
 
        $movies['name'] = $request->name;
        $movies['year'] = $request->year;
        $movies['image_path'] = $fileName;

        Movies::create($movies);

        return redirect()->route('movies.create')->with('success', 'Movie successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $songs = Songs::leftjoin('movies', 'movies.id', '=', 'songs.movies')                  
        ->orderBy('songs.id', 'desc')
        ->select(['songs.*', 'movies.id as movies_id', 'movies.name as movies_name'])
        ->where('songs.movies', '=', $id)  
        ->paginate(10);
        
        $songs_data['songs'] = $songs;
        $songs_data['music_directors'] = MusicDirectors::all();
        $songs_data['singers'] = Singers::all();
        $songs_data['lyricists'] = Lyricists::all();
        $songs_data['artists'] = Artists::all(); 
    
        return view('movies.show',compact('songs_data'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movies::find($id);
        return view('movies.edit', compact('movie'));
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
            'year' => 'required',
          ]);
          
          $movies['name'] = $request->name;
          $movies['year'] = $request->year;
          
          if( $request->image_path ){
            $fileName = time().'.'.$request->image_path->extension();  
     
            $request->image_path->move(public_path('uploads/movies'), $fileName);    
            
            $movies['image_path'] = $fileName;  
          }  
          Movies::find($id)->update($movies);
          return redirect()->route('movies.index')->with('success','Movie was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movies::find($id);
    
        if(File::exists(public_path('uploads/movies/'.$movie->image_path))){
            File::delete(public_path('uploads/movies/'.$movie->image_path));
        }
        $movie->delete();
        return redirect()->route('movies.index')->with('success','Movie was successfully deleted!');
    }
}
