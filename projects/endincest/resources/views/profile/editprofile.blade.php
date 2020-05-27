@extends('layouts.admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <script src='http://parsleyjs.org/dist/parsley.js'></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT PROFILE') }}</div>

                <div class="card-body">
        <form method="POST" action="/updateprofile" enctype="multipart/form-data" id='form'>
    <div class="form-group hidden">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PATCH">
    </div>
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="control-label"><b>Name:</b></label>
        <input type="text" name="name" placeholder="Please enter your name here" class="form-control" value="{{ $user->name }}" required data-parsley-pattern="[a-zA-Z]+$"data-parsley-trigger="keyup"/>

<?php if ($errors->has('name')):?>
<span class="help-block">
            <strong>{{$errors->first('name')}}</strong>
        </span>
<?php endif;?>
</div>
    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="control-label"><b>Email:</b></label>
        <input type="email" name="email" placeholder="Please enter your email here" class="form-control" value="{{ $user->email }}" required data-parsley-trigger="keyup"/>

<?php if ($errors->has('email')):?>
<span class="help-block">
            <strong>{{$errors->first('email')}}</strong>
        </span>
<?php endif;?>
</div>
  <div class="form-group {{ $errors->has('profile_pic') ? ' has-error' : '' }}">
        <label for="profile_pic" class="control-label"><b>Profile Image:</b></label>
        <input type="file" name="profile_pic" placeholder="Upload Image" class="form-control" value="{{ $user->profile_pic }}"required data-parsley-trigger="keyup"/>

<?php if ($errors->has('profile_pic')):?>
<span class="help-block">
            <strong>{{$errors->first('profile_pic')}}</strong>
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

<script src="{{ asset('js/validation.js')}}"></script>
@endsection





