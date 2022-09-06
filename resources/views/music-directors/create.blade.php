@extends('layouts.songs')
@section('content')
<div class="row mt-4">
  <div class="col-md-8">
    {!! Form::open(['route'=>'music-directors.store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
      @include('music-directors.form_master')
    {!! Form::close() !!}
  </div>
</div>


@endsection