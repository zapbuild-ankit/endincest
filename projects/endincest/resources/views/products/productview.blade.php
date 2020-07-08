@extends('layouts.app')
@section('title') Products @endsection
@section('content')
@if(!empty($products))
<h3 class='text-center' style='margin-bottom: 40px' ><b>PRODUCTS</b></h3>
<div class='container-fluid'>
        <div class='row'>
@foreach ($products as $product)
<div class='col-lg-3 col-lg-3 col-12'>
        <div class="card" style="width:200px">

<img src="{{ asset('/dist/img/products/' . $product->image)}}" style='height:100px;float: left;' class="img-circle elevation-2" alt="product Image">

<form method="post" action="{{route('addtowishlist',$product->id)}}">
  @csrf
<button type="submit" class="btn"  style="margin-left:15px; font-size:10px;"><i class="fa fa-heart-o"></i></button>
</form>

     <div class="card-body",id='table' >
        <h4 class="card-title">{{$product->name}}</h4>
       <p>{{$product->description}}</p>
       <i class='fa fa-rupee'>{{$product->price}}</i><br><br>

       <form method="post" action="{{route('addtocart',$product->id)}}">
        @csrf
       <button type="submit" style="margin-left:15px;" class="btn btn-sm btn-success"><i class="fa fa-cart-plus"></i>Add To Cart</button>
     </form>



</div>
        </div>
        </div>

@endforeach
</div>
</div>
@endif
@if (empty($products))
<h2 class="text-center">No Products Available</h2>
@endif
@endsection
