@extends('layouts.songs')
@section('content')

<!-- Page Heading -->
<div class="row">
          <div class="col-lg-12">              
              <ol class="breadcrumb">
                  <li>
                      <i class="fa fa-dashboard"></i>  <a href="{{ url('/admin/songs')}}">Dashboard</a>
                  </li>
                  <li class="active ml-3">
                      <i class="fa fa-table"></i> Edit Song
                  </li>
              </ol>

              <div class="pull-right">
                <a class="btn btn-primary" href="{{ url()->previous() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
          </div>
      </div>

  <div class="row">
  <div class="col-md-12">
      {{ Form::model($song_data, ['route' => ['songs.update', $song_data['songs']->id], 'method'=>'PATCH']) }}
        @include('songs.form_master')
      {{ Form::close() }}
    </div>
  </div>

@endsection