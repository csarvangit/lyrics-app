<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artists;
use App\Models\Songs;
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
        $allow_delete = true;
        return view('artists.index', compact('artists', 'allow_delete'));
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
 
        $artist['name'] = $request->name;
        $artist['lyricist'] = $request->lyricist ? $request->lyricist : false ;
        $artist['singer'] = $request->singer ? $request->singer : false;
        $artist['music_director'] = $request->music_director ? $request->music_director : false;
        $artist['bio'] = $request->bio ? $request->bio : NULL;
        $artist['awards'] = $request->awards ? $request->awards : NULL;
        $artist['youtube_url'] = $request->youtube_url ? $request->youtube_url : NULL;

        $artist['image_path'] = $fileName;

        Artists::create($artist);

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
        $artist_data['artist'] = Artists::find($id);

        $songs = Songs::leftjoin('movies', 'movies.id', '=', 'songs.movies')                  
        ->orderBy('songs.id', 'desc')
        ->select(['songs.*', 'movies.id as movies_id', 'movies.name as movies_name', 'movies.year'])
        ->whereJsonContains("music_directors", $id)
        ->paginate(10);
        
        $artist_data['songs']  = $songs;

        return view('artists.show',compact('artist_data'));
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
          $artist['lyricist'] = $request->lyricist ? $request->lyricist : false ;
          $artist['singer'] = $request->singer ? $request->singer : false;
          $artist['music_director'] = $request->music_director ? $request->music_director : false;
          
          if( $request->image_path ){
            $fileName = time().'.'.$request->image_path->extension();  
     
            $request->image_path->move(public_path('uploads/artists'), $fileName);    
            
            $artist['image_path'] = $fileName;  
          }           
          
            $artist['bio'] = $request->bio ? $request->bio : NULL;
            $artist['awards'] = $request->awards ? $request->awards : NULL;
            $artist['youtube_url'] = $request->youtube_url ? $request->youtube_url : NULL;

          Artists::find($id)->update($artist);
          return redirect()->back()->with('success','Artist was successfully updated!');
    }

    public function lyricists(){
        $title = 'Lyricists';
        $allow_delete = false;
        $artists = Artists::where('lyricist', 1)->paginate(8);
        return view('artists.index', compact('title', 'artists', 'allow_delete'));
    }

    public function singers(){
        $title = 'Singers';
        $allow_delete = false;
        $artists = Artists::where('singer', 1)->paginate(8);
        return view('artists.index', compact('title', 'artists', 'allow_delete'));
    }

    public function music_directors(){
        $title = 'Music Directors';
        $allow_delete = false;
        $artists = Artists::where('music_director', 1)->paginate(8);
        return view('artists.index', compact('title', 'artists', 'allow_delete'));
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

        if(File::exists(public_path('uploads/artists/'.$artist->image_path))){
            File::delete(public_path('uploads/artists/'.$artist->image_path));
        }

        $artist->delete();
        return redirect()->route('artists.index')->with('success','Artist was successfully deleted!');
    }
}
