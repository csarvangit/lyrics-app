
@if ($message = Session::get('success'))
      <div class="alert alert-success">
          <p>{{ $message }}</p>
      </div>
    @endif

<div class="row">
  <div class="col-md-12">

    <div class="row">
      <div class="col-sm-4">
        {{ Form::label('name', 'Music Director Name') }}
      </div>
      <div class="col-sm-8">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
          {{ Form::text('name', NULL, ['class' =>'form-control', 'id'=>'name', 'placeholder'=>'Music Director Name']) }}
          {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
          
        </div>
      </div>
    </div>   

    <div class="row">
        <div class="col-sm-4">
          {{ Form::label('bio', 'Music Director Biography') }}
        </div>
        <div class="col-sm-8">
          <div class="form-group {{ $errors->has('bio') ? 'has-error' : ''}}">
            {{ Form::textarea('bio', NULL, ['class' =>'form-control ckeditor', 'id'=>'bio', 'placeholder'=>'Biography']) }}
            {!! $errors->first('bio', '<p class="help-block">:message</p>') !!}
          </div>      
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
      {{ Form::label('image_path', 'Upload Music Director Image') }}
      </div>
      <div class="col-sm-8">
        <div class="form-group {{ $errors->has('image_path') ? 'has-error' : ''}}">
          {{ Form::file('image_path', NULL, ['class'=>'form-control', 'id'=>'image_path']) }}
          {!! $errors->first('image_path', '<p class="help-block">:message</p>') !!}
        </div>

        @php
        if( isset($music_directors) ) {
           $img_path =  URL::to('/public/uploads/music-directors/' .  $music_directors->image_path) ?? null;
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
        <div class="col-sm-4">
          {{ Form::label('awards', 'Music Director Awards') }}
        </div>
        <div class="col-sm-8">
          <div class="form-group {{ $errors->has('awards') ? 'has-error' : ''}}">
            {{ Form::textarea('awards', NULL, ['class' =>'form-control ckeditor', 'id'=>'awards', 'placeholder'=>'Awards Won']) }}
            {!! $errors->first('awards', '<p class="help-block">:message</p>') !!}
          </div>      
      </div>
    </div>

    <div class="row pb-3">
        <div class="col-sm-4">
          {{ Form::label('youtube_url', 'Youtube URL') }}
        </div>
        <div class="col-sm-8">          
          {{ Form::text('youtube_url', NULL, ['class' =>'form-control', 'id'=>'youtube_url', 'placeholder'=>'Youtube URL']) }}
          {!! $errors->first('youtube_url', '<p class="help-block">:message</p>') !!}       
          </div>      
      </div>
    </div>

    <div class="form-group">
      {{ Form::button(isset($music_directors)? 'Update' : 'Save' , ['class'=>'btn btn-success', 'type'=>'submit']) }}
    </div>
  </div>
</div>

