@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Product') }}</div>

                <div class="card-body">
        <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data" id='product_form'>
    <div class="form-group hidden">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

    </div>
    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="control-label"><b>Product Name:</b></label>
        <input type="text" name="name" placeholder="Please enter product name" class="form-control"/>

<?php if ($errors->has('name')):?>
<span class="help-block">
            <strong>{{$errors->first('name')}}</strong>
        </span>
<?php endif;?>
</div>

<div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
        <label for="category" class="control-label"><b>Category:</b></label>
        <input type="text" name="category" placeholder="Please enter category " class="form-control"/>

<?php if ($errors->has('category')):?>
<span class="help-block">
            <strong>{{$errors->first('category')}}</strong>
        </span>
<?php endif;?>
</div>
<div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
        <label for="price" class="control-label"><b>Price:</b></label>
        <input type="text" name="price" placeholder="Please enter  price " class="form-control"/>

<?php if ($errors->has('price')):?>
<span class="help-block">
            <strong>{{$errors->first('price')}}</strong>
        </span>
<?php endif;?>
</div>


  <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
        <label for="image" class="control-label"><b>Image:</b></label>
        <input type="file" name="image" id="product_image" placeholder="Upload Image" class="form-control"/>

<?php if ($errors->has('image')):?>
<span class="help-block">
            <strong>{{$errors->first('image')}}</strong>
        </span>
<?php endif;?>
</div>
  <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="control-label"><b>Description:</b></label>
        <textarea name="description" form="product_form" placeholder="Please enter  Description " class="form-control"></textarea>

<?php if ($errors->has('description')):?>
<span class="help-block">
            <strong>{{$errors->first('description')}}</strong>
        </span>
<?php endif;?>
</div>

    <div class="form-group">
        <button type="submit" id= "btn" class="btn btn-default"> Submit </button>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection





