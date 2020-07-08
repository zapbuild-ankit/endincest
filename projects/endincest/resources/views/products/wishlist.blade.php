@extends('layouts.app')
@section('title') Wishlist @endsection
@section('content')
@if(!empty($products))
<h3 class='text-center' style='margin-bottom: 40px' ><b>YOUR WISHLIST</b></h3>
<div class='container-fluid'>
        <div class='row'>
@foreach ($products as $product)
<div class='col-lg-3 col-lg-3 col-6'>
        <div class="card" style="width:200px">

<img src="{{ asset('/dist/img/products/' . $product->image)}}" style='height:100px;float: left;' class="img-circle elevation-2" alt="product Image">
     <div class="card-body",id='table' >
        <h4 class="card-title">{{$product->name}}</h4>
       <p>{{$product->description}}</p>
       <i class='fa fa-rupee'>{{$product->price}}</i><br><br>
        <div class="button">
       <form method="" action="#">

       <button type="submit"  class="btn btn-sm btn-success button">BUY NOW</button>
     </form>

     <form method="post" action="{{route('removewish',$product->id)}}">
      @csrf
       <button type="submit" class="btn btn-sm btn-danger button"><i class="fa fa-trash"></i></button>
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
@if (empty($products))
	<h2 class="text-center">No Product Added To Wishlist</h2>
@endif
@endsection
