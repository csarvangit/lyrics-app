@if ($message = Session::get('success'))
      <div class="alert alert-success my-3">
          <b>{{ $message }}</b>
      </div>
    @endif
  
<div class="row">
  <div class="col-md-12">

    <div class="row">
      <div class="col-sm-3">
        {{ Form::label('name', 'Artist Name') }}
      </div>
      <div class="col-sm-5">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
          {{ Form::text('name', NULL, ['class' =>'form-control', 'id'=>'name', 'placeholder'=>'Artist Name']) }}
          {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
          
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-3">
        {{ Form::label('role', 'Artist Role') }}
      </div>
      <div class="col-sm-8 {{ $errors->has('role') ? 'has-error' : ''}}">   
        <div class="form-group">
           {{ Form::label('artist', 'Artist') }}
            {{ Form::checkbox('role[artist]', '1', $artist->artist ?? null, ['id'=>'artist']) }}
        </div>
        <div class="form-group">
           {{ Form::label('lyricist', 'Lyricist') }}
            {{ Form::checkbox('role[lyricist]', '1', $artist->lyricist ?? null, ['id'=>'lyricist']) }}
        </div>
        <div class="form-group">
           {{ Form::label('singer', 'Singer') }}
            {{ Form::checkbox('role[singer]', '1', $artist->singer ?? null, ['id'=>'singer']) }}
        </div>
        <div class="form-group">
           {{ Form::label('music_director', 'Music Director') }}
            {{ Form::checkbox('role[music_director]', '1', $artist->music_director ?? null, ['id'=>'music_director']) }}
        </div>
        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
      </div>
    </div>

    <div class="row">
      <div class="col-sm-3">
      {{ Form::label('image_path', 'Upload Artist Image') }}
      </div>
      <div class="col-sm-8">
        <div class="form-group {{ $errors->has('image_path') ? 'has-error' : ''}}">
          {{ Form::file('image_path', NULL, ['class'=>'form-control', 'id'=>'image_path']) }}
          {!! $errors->first('image_path', '<p class="help-block">:message</p>') !!}
        </div>

        @php
        if( isset($artist) ) {
           $img_path =  URL::to('/public/uploads/artists/' .  $artist->image_path) ?? null;
        } else {  
           $img_path = null;
        }
        @endphp
         
        <div class="col-sm-4 pb-3">
          <img class="thumb-preview" src="{{ $img_path }}" alt=""> 
        </div>     
      </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
          {{ Form::label('bio', 'Artist Biography') }}
        </div>
        <div class="col-sm-9">
          <div class="form-group {{ $errors->has('bio') ? 'has-error' : ''}}">
            {{ Form::textarea('bio', NULL, ['class' =>'form-control ckeditor', 'id'=>'bio', 'placeholder'=>'Biography']) }}
            {!! $errors->first('bio', '<p class="help-block">:message</p>') !!}
          </div>      
      </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
          {{ Form::label('awards', 'Artist Awards') }}
        </div>
        <div class="col-sm-9">
          <div class="form-group {{ $errors->has('awards') ? 'has-error' : ''}}">
            {{ Form::textarea('awards', NULL, ['class' =>'form-control ckeditor', 'id'=>'awards', 'placeholder'=>'Awards Won']) }}
            {!! $errors->first('awards', '<p class="help-block">:message</p>') !!}
          </div>      
      </div>
    </div>

    <div class="row pb-3">
        <div class="col-sm-3">
          {{ Form::label('youtube_url', 'Youtube URL') }}
        </div>
        <div class="col-sm-9">          
          {{ Form::text('youtube_url', NULL, ['class' =>'form-control', 'id'=>'youtube_url', 'placeholder'=>'Youtube URL']) }}
          {!! $errors->first('youtube_url', '<p class="help-block">:message</p>') !!}       
          </div>      
      </div>
    </div>
    

    <div class="form-group text-center pt-3 pb-5">
      {{ Form::button(isset($artist)? 'Update Artist' : 'Save Artist' , ['class'=>'btn btn-success', 'type'=>'submit']) }}
    </div>
  </div>
</div>

