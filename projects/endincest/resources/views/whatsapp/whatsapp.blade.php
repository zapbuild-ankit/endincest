@extends('layouts.admin')
@section('content')
<!-- whatsapp section starts here -->


        <div class="whatsapp">
            <section class="inner-wrapper">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="whatsapp-img">
                            <img src="{{ asset('dist/img/whats.png') }}" alt="whatsapp" class="img-responsive" width="724" height="600" />
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="whatsapp-form-div">
                            <h2 class="whatsapp-title"><span class="regular">What</span><span class="bold">AN</span><span class="bold color-red">App</span></h2>
                            <div class="whatsapp-form">
                                <form class="custom-form" id="whatsapp" action="{{route('message')}}" method="POST">

                                    <div class="form-group">
                                    	@csrf
                                        <input class="form-control" name="number" id="number"type="text" placeholder="Enter Number with country code"/>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="whatsapp-btn-div">

                                        <button class="btn btn-primary" id="whatsapp-btn"type="Submit">SEND MESSAGE</button>
                                    </div>


	  <div id="success_message" class="ajax_response" style="float:left"></div>
                                </form>
                            </div><br/>



                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- whatsapp section ends here -->

        <script>
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