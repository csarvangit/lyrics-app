
@if ($message = Session::get('success'))
      <div class="alert alert-success">
          <p>{{ $message }}</p>
      </div>
    @endif

<div class="row">
  <div class="col-md-12">

    <div class="row">
      <div class="col-sm-4">
        {{ Form::label('name', 'Movie Name') }}
      </div>
      <div class="col-sm-8">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
          {{ Form::text('name', NULL, ['class' =>'form-control', 'id'=>'name', 'placeholder'=>'Movie Name']) }}
          {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
          
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
      {{ Form::label('year', 'Year') }}
      </div>
      <div class="col-sm-8">    
  
      <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
        {{ Form::selectYear('year', 1970, date('Y'), $movie->year ?? date('Y'), ['class' =>'form-control form-select','id'=>'year', 'placeholder'=>'Please Select Year']) }}
        {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
      </div>
    </div> 


    <div class="row">
      <div class="col-sm-4">
      {{ Form::label('image_path', 'Upload Movie Image') }}
      </div>
      <div class="col-sm-8">
        <div class="form-group {{ $errors->has('image_path') ? 'has-error' : ''}}">
          {{ Form::file('image_path', NULL, ['class'=>'form-control', 'id'=>'image_path']) }}
          {!! $errors->first('image_path', '<p class="help-block">:message</p>') !!}
        </div>
        @php
        if( isset($movie) ) {
           $img_path =  URL::to('/uploads/movies/' .  $movie->image_path) ?? null;
        } else {  
           $img_path = null;
        }
        @endphp
         
        <div class="col-sm-4 pb-3">
          <img class="thumb-preview" src="{{ $img_path }}" alt=""> 
        </div>     

      </div>
    </div>

    <div class="form-group">
      {{ Form::button(isset($movie)? 'Update' : 'Save' , ['class'=>'btn btn-success pull-right', 'type'=>'submit']) }}
    </div>
  </div>
</div>

