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

class MusicDirectorsController extends Controller
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
        $music_directors = MusicDirectors::paginate(8);
        return view('music-directors.index', compact('music_directors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('music-directors.create');
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
     
        $request->image_path->move(public_path('uploads/music-directors'), $fileName);
 
        $md['name'] = $request->name;
        $md['image_path'] = $fileName;

        MusicDirectors::create($md);

        return redirect()->route('music-directors.create')->with('success', 'Music Director successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $songs_data['music_directors'] = MusicDirectors::find($id);     

       // $songs = Songs::where('music_directors', 'like', "%$id%")->paginate(10);
        $songs = Songs::whereJsonContains("music_directors", $id)->paginate(10);
        
        $songs_data['songs'] = $songs;
        $songs_data['singers']            = Singers::pluck('name','id');
        $songs_data['movies']             = Movies::pluck('name', 'id');
        $songs_data['lyricists']          = Lyricists::pluck('name','id');       
    
        return view('music-directors.show',compact('songs_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $music_directors = MusicDirectors::find($id);
        return view('music-directors.edit', compact('music_directors'));
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
           
          $music_directors['name'] = $request->name;
          
          if( $request->image_path ){
            $fileName = time().'.'.$request->image_path->extension();  
     
            $request->image_path->move(public_path('uploads/music-directors'), $fileName);    
            
            $music_directors['image_path'] = $fileName;  
          }                   

          MusicDirectors::find($id)->update($music_directors);
          return redirect()->route('music-directors.index')->with('success','Music Director was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $music_director = MusicDirectors::find($id);

        if(File::exists(public_path('uploads/music-directors/'.$music_director->image_path))){
            File::delete(public_path('uploads/music-directors/'.$music_director->image_path));
        }
        $music_director->delete();
        return redirect()->route('music-directors.index')->with('success','Music Director was successfully deleted!');
    }
}
