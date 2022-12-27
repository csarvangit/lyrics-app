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
                      <i class="fa fa-table"></i> All Songs
                  </li>
              </ol>
          </div>
      </div>
      <!-- /.row -->
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
            <b>{{ $message }}</b>
      </div>
    @endif

      <div class="row">
          <div class="col-lg-12">
              <h3>All Songs</h3>
              <div class="table-responsive-sm">
                  <table class="table table-hover table-striped">
                      <thead>
                          <tr>
                              <th>Sl No</th>  
                              <th>Song</th>
                              <th>Movie</th>
                              <th>Music By</th>
                              <th>Year</th>
                              <th>                      
                                  <a class="btn btn-primary ml-auto" href="{{ url('/admin/songs/create')}}"> <i class="fa fa-plus"></i>  Add Song</a>
                              </th>
                          </tr>
                      </thead>
                      <tbody>                      
                          @foreach( $songs_data['songs'] as $key => $songs)
                            <tr>
                                <td>{{ $songs_data['songs']->firstItem() + $key }} </td>
                                <td>{{ $songs->name }}  </td>
                                <td>{{ $songs->movies_name }}</td>
                                <td>                 
                                @if ($songs->music_directors) 
                                    @foreach( $songs->music_directors as $key => $music_director)                              
                                        @if ($songs_data['music_directors']) 
                                            {{$songs_data['music_directors'][$music_director] }}
                                            {{ $loop->last ? '' : ', ' }}
                                         @endif  
                                     @endforeach 
                                @endif 
                                </td>
                                <td>{{ $songs->year }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{route('songs.show', $songs->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a class="btn btn-primary btn-sm" href="{{route('songs.edit', $songs->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    {{ Form::open(['method' => 'DELETE','route' => ['songs.destroy', $songs->id],'style'=>'display:inline']) }}
                                    <button type="submit" style="display: inline;" class="btn btn-danger btn-sm show_confirm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    {{ Form::close() }}
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