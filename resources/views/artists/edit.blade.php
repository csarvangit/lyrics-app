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
                <i class="fa fa-table"></i> Edit Singer
            </li>
        </ol>
    </div>
</div>

  <div class="row">
  <div class="col-md-12">
      {{ Form::model($artist, ['route' => ['artists.update', $artist->id], 'method'=>'PATCH', 'enctype'=>'multipart/form-data' ]) }}
        @include('artists.form_master')
      {{ Form::close() }}
    </div>
  </div>

@endsection