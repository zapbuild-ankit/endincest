@extends('layouts.app')
@section('title') Checkout @endsection
@section('content')

    <div class="container">

        @if (session()->has('success'))
            <div class="spacer"></div>
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="spacer"></div>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="checkout-heading stylish-heading text-center"><br>CHECKOUT</br></h1>
        <div class="checkout-section">
            <div>

            <div class="checkout-table-container">
                <h2>Your Order</h2>

                <div class="checkout-table">

                    <div class="checkout-table-row">
                        <div class="checkout-table-row-left">
                            <img src="{{ asset('/dist/img/products/' . $product->image)}}" alt="item" class="checkout-table-img">
                            <div class="checkout-item-details">
                                <div class="checkout-table-item">{{ $product->name }}</div>
                                <div class="checkout-table-description">{{ $product->description }}</div>

                            </div>
                        </div> <!-- end checkout-table -->


                    </div> <!-- end checkout-table-row -->


                </div> <!-- end checkout-table -->

                <div class="checkout-totals">
                    <div class="checkout-totals-left">
                        Total <br>
            @if (session()->has('coupon') && $product->id==session()->get('coupon')['id'])

                            Discount ({{ session()->get('coupon')['name'] }})

                             <form action="{{route('coupon_remove')}}" style="display:inline" method="POST">

                            @method('DELETE')
                            @csrf
                            <button type="submit" style="font-size:8px;">Remove</button>
                           </form>
                            <br>
                            <hr>
                        <span class="checkout-totals-total">New Total</span>
                        @endif



                    </div>

                    <div class="checkout-totals-right">
                        <i class='fa fa-rupee'>{{$product->price}}</i><br>
             @if (session()->has('coupon') && $product->id==session()->get('coupon')['id'])

                            @if(session()->get('coupon')['type']=='Fixed')
                           <i class="fa fa-rupee">{{ session()->get('coupon')['discount'] }}</i>
                           @endif
                            @if(session()->get('coupon')['type']=='Percent')
                           {{ session()->get('coupon')['discount'] }}%
                           @endif
                            <br>
                            <hr>
                            <i class="fa fa-rupee">{{session()->get('coupon')['new_total']}}</i>
                            <br>
                        @endif

                        <span class="checkout-totals-total"></span>

                    </div>
                </div> <!-- end checkout-totals -->
             <br>
             <div class="have-code-container">
         @if (!session()->has('coupon') || $product->id!=session()->get('coupon')['id'] )
                <a data-target="#editCoupon" data-toggle="modal" href="#editCoupon" id ="coupon_list" class="have-code">Have a Coupon code?</a>

                <form action="{{route('coupon_check',$product->id)}}"  method="post"id='coupon_fields'>
                    @csrf
                    <input type="text" name="coupon_code" id="coupon_code">
                    <button type="submit" class="button button-plain">Apply</button>
                </form>

            </div>
            <!--end have-code container-->
            @endif
            <br>
            <div class="payment">
                <button data-target="#BillingAddress" data-toggle="modal"  class="btn btn-sm btn-block btn-success button">PLACE ORDER</button>

         </div>

            </div>

        </div> <!-- end checkout-section -->
    </div>
</div>
<div class="modal fade" id="editCoupon">
<div class="modal-dialog">
    <div class="modal-content" style="margin-top: 100px;">
        <div class="modal-header bg-primary">
             <h4 class="modal-title float-left">Available Coupons</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

            </div>
        <form class="form-horizontal" action="#" method="POST" id="coupon_field">
                <div class="modal-body">
                    @csrf

                </div>      @if(!$coupons->isEmpty())
                            @foreach($coupons as $coupon)
                            <input type="checkbox" id="coupon_id" name="coupon_code" value="{{$coupon->code}}" style="margin-left:20px;">
                            <b style="margin-left:20px;">{{$coupon->code}}<b><br>
                                @if($coupon->type=="Fixed")
                                <b style="margin-left:40px;">Save Rs {{$coupon->value}}</b>
                                @endif
                                @if($coupon->type=="Percent")
                                <b style="margin-left:40px;">Save {{$coupon->percent_off}} %</b>
                                @endif
                                <br><hr>
                            @endforeach

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Apply Coupon </button>
                </div>
                @endif
                   @if($coupons->isEmpty())
        <h3 style="margin-left:80px;">No Coupons Available For You<h3>
            @endif
            </form>


        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.End modal coupon-->


<!-- /. modal Billing starts here-->
<div class="modal fade" id="BillingAddress">

<div class="modal-dialog">
    <div class="modal-content" style="margin-top: 10px;">
        <div class="modal-header bg-primary">
             <h4 class="modal-title float-left">Billing Address</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

            </div>
            <form class="form-horizontal" action="#" method="POST" id="orders">
               @csrf
                <div class="modal-body">

                 <div class="form-group"> <!-- Full Name -->
    <label for="full_name_id" class="control-label">Full Name</label>
    <input type="text" class="form-control" id="full_name_id" name="name" placeholder="Enter your name">
  </div>

 <div class="form-group"> <!-- Mobile-->
    <label for="phone" class="control-label">Mobile No.</label>
    <input type="text" class="form-control" id="phone_id" name="phone" placeholder="Mobile No." >
  </div>
  <div class="form-group"> <!-- Street 1 -->
    <label for="street1_id" class="control-label">Street Address 1</label>
    <input type="text" class="form-control" id="street1_id" name="street1" placeholder="Street address, P.O. box, company name, c/o" >
  </div>

  <div class="form-group"> <!-- Street 2 -->
    <label for="street2_id" class="control-label">Street Address 2 (optional)</label>
    <input type="text" class="form-control" id="street2_id" name="street2" placeholder="Apartment, suite, unit, building, floor, etc." >
  </div>

  <div class="form-group"> <!-- City-->
    <label for="city_id" class="control-label">City</label>
    <input type="text" class="form-control" id="city_id" name="city" placeholder="City/Village" >
  </div>

  <div class="form-group"> <!-- State Button -->
    <label for="state_id" class="control-label">State</label>
    <select class="form-control" id="state_id" name="state" >
      <option value="" disabled selected hidden>Select State</option>
      <option value="bihar">Bihar</option>
      <option value="Uttar pradesh">Uttar pradesh</option>
      <option value="Uttarakhand">Uttarakhand</option>
      <option value="West bengal">West Bengal</option>
      <option value="Odisha">Odisha</option>
      <option value="Chhattisgarh">Chhattisgarh</option>
      <option value="Delhi">Delhi</option>
      <option value="Punjab">Punjab</option>
      <option value="Haryana">Haryana</option>
      <option value="Himachal pradesh">Himachal pradesh</option>
      <option value="Jammu & kashmir">Jammu & kashmir</option>
      <option value="Rajasthan">Rajasthan</option>
      <option value="Gujrat">Gujrat</option>
      <option value="Madhya pradesh">Madhya pradesh</option>
      <option value="Maharastra">Maharastra</option>
      <option value="Tamilnadu">Tamilnadu</option>
      <option value="Telangana">Telangana</option>
      <option value="Andhra pradesh">Andhra pradesh</option>
      <option value="Goa">Goa</option>
      <option value="manipur">manipur</option>
      <option value="Assam">Assam</option>
      <option value="Meghalya">Meghalya</option>
      <option value="Nagaland">Nagaland</option>
      <option value="Sikkim">Sikkim</option>
      <option value="Kerala">Kerala</option>
      <option value="Karnataka">Karnataka</option>
      <option value="Jharkhand">Jharkhand</option>
      <option value="Arunchal pradesh">Arunchal pradesh</option>
      <option value="Tripura">Tripura</option>
      <option value="Mizoram">Mizoram</option>
    </select>
  </div>

  <div class="form-group"> <!-- Zip Code-->
    <label for="zip_id" class="control-label">Zip Code</label>
    <input type="text" class="form-control" id="zip_id" name="zip" placeholder="######">
  </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-paypal"></i> Pay with Paypal </button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>

$(document).on("click", "#BillingAddress", function () {


       $("#orders").attr('action', "{{route('paypal_payment',$product->id)}}");
   });


$(document).on("click", "#editCoupon", function () {
$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {

    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
$("#coupon_field").attr('action', "{{route('coupon_check',$product->id)}}");
   });
</script>
@endsection

