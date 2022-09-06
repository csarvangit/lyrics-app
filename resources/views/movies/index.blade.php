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
                      <i class="fa fa-table"></i> All Movies
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
                <h3>All Movies</h3>
            </div>
            <div class="">  
                <a class="btn btn-primary ml-auto" href="{{ url('/admin/movies/create')}}">  Add Movies</a>
            </div>
        </div>
    </div>

      <div class="row">
          <div class="col-lg-12">
              <div class="row movies-wrapper">
                  
                    @foreach( $movies as $key => $value)
                    <div class="col-lg-3 mb-4">
                        <div class="bg-column" style="background-image: url('{{ URL::to('/uploads/movies/' .  $value->image_path)  }}');">

                        <div class="bg-title">{{ $value->name }}</div>

                        </div>
                    </div>
                    @endforeach                      
              </div>

              
          </div>
      </div>
      <!-- /.row -->
    {{$movies->links()}}

  </div>
  <!-- /.container-fluid -->

@endsection