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
                  <i class="fa fa-table"></i> Add Artist
              </li>           
          </ol>

          <div class="pull-right">
                <a class="btn btn-primary" href="{{ url()->previous() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
      </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      {!! Form::open(['route'=>'artists.store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        @include('artists.form_master')
      {!! Form::close() !!}
    </div>
  </div>
</div>


@endsection