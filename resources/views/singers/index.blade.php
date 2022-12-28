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
                      <i class="fa fa-table"></i> All Singers
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
                <h3>All Singers</h3>
            </div>
            <div class="">  
                <a class="btn btn-primary ml-auto" href="{{ url('/admin/singers/create')}}">  Add Singer</a>
            </div>
        </div>
    </div>

      <div class="row">
          <div class="col-lg-12">
              <div class="row movies-wrapper">
                  
                    @foreach( $singers as $key => $value)
                    <div class="col-lg-3 mb-4">
                        <div class="bg-column" style="background-image: url('{{ URL::to('/public/uploads/singers/' .  $value->image_path)  }}');">

                            <a href="{{route('singers.show', $value->id)}}" target="_self">
                                <div class="bg-title">{{ $value->name }}</div>      
                            </a>

                        </div>
                        <div class="bg-options text-center mt-2">    
                            <a class="btn btn-primary btn-sm" href="{{route('singers.edit', $value->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            {{ Form::open(['method' => 'DELETE','route' => ['singers.destroy', $value->id],'style'=>'display:inline']) }}
                            <button type="submit" style="display: inline;" class="btn btn-danger btn-sm show_confirm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            {{ Form::close() }}
                        </div>
                    </div>
                    @endforeach                      
              </div>

              
          </div>
      </div>
      <!-- /.row -->
    {{$singers->links()}}

  </div>
  <!-- /.container-fluid -->

@endsection