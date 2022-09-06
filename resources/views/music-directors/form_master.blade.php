
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
      {{ Form::label('image_path', 'Upload Music Director Image') }}
      </div>
      <div class="col-sm-8">
        <div class="form-group {{ $errors->has('image_path') ? 'has-error' : ''}}">
          {{ Form::file('image_path', NULL, ['class'=>'form-control', 'id'=>'image_path']) }}
          {!! $errors->first('image_path', '<p class="help-block">:message</p>') !!}
        </div>
      </div>
    </div>

    <div class="form-group">
      {{ Form::button(isset($model)? 'Update' : 'Save' , ['class'=>'btn btn-success', 'type'=>'submit']) }}
    </div>
  </div>
</div>

