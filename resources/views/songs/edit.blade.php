@extends('layouts.songs')
@section('content')

  <div class="row">
  <div class="col-md-12">
      {{ Form::model($song_data, ['route' => ['songs.update', $song_data['songs']->id], 'method'=>'PATCH']) }}
        @include('songs.form_master')
      {{ Form::close() }}
    </div>
  </div>

@endsection