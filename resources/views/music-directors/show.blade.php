@extends('layouts.songs')
@section('content')

  <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
          <div class="col-lg-12">              
              <ol class="breadcrumb">
                  <li>
                      <i class="fa fa-dashboard"></i>  <a href="{{ url('/admin/songs')}}">Dashboard</a>
                  </li>
                  <li class="active ml-3">
                      <i class="fa fa-table"></i> Music Directors
                  </li>
                  <li class="active ml-3">
                      <i class="fa fa-table"></i> Songs
                  </li>
              </ol>
          </div>
      </div>
      <!-- /.row -->
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
          <p>{{ $message }}</p>
      </div>
    @endif
       
    <div class="row pb-4">
        <div class="col-lg-12">
            <h3>
              @if ( $songs_data['music_directors'] )   
              {{ $songs_data['music_directors']->name }} Songs
              @else
              No Music Directors
              @endif  
              </h3>
            <div class="bio-content">
                
             @if ( $songs_data['music_directors']->bio )   
             {!! $songs_data['music_directors']->bio !!}          
              @endif  

            </div>  
        </div>
    </div>       

      <div class="row">
          <div class="col-lg-12">
              
              <div class="table-responsive-sm">
                  <table class="table table-hover table-striped">
                      <thead>
                          <tr>
                              <th>Sl No</th>
                              <th>Song</th>
                              <th>Movie</th>
                              <th>Year</th>                            
                              <th> </th>
                          </tr>
                      </thead>
                      <tbody>                      
                          @foreach( $songs_data['songs'] as $key => $songs)
                            <tr>
                                <td>{{ $key + 1 }} </td>
                                <td>{{ $songs->name }} </td>
                                <td>{{ $songs->movies_name }} </td>
                                <td>{{ $songs->year }} </td>                               
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{route('songs.show', $songs->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
      <!-- /.row -->  
 
    
    <div class="d-flex justify-content-between">    
        {{ $songs_data['songs']->links()  }}  
         Showing {{ $songs_data['songs']->firstItem() }} to {{ $songs_data['songs']->lastItem() }} of total {{$songs_data['songs']->total()}} entries 
    </div>

    @if ( $songs_data['music_directors']->youtube_url !== NULL ||  !empty($songs_data['music_directors']->youtube_url) )
    <div class="row pt-4"> 
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Youtube : </strong>         
                <div>                    
                    <iframe width="420" height="315" src="{{$songs_data['music_directors']->youtube_url}}" frameborder="0" allowfullscreen></iframe>    
                </div>
            </div>
        </div>
      </div> 
      @endif 

      @if ( $songs_data['music_directors']->awards )    
        <div class="row pt-4 pb-4">
            <div class="col-lg-12"> 
                <h4>              
                Awards Won             
                </h4>
                <div class="awards-content pb-2">
                {!! $songs_data['music_directors']->awards !!}
                </div>  
            </div>
         </div> 
    @endif 
  
  <!-- /.container-fluid -->

@endsection