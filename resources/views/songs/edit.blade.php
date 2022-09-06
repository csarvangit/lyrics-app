@extends('layouts.songs')
@section('content')

  <div class="row">
    <div class="col-md-6 cold-md-offset-3">
      {{ Form::model($song, ['route' => ['songs.update', $song->id], 'method'=>'PATCH']) }}
        @include('songs.form_master')
      {{ Form::close() }}
    </div>
  </div>

@endsection