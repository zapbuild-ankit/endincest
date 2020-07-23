@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT COUPON') }}</div>

                <div class="card-body">
        <form method="POST" action="{{route('coupons.update',$coupon->id)}}" id='coupon_form'>
    <div class="form-group hidden">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PATCH">
    </div>
    <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
        <label for="name" class="control-label"><b>Coupon Type:</b></label>
        <select name="type" class="form-control coupon" id="type" >
            <option value="{{$coupon->type}}">{{$coupon->type}}</option>
            @if($coupon->type == 'Fixed')
            <option value="Percent">Percent</option>
            @endif
            @if($coupon->type == 'Percent')
            <option value="Fixed">Fixed</option>
            @endif
        </select>

<?php if ($errors->has('type')):?>
<span class="help-block">
            <strong>{{$errors->first('type')}}</strong>
        </span>
<?php endif;?>
</div>

<div class="form-group value {{ $errors->has('value') ? ' has-error' : '' }}">
        <label for="value" class="control-label"><b>Fixed Value:</b></label>
        <input type="text" name="value" placeholder="Please enter Fixed Value" class="form-control" value="{{ $coupon->value }}"/>

<?php if ($errors->has('value')):?>
<span class="help-block">
            <strong>{{$errors->first('value')}}</strong>
        </span>
<?php endif;?>
</div>
<div class="form-group percent {{ $errors->has('percent_off') ? ' has-error' : '' }}">
        <label for="percent_off" class="control-label"><b>Percent Off:</b></label>

        <input type="text" name="percent_off" placeholder="Please enter percent off" class="form-control" value="{{ $coupon->percent_off }}"/>

<?php if ($errors->has('percent_off')):?>
<span class="help-block">
            <strong>{{$errors->first('percent_off')}}</strong>
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
</div>
@endsection





