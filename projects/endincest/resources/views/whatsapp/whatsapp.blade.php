@extends('layouts.admin')
@section('content')

<!-- whatsapp section starts here -->

     <div class="whatsapp-back">
        <div class="whatsapp">

            <section class="inner-wrapper">
                <div class="row">
                    <div class="col-3 ">
                  <h2 class="whatsapp-title">

                            <a href="" onClick="return popitup('https://app.chat-api.com/instance/144230/')"><span class="regular">What</span><span class="bold">s</span><span class="bold color-red">App</span><i class='fab fa-whatsapp' style='font-size:48px;color:green'></i></a>

                            </h2><p>CLick to scan QR</p>
                    </div>

                    <div class="col-5">
                        <div class="whatsapp-form-div ">


                            <div class="whatsapp-form">

                                <form class="custom-form" id="whatsapp" action="{{route('message')}}" method="POST">

                                    <div class="form-group">
                                    	@csrf

                                        <input class="form-control" name="number" id="number"type="text" placeholder="Enter Number with country code"/>
                                    </div>
                                    <div class="form-group">

                                        <textarea class="form-control" name="message" id="message" placeholder="Message"></textarea>
                                    </div>
                                    <div cen;="whatsapp-btn-div">

                                        <button class="btn btn-primary" id="whatsapp-btn"type="Submit">SEND MESSAGE</button>
                                    </div>

        <br>
	  <div id="success_message" class="ajax_response alert alert-success" style="display: none;">

    </div>
                                </form>
                            </div><br/>




                        </div>
                    </div>
                </div>
            </section>
        </div>
      </div>



        <!-- whatsapp section ends here -->

        <script>
             function popitup(url)
   {
    newwindow=window.open(url,'name','height=500,width=600,screenX=500,screenY=350');
    if (window.focus) {newwindow.focus()}
    return false;
   }
       $(document).ready(function(){

       $('#whatsapp').submit(function(e)
      {
           e.preventDefault();
        var number=$('#number').val();
        var message=$('#message').val();
      var _token = $('input[name=_token]').val();
      if(number != "" || message != "" ) {

        	$.ajax({
        url:'{{ route("message") }}',
        method:'POST',

        data:{"number":number,"message":message, _token:_token},
        dataType:"json",


        success:function(data)
        {
        	document.getElementById("whatsapp").reset();

         $('#success_message').fadeIn().html(data.success);
         setTimeout(function() {
					$('#success_message').fadeOut("slow");
				}, 2000 );

        }


      });

        }


    });


});
</script>
        </script>
@endsection