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
                      <i class="fa fa-table"></i> {{ $title ?? 'Artists' }}
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

    <div class="row mb-4">
        <div class=" d-flex justify-content-between">
            <div class="">
                <h3>All  {{ $title ?? 'Artists' }}</h3>
            </div>
            <div class="">  
                <a class="btn btn-primary ml-auto" href="{{ url('/admin/artists/create')}}">Add Artist</a>
            </div>
        </div>
    </div>

      <div class="row">
          <div class="col-lg-12">
              <div class="row movies-wrapper">
                  
                    @foreach( $artists as $key => $value)
                    <div class="col-lg-3 mb-4">
                        <div class="bg-column" style="background-image: url('{{ URL::to('/uploads/artists/' .  $value->image_path)  }}');">
                       
                            <a href="{{route('artists.show', $value->id)}}" target="_self">
                                <div class="bg-title">{{ $value->name }}</div>      
                            </a>

                        </div>
                        
                        <div class="bg-options text-center mt-2">    
                            <a class="btn btn-primary btn-sm" href="{{route('artists.edit', $value->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            @if ( $allow_delete  )
                                {{ Form::open(['method' => 'DELETE','route' => ['artists.destroy', $value->id],'style'=>'display:inline']) }}
                                <button type="submit" style="display: inline;" class="btn btn-danger btn-sm show_confirm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                {{ Form::close() }}
                            @endif
                        </div>
                        
                    </div>
                    @endforeach                      
              </div>

              
          </div>
      </div>
      <!-- /.row -->
    {{$artists->links()}}

  </div>
  <!-- /.container-fluid -->

@endsection