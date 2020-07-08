<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'endincest') }}</title>

     <!-- Fonts -->
     <!-- Font Awesome -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome/4.7.0/css/font-awesome.min.css') }}"/>

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->


    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

   <script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v7.0&appId=301891977876068&autoLogAppEvents=1" nonce="qXvuX05J"></script>





</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'endincest') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                         <li class="nav-item">
                       <a href="{{route('cart')}}" class="nav-link"><i class="fa fa-shopping-cart"></i>Cart</a>
                     </li>
                        <li class="nav-item">
                          <a href="{{route('wishlist')}}" class="nav-link"><i class="fa fa-heart"></i>Wishlist</a>
                        </li>
                        <li class="nav-item">
                        <a href="{{route('productview')}}" class="nav-link"><i class=""></i>Products</a>
                      </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            @yield('content')
        </main>
    </div>
<script>


        $.validator.addMethod("letters_numbers_special", function(value, element) {
            return this.optional(element) || /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})/.test(value);
        }, "");

        jQuery.validator.addMethod("noSpace", function(value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "No space please and don't leave it empty");

        $.validator.addMethod('filesize', function (value, element, param) {
            console.log(element.files[0].size);
             return this.optional(element) || (element.files[0].size <= param)
        }, 'File size must be less than {0}');

        /*add only letters validation*/
        $.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        });
        $.validator.addMethod("onlyCharacter", function (value, element) {
            return /^(?!\d+$)(?:[a-zA-Z ]*)?$/.test(value);
        }, "Please enter character only"),

        $.validator.addMethod("valid_contact_number", function (value, element) {
                return /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/.test(value);
            }, "Please enter valid contact number"),

        $.validator.addMethod("removeHtml", function (value, element) {
                return /^[a-zA-Z0-9 !@#$&()\\-`.+,/\"]*$/.test(value);
            }, "Please enter character only");
        //Login Validation
        $("#login_form").validate({
            rules: {

                email: {
                    required: true,
                    email:true

                },
                password:{
                    required:true,
                    letters_numbers_special:true,
                    noSpace:true,
                },
            },
            messages:{

                email: {
                    required: "Please enter Email",
                    email:"Please fill correct email."
                },
                password: {
                    required:"Please enter password.",
                    letters_numbers_special:"Password must contain one special character,uppercase and number.",

                },

            },
                submitHandler: function(form) {
                    form.submit();
                }
        });


        </script>
        <script src="{{asset('js/app.js')}}"></script>

       <script>

  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();
     // window.location.replace('http://localhost:8000/feeds.blade.php');
    } else {                                 // Not logged into your webpage or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '301891977876068',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v7.0'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };


  (function(d, s, id) {                      // Load the SDK asynchronously
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
 js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));


  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });

    FB.api(
  '/105339511224506/feed?fields=id,story,attachments{media}&limit=25',
  'GET',

  function(response) {
      console.log(response);
  }
);
     document.getElementById('fb').innerHTML =
        '' + response + '!';
  }

</script>


<div id="status">
</div>
<div id ="fb">
    </div>
</body>
</html>
