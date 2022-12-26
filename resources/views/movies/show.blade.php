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
                      <i class="fa fa-table"></i> Movies
                  </li>
                  <li class="active ml-3">
                      <i class="fa fa-table"></i> Songs
                  </li>
              </ol>

              <div class="pull-right">
                <a class="btn btn-primary" href="{{ url()->previous() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
          </div>
      </div>
      <!-- /.row -->
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
          <p>{{ $message }}</p>
      </div>
    @endif

      <div class="row">
          <div class="col-lg-12">
              <h3>
              @if ( $songs_data['songs'][0] )   
              {{ $songs_data['songs'][0]->movies_name }} Songs
              @else
              No Songs
              @endif  
              </h3>
              <div class="table-responsive-sm">
                  <table class="table table-hover table-striped">
                      <thead>
                          <tr>
                              <th>Sl No</th>
                              <th>Song</th>
                              <th>lyricists</th>
                              <th>Music By</th>
                              <th>Year</th>
                              <th> </th>
                          </tr>
                      </thead>
                      <tbody>                      
                          @foreach( $songs_data['songs'] as $key => $songs)
                            <tr>
                                <td>{{ $key + 1 }} </td>
                                <td>{{ $songs->name }} </td>
                                <td>
                                @if ($songs->lyricists) 
                                    @foreach( $songs->lyricists as $key => $lyricist)
                             
                                        @if ($songs_data['lyricists']) 
                                        {{$songs_data['lyricists'][$lyricist]}}

                                            {{ $loop->last ? '' : ', ' }}

                                         @endif  
                                     @endforeach 
                                @endif 
                                </td>
                                <td>                 
                                @if ($songs->music_directors) 
                                    @foreach( $songs->music_directors as $key => $music_director)
                              
                                        @if ($songs_data['music_directors']) 
                                            {{$songs_data['music_directors'][$music_director]}}

                                            {{ $loop->last ? '' : ', ' }}

                                         @endif  
                                     @endforeach 
                                @endif 
                                </td>
                                <td>{{ $songs_data['songs'][0]->year }}</td>
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
  
  <!-- /.container-fluid -->

@endsection