@extends('layouts.app')
@section('title') Products @endsection
@section('content')
@if(!$products->isEmpty())
 @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

             @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
<h3 class='text-center' style='margin-bottom: 40px' ><b>PRODUCTS</b></h3>
<div class='container-fluid' >
  @csrf
        <div class='row' id='products'>
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

@if($Allproducts_count>6)
<button class="btn btn-lg btn-success see-more " id="load-btn"  data-page="2" data-link="http://localhost:8000/product_view?page=" data-div="#products" data-all=<?=$Allproducts_count?>>Load more</button>
@endif
@endif
@if($products->isEmpty())
<h2 class="text-center">No Products Available</h2>
@endif
<script>
  $(".see-more").click(function() {
  $div = $($(this).attr('data-div')); //div to append
  $link = $(this).attr('data-link'); //current URL
  $product_count = $(this).attr('data-all'); //total product count

  $page = $(this).attr('data-page'); //get the next page #

  $href = $link + $page; //complete URL
  $.get($href, function(response) { //append data

    $html = $(response).find("#products").html();
    $div.append($html);
  });

  $(this).attr('data-page', (parseInt($page) + 1)); //update page #
if($product_count<=6*$page)
{
$('#load-btn').remove();
}
});
</script>
@endsection
