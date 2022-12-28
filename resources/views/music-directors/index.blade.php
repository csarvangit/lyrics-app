@extends('../layouts.songs')
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
                      <i class="fa fa-table"></i> All Music Directors
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

    <div class="row mb-4">
        <div class=" d-flex justify-content-between">
            <div class="">
                <h3>All Music Directors</h3>
            </div>
            <div class="">  
                <a class="btn btn-primary ml-auto" href="{{ route('artists.create')}}">Add Music Director</a>
            </div>
        </div>
    </div>

      <div class="row">
          <div class="col-lg-12">
              <div class="row movies-wrapper">
                  
                    @foreach( $music_directors as $key => $value)
                    <div class="col-lg-3 mb-4">
                        <div class="bg-column" style="background-image: url('{{ URL::to('/public/uploads/artists/' .  $value->image_path)  }}');">
                            
                            <a href="{{route('music-directors.show', $value->id)}}" target="_self">
                                <div class="bg-title">{{ $value->name }}</div>      
                            </a>

                        </div>
                        <div class="bg-options text-center mt-2">    
                            <a class="btn btn-primary btn-sm" href="{{route('artists.edit', $value->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            
                        </div>
                    </div>
                    @endforeach                      
              </div>

              
          </div>
      </div>
      <!-- /.row -->
    {{$music_directors->links()}}

  </div>
  <!-- /.container-fluid -->

@endsection