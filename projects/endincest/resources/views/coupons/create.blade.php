@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Coupon') }}</div>

                <div class="card-body">
        <form method="POST" action="{{route('coupons.store')}}" enctype="multipart/form-data" id='coupon_form'>
    <div class="form-group hidden">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

    </div>
    <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
        <label for="name" class="control-label"><b>Coupon Type:</b></label>
        <select class="form-control coupon" name="type" id="type">
            <option value="" disabled selected hidden>Select coupon type</option>
            <option value="Fixed">Fixed</option>
            <option value="Percent">Percent</option>
        </select>

<?php if ($errors->has('type')):?>
<span class="help-block">
            <strong>{{$errors->first('type')}}</strong>
        </span>
<?php endif;?>
</div>

<div class="form-group value {{ $errors->has('value') ? ' has-error' : '' }}" >
        <label for="value"   class="control-label"><b>Value:</b></label>
        <input type="text" name="value" placeholder="Please enter value" class="form-control"/>

<?php if ($errors->has('value')):?>
<span class="help-block">
            <strong>{{$errors->first('value')}}</strong>
        </span>
<?php endif;?>
</div>
<div class="form-group percent {{ $errors->has('percent_off') ? ' has-error' : '' }}">
        <label for="percent_off" class="control-label"><b>Percent off:</b></label>
        <input type="text" name="percent_off" placeholder="Please enter  percent off " class="form-control"/>

<?php if ($errors->has('percent_off')):?>
<span class="help-block">
            <strong>{{$errors->first('percent_off')}}</strong>
        </span>
<?php endif;?>
</div>


    <div class="form-group">
        <button type="submit" id= "btn" class="btn btn-default"> Create </button>
    </div>
</form>
<script>
$(document).ready(function(){
    $("select.coupon").change(function(){
        var selectedValue = $(this).children("option:selected").val();
        if(selectedValue=='Percent')
        {

                 $('.value').fadeOut();
                 $('.percent').fadeIn();

        }

        if(selectedValue=='Fixed')
        {

                 $('.percent').fadeOut();
                 $('.value').fadeIn();

        }

    });
});
</script>

                </div>
            </div>
        </div>
    </div>
</div>





@endsection





