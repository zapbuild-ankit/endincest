@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT PROFILE') }}</div>

                <div class="card-body">
        <form method="POST" action="/updateprofile/$user->id" enctype="multipart/form-data">
    <div class="form-group hidden">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PATCH">
    </div>
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="email" class="control-label"><b>Name:</b></label>
        <input type="text" name="name" placeholder="Please enter your email here" class="form-control" value="{{ $user->name }}"/>

<?php if ($errors->has('name')):?>
<span class="help-block">
            <strong>{{$errors->first('name')}}</strong>
        </span>
<?php endif;?>
</div>
    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="control-label"><b>Email:</b></label>
        <input type="text" name="email" placeholder="Please enter your email here" class="form-control" value="{{ $user->email }}"/>

<?php if ($errors->has('email')):?>
<span class="help-block">
            <strong>{{$errors->first('email')}}</strong>
        </span>
<?php endif;?>
</div>
  <div class="form-group {{ $errors->has('profile_pic') ? ' has-error' : '' }}">
        <label for="profile_pic" class="control-label"><b>Profile Image:</b></label>
        <input type="file" name="profile_pic" placeholder="Upload Image" class="form-control" value="{{ $user->profile_pic }}"/>

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
@endsection
