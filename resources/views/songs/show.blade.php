@extends('layouts.songs')
@section('content')
  <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>Show Song</h2>
          </div>
          <div class="pull-right">
              <br/>
              <a class="btn btn-primary" href="{{ route('songs') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Title : </strong>
              {{ $song->title}}
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Artist : </strong>
              {{ $song->artist}}
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Body : </strong>
              {{ $song->body}}
          </div>
      </div>
  </div>
@endsection