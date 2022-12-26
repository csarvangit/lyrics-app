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

 <!-- <div class="col-sm-2">
    {{ Form::label('languages', 'Language') }}
  
    <div class="form-group {{ $errors->has('languages') ? 'has-error' : ''}}">
      {{ Form::select('languages', array('tamil' => 'Tamil', 'english' => 'English'), $song_data['songs']->languages ?? null, ['class' =>'form-control form-select','id'=>'languages', 'placeholder'=>'Please Select Language']) }}
      {!! $errors->first('languages', '<p class="help-block">:message</p>') !!}
    </div>
  </div> --> 

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

  <!-- Tabs navs -->
  <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="lyrics_tamil-tab" data-bs-toggle="tab" data-bs-target="#lyrics_tamil" type="button" role="tab" aria-controls="home" aria-selected="true">Tamil</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="lyrics_english-tab" data-bs-toggle="tab" data-bs-target="#lyrics_english" type="button" role="tab" aria-controls="profile" aria-selected="false">English</button>
  </li>
 
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="lyrics_tamil" role="tabpanel" aria-labelledby="home-tab">
    {{ Form::label('lyrics_tamil', 'Song Tamil Lyrics') }}
    
    <div class="form-group {{ $errors->has('lyrics_tamil') ? 'has-error' : ''}}">
      {{ Form::textarea('lyrics_tamil', $song_data['songs']->lyrics_tamil ?? null, ['class' =>'form-control', 'id'=>'lyrics_tamil', 'data-placeholder'=>'Song Tamil Lyrics']) }}
      {!! $errors->first('lyrics_tamil', '<p class="help-block">:message</p>') !!}
    </div>
  </div>
  <div class="tab-pane fade" id="lyrics_english" role="tabpanel" aria-labelledby="profile-tab">
    {{ Form::label('lyrics_english', 'Song English Lyrics') }}
    
    <div class="form-group {{ $errors->has('lyrics_english') ? 'has-error' : ''}}">
      {{ Form::textarea('lyrics_english', $song_data['songs']->lyrics_english ?? null, ['class' =>'form-control', 'id'=>'lyrics_english', 'data-placeholder'=>'Song English Lyrics']) }}
      {!! $errors->first('lyrics_english', '<p class="help-block">:message</p>') !!}
    </div>
  </div> 
</div>
<!-- Tabs content -->


<div class="row">
  <div class="col-sm-6">
    {{ Form::label('youtube_url', 'Youtube URL') }}
  
    <div class="form-group {{ $errors->has('youtube_url') ? 'has-error' : ''}}">
      {{ Form::text('youtube_url', $song_data['songs']->youtube_url ?? null, ['class' =>'form-control', 'id'=>'youtube_url', 'placeholder'=>'Youtube URL']) }}
      {!! $errors->first('youtube_url', '<p class="help-block">:message</p>') !!}
    </div>
  </div>
</div>

  </div>
</div>

<div class="form-group text-center pt-3 pb-5">
  {{ Form::button(isset($song_data['songs']) ? 'Update Song' : 'Save Song' , ['class'=>'btn btn-success', 'type'=>'submit']) }}
</div>