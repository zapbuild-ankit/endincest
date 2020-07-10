@extends('layouts.app')
@section('title') Cart @endsection
@section('content')
@if(!empty($products))
<h3 class='text-center' style='margin-bottom: 40px' ><b>MY CART</b></h3>
<div class='container-fluid'>
  <h2 class="text-center">Products in Your Cart</h2>
        <div class='row'>
<?php $endpoint = 0?>
@foreach ($products as $product)

<div class='col-lg-3 col-lg-3 col-12'>
        <div class="card" style="width:250px">
<img src="{{ asset('/dist/img/products/' . $product->image)}}" style='height:100px;float: left;' class="img-circle elevation-2" alt="product Image">

<form method="post" action="{{route('addtowishlist',$product->id)}}">
  @csrf
<button type="submit" class="btn"  style="margin-left:15px; font-size:10px;"><i class="fa fa-heart-o"></i></button>
</form>


     <div class="card-body",id='table' >
        <h4 class="card-title">{{$product->name}}</h4>
       <p>{{$product->description}}</p>
       <i class='fa fa-rupee'>{{$product->price}}</i>
<i class='fa fa-cart-plus' style="margin-left:20px;">:-
        {{$quantity[$endpoint]}}</i>
<?php $endpoint++?>
<i class="glyphicon glyphicon-plus-sign"></i>
<br><br>
       <div class="button">
       <form method="" action="#">

       <button type="submit"  class="btn btn-sm btn-success button">BUY NOW</button>
     </form>

     <form  method="post" action="{{route('removecart',$product->id)}}">
      @csrf
       <button type="submit" class="btn btn-sm btn-danger button" onclick="return confirm('Are you sure, Want to Delete?')"><i class="fa fa-trash"></i></button>
     </form>
     <style type="text/css" media="screen">
      .button form{
  float:left;
  margin: 12px;
       }
     </style>

</div>

</div>

        </div>
        </div>

@endforeach


</div>
</div>
@endif
@if(empty($products))
	<h2 align="center">No Product added to cart</h2>
@endif
@endsection
