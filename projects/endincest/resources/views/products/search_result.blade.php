@extends('layouts.app')

@section('title', 'Search Results')


@section('content')

    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

  @isset($products)
    @if(!$products->isEmpty())
<h3 class='text-center' style='margin-bottom: 40px' ><b>PRODUCTS</b></h3>
        <p class="search-results-count text-center">Showing {{ $products->total() }} results for "{{ request()->input('query') }}"</p>
<div class='container-fluid'>
        <div class='row'>
@foreach ($products as $product)
<div class='col-lg-3 col-lg-3 col-12'>
        <div class="card" style="width:200px">

<img src="{{ asset('/dist/img/products/' . $product->image)}}" style='height:100px;float: left;' class="img-circle elevation-2" alt="product Image">

<form method="post" action="{{route('add_to_wish_list',$product->id)}}">
  @csrf
<button type="submit" class="btn"  style="margin-left:15px; font-size:10px;"><i class="fa fa-heart-o"></i></button>
</form>

     <div class="card-body",id='table' >
        <h4 class="card-title">{{$product->name}}</h4>
       <p>{{$product->description}}</p>
       <i class='fa fa-rupee'>{{$product->price}}</i><br><br>
       @if($user)
       @if(!$carts->isEmpty())
        @foreach($carts as $cart)

       @if($product->id==$cart->product_id)

<span class="badge badge-success">Already added to cart</span>
       @endif
@endforeach

 @foreach($questions as $question)
       @if($question->id == $product->id)
<form method="post" action="{{route('add_to_cart',$product->id)}}">
        @csrf
       <button type="submit" style="margin-left:15px;" class="btn btn-sm btn-success"><i class="fa fa-cart-plus"></i>Add To Cart</button>
     </form>

       @endif
@endforeach

     @endif
     @if($carts->isEmpty())
     <form method="post" action="{{route('add_to_cart',$product->id)}}">
        @csrf
       <button type="submit" style="margin-left:15px;" class="btn btn-sm btn-success"><i class="fa fa-cart-plus"></i>Add To Cart</button>
     </form>
     @endif
     @endif
     @if(!$user)
       <form method="post" action="{{route('add_to_cart',$product->id)}}">
        @csrf
       <button type="submit" style="margin-left:15px;" class="btn btn-sm btn-success"><i class="fa fa-cart-plus"></i>Add To Cart</button>
     </form>
     @endif

</div>
        </div>
        <hr>
        </div>

@endforeach
</div>
</div>

@endif

@if($products->isEmpty())
<h2 class="text-center">Searched Product not Available</h2>
@endif
@endisset


    @endsection