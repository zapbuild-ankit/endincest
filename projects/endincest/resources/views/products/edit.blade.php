@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT PRODUCT') }}</div>

                <div class="card-body">
        <form method="POST" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data" id='product_form_edit'>
    <div class="form-group hidden">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PATCH">
    </div>
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="control-label"><b>Name:</b></label>
        <input type="text" name="name" placeholder="Please enter Event name" class="form-control" value="{{ $product->name }}"/>

<?php if ($errors->has('name')):?>
<span class="help-block">
            <strong>{{$errors->first('name')}}</strong>
        </span>
<?php endif;?>
</div>

<div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
        <label for="category" class="control-label"><b>Category:</b></label>
        <input type="text" name="category" placeholder="Please enter  category" class="form-control" value="{{ $product->category }}"/>

<?php if ($errors->has('category')):?>
<span class="help-block">
            <strong>{{$errors->first('category')}}</strong>
        </span>
<?php endif;?>
<div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
        <label for="price" class="control-label"><b>Price:</b></label>

        <input type="text" name="price" placeholder="Please enter price" class="form-control" value="{{ $product->price }}"/>

<?php if ($errors->has('price')):?>
<span class="help-block">
            <strong>{{$errors->first('price')}}</strong>
        </span>
<?php endif;?>
<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="control-label"><b>Description:</b></label>
        <textarea name="description" form="product_form_edit"  class="form-control" placeholder="Please enter  Description">{{ $product->description }}</textarea>

<?php if ($errors->has('description')):?>
<span class="help-block">
            <strong>{{$errors->first('description')}}</strong>
        </span>
<?php endif;?>
<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">

        <label for="image" class="control-label form_image"><b>Image:</b></label>
        <input type="file" value='$product->image' class="" name="image" id="product_image"/>
        <img src="{{ asset('/dist/img/products/' . $product->image)}}" class="img-circle elevation-2 side-image" style="width:50px;margin-top:15px;"/>

<?php if ($errors->has('image')):?>
<span class="help-block">
            <strong>{{$errors->first('image')}}</strong>
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
     $(document).ready(function(){
$('input[type="file"]'). change(function(e){
$('.side-image').remove();
});
});
</script>

@endsection





