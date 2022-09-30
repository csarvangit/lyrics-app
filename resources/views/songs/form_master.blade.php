@if ($message = Session::get('success'))
      <div class="alert alert-success">
          <p>{{ $message }}</p>
      </div>
    @endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif    

<div class="row">
  <div class="col-sm-5">
    {{ Form::label('name', 'Song Name') }}
  
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
      {{ Form::text('name', $song_data['songs']->name ?? null, ['class' =>'form-control', 'id'=>'name', 'placeholder'=>'Song Name']) }}
      {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
  </div>

  <div class="col-sm-5">
    {{ Form::label('movies', 'Movie Name') }}
  
    <div class="form-group {{ $errors->has('movies') ? 'has-error' : ''}}">
      {{ Form::select('movies', $song_data['movies'], $song_data['songs']->movies ?? null, ['class' =>'form-control form-select','id'=>'movies', 'placeholder'=>'Please Select Movies']) }}
      {!! $errors->first('movies', '<p class="help-block">:message</p>') !!}
    </div>
  </div>

  <div class="col-sm-2">
    {{ Form::label('languages', 'Language') }}
  
    <div class="form-group {{ $errors->has('languages') ? 'has-error' : ''}}">
      {{ Form::select('languages', array('tamil' => 'Tamil', 'english' => 'English'), $song_data['songs']->languages ?? null, ['class' =>'form-control form-select','id'=>'languages', 'placeholder'=>'Please Select Language']) }}
      {!! $errors->first('languages', '<p class="help-block">:message</p>') !!}
    </div>
  </div>



</div>

<div class="row">
  <div class="col-sm-3">
  
    {{ Form::label('singers', 'Singers') }}
  
    <div class="form-group {{ $errors->has('singers') ? 'has-error' : ''}}">
      {{ Form::select('singers[]', $song_data['singers'], $song_data['songs']->singers ?? null, ['class' =>'form-control form-select multiselect-opt', 'id'=>'singers', 'data-placeholder'=>'Please Select Singers', 'multiple'=>'multiple']) }}
      {!! $errors->first('singers', '<p class="help-block">:message</p>') !!}
    </div>
  </div>

  <div class="col-sm-3">
  
    {{ Form::label('artists', 'Artists') }}
  
    <div class="form-group {{ $errors->has('artists') ? 'has-error' : ''}}">
      {{ Form::select('artists[]', $song_data['artists'], $song_data['songs']->artists ?? null, ['class' =>'form-control form-select multiselect-opt','id'=>'artists', 'data-placeholder'=>'Please Select Artists', 'multiple'=>'multiple']) }}
      {!! $errors->first('artists', '<p class="help-block">:message</p>') !!}
    </div>
  </div>

  <div class="col-sm-3">
  
    {{ Form::label('lyricists', 'Lyricists') }}
  
    <div class="form-group {{ $errors->has('lyricists') ? 'has-error' : ''}}">
      {{ Form::select('lyricists[]', $song_data['lyricists'], $song_data['songs']->lyricists ?? null, ['class' =>'form-control form-select multiselect-opt','id'=>'lyricists', 'data-placeholder'=>'Please Select Lyricists', 'multiple'=>'multiple']) }}
      {!! $errors->first('lyricists', '<p class="help-block">:message</p>') !!}
    </div>
  </div>

  <div class="col-sm-3">
  
    {{ Form::label('music_directors', 'Music Directors') }}
  
    <div class="form-group {{ $errors->has('music_directors') ? 'has-error' : ''}}">
      {{ Form::select('music_directors[]', $song_data['music_directors'], $song_data['songs']->music_directors ?? null, ['class' =>'form-control form-select multiselect-opt','id'=>'music_directors', 'data-placeholder'=>'Please Select Music Directors', 'multiple'=>'multiple']) }}
      {!! $errors->first('music_directors', '<p class="help-block">:message</p>') !!}
    </div>
  </div>
</div>


<div class="row">
  <div class="col-sm-12">
    {{ Form::label('lyrics', 'Song Lyrics') }}
  
    <div class="form-group {{ $errors->has('lyrics') ? 'has-error' : ''}}">
      {{ Form::textarea('lyrics', $song_data['songs']->lyrics ?? null, ['class' =>'form-control', 'id'=>'lyrics', 'data-placeholder'=>'Song Lyrics']) }}
      {!! $errors->first('lyrics', '<p class="help-block">:message</p>') !!}
    </div>
  </div>
</div>

<div class="form-group pull-right">
  {{ Form::button(isset($song_data['songs']) ? 'Update Song' : 'Send Song Request' , ['class'=>'btn btn-success', 'type'=>'submit']) }}
</div>