@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT EVENT') }}</div>

                <div class="card-body">
        <form method="POST" action="{{route('updateevent',$event->id)}}" enctype="multipart/form-data" id='form'>
    <div class="form-group hidden">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PATCH">
    </div>
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="control-label"><b>Name:</b></label>
        <input type="text" name="name" placeholder="Please enter Event name" class="form-control" value="{{ $event->name }}" required data-parsley-pattern="[a-zA-Z]+$"data-parsley-trigger="keyup"/>

<?php if ($errors->has('name')):?>
<span class="help-block">
            <strong>{{$errors->first('name')}}</strong>
        </span>
<?php endif;?>
</div>
    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="control-label"><b>Description:</b></label>
        <input type="text" name="description" placeholder="Please enter your description here" class="form-control" value="{{ $event->description }}" required data-parsley-trigger="keyup"/>

<?php if ($errors->has('description')):?>
<span class="help-block">
            <strong>{{$errors->first('description')}}</strong>
        </span>
<?php endif;?>
<div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
        <label for="location" class="control-label"><b>Location:</b></label>
        <input type="text" name="location" placeholder="Please enter  location here" class="form-control" value="{{ $event->location }}" required data-parsley-trigger="keyup"/>

<?php if ($errors->has('location')):?>
<span class="help-block">
            <strong>{{$errors->first('location')}}</strong>
        </span>
<?php endif;?>
<div class="form-group {{ $errors->has('speaker') ? ' has-error' : '' }}">
        <label for="speaker" class="control-label"><b>Speaker:</b></label>
        <input type="text" name="speaker" placeholder="Please enter your speaker here" class="form-control" value="{{ $event->speaker }}" required data-parsley-trigger="keyup"/>

<?php if ($errors->has('speaker')):?>
<span class="help-block">
            <strong>{{$errors->first('speaker')}}</strong>
        </span>
<?php endif;?>
<div class="form-group {{ $errors->has('begining') ? ' has-error' : '' }}">
        <label for="begining" class="control-label"><b>Begining:</b></label>
        <input type="text" name="start_date" placeholder="Please Enter Begining Date and Time" class="form-control datetimepicker" value="{{ $event->start_date}}" required data-parsley-trigger="keyup"/>

<?php if ($errors->has('begining')):?>
<span class="help-block">
            <strong>{{$errors->first('begining')}}</strong>
        </span>
<?php endif;?>
</div>

<div class="form-group {{ $errors->has('ending') ? ' has-error' : '' }}">
        <label for="ending" class="control-label"><b>Ending:</b></label>
        <input type="text" name="end_date" placeholder="Please enter Ending Date and Time" class="form-control datetimepicker" value="{{ $event->end_date }}" required data-parsley-trigger="keyup"/>

<?php if ($errors->has('ending')):?>
<span class="help-block">
            <strong>{{$errors->first('ending')}}</strong>
        </span>
<?php endif;?>
</div>
  <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
        <label for="image" class="control-label"><b>Image:</b></label>
        <input type="file" name="image" placeholder="Upload Image" class="form-control" value="{{ $event->image }}" required data-parsley-trigger="keyup"/>

<?php if ($errors->has('image')):?>
<span class="help-block">
            <strong>{{$errors->first('image')}}</strong>
        </span>
<?php endif;?>
</div>
<div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">

        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Status<span class="required">*</span></label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="radio">
                <label>
                    <input type="radio" class="flat" required='required' value="Upcoming" name="status">
                    Upcoming
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" class="flat" required='required' value="Begins" name="status">
                    Begins
                </label>
                <div class="radio">
                <label>
                    <input type="radio" class="flat" required='required' value="Over" name="status">
                    Over
                </label>
            </div>
            </div>
        </div>
    </div>


<?php if ($errors->has('status')):?>
<span class="help-block">
            <strong>{{$errors->first('status')}}</strong>
        </span>
<?php endif;?>
</div>
    <div class="form-group">
        <button type="submit" class="btn btn-default"> Submit </button>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
 $(".datetimepicker").datetimepicker({
       dateFormat: 'yy-mm-dd',
       timeFormat: 'hh:mm:ss',
      });

</script>
<script>
$('#btn').click(function () {
    if ($('input[name=status]:checked').length <= 0) {
        $('input[name=status]').css('outline', '1px solid red');
    }
    else {
        $('input[name=status]').css('outline', 'none');

    }
});
</script>
@endsection





