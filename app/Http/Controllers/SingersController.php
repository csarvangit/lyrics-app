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

class SingersController extends Controller
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
        $singers = Singers::paginate(12);
        return view('singers.index', compact('singers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('singers.create');
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
     
        $request->image_path->move(public_path('uploads/singers'), $fileName);
 
        $singers['name'] = $request->name;
        $singers['image_path'] = $fileName;

        Singers::create($singers);

        return redirect()->route('singers.create')->with('success', 'Singer successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $songs_data['singers'] = Singers::find($id);           
        $songs = Songs::whereJsonContains("singers", $id)->paginate(10);       
        
        $songs_data['songs'] = $songs;        
        $songs_data['music_directors']    = MusicDirectors::pluck('name', 'id');
        $songs_data['movies']             = Movies::pluck('name', 'id');
        $songs_data['lyricists']          = Lyricists::pluck('name','id');       
    
        return view('singers.show',compact('songs_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $singer = Singers::find($id);
        return view('singers.edit', compact('singer'));
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
           
          $singers['name'] = $request->name;
          
          if( $request->image_path ){
            $fileName = time().'.'.$request->image_path->extension();  
     
            $request->image_path->move(public_path('uploads/singers'), $fileName);    
            
            $singers['image_path'] = $fileName;  
          }                   

          Singers::find($id)->update($singers);
          return redirect()->route('singers.index')->with('success','Singer was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singer = Singers::find($id);
        
        if(File::exists(public_path('uploads/singers/'.$singer->image_path))){
            File::delete(public_path('uploads/singers/'.$singer->image_path));
        }
        
        $singer->delete();
        return redirect()->route('singers.index')->with('success','Singer was successfully deleted!');
    }
}
