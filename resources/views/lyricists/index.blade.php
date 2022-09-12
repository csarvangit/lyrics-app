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
                      <i class="fa fa-table"></i> All Lyricists
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
                <h3>All Lyricists</h3>
            </div>
            <div class="">  
                <a class="btn btn-primary ml-auto" href="{{ url('/admin/lyricists/create')}}">  Add Lyricist</a>
            </div>
        </div>
    </div>

      <div class="row">
          <div class="col-lg-12">
              <div class="row movies-wrapper">
                  
                    @foreach( $lyricists as $key => $value)
                    <div class="col-lg-3 mb-4">
                        <div class="bg-column" style="background-image: url('{{ URL::to('/uploads/lyricists/' .  $value->image_path)  }}');">

                             <div class="bg-title">{{ $value->name }}</div>

                        </div>
                        <div class="bg-options text-center mt-2">    
                            <a class="btn btn-primary btn-sm" href="{{route('lyricists.edit', $value->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            {{ Form::open(['method' => 'DELETE','route' => ['lyricists.destroy', $value->id],'style'=>'display:inline']) }}
                            <button type="submit" style="display: inline;" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            {{ Form::close() }}
                        </div>
                    </div>
                    @endforeach                      
              </div>

              
          </div>
      </div>
      <!-- /.row -->
    {{$lyricists->links()}}

  </div>
  <!-- /.container-fluid -->

@endsection