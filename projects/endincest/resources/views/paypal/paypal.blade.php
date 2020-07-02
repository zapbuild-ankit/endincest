@extends('layouts.admin')
@section('content')
<!--<script
    src="https://www.paypal.com/sdk/js?client-id=client-id"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
  </script>

  <div id="paypal-button-container"></div>

  <script>
    paypal.Buttons().render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
  </script>
-->

  <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .content {
                margin-top: 50px;
                text-align: center;
            }
        </style>


   <div class="flex-center position-ref full-height">

            <div class="content">


                <table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/in/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/in/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-200px.png" border="0" alt="PayPal Logo"></a></td></tr></table>


            </div>
        </div>

                <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Pay with paypal
                        </div>
                        <div class="card-body">
                            <form method="POST" id="paypal_amount" action="{{route('payment')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Enter Amount</label>
                                    <input type="text" class="form-control" name="amount" placeholder="Enter Amount">
                                </div>
                                <button type="submit" class="btn btn-primary">Pay with Paypal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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



  @endsection
