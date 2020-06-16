
var map;
var myLatLng;
$(document).ready(function()

{

	geoLocationInit();

	function geoLocationInit()
	{
        if(navigator.geolocation)
        {
        	navigator.geolocation.getCurrentPosition(success,fail);
        }

        else{
        	console.log('Browser not supported');
        }
	}

	function success(position)
	{
		var latval=position.coords.latitude;
		var lngval=position.coords.longitude;
	   myLatLng=new google.maps.LatLng(latval,lngval);
		createMap(myLatLng);
		nearbySearch(myLatLng,"school");
	}

	function fail()
	{
		console.log('Failed');
	}

 myLatLng=new google.maps.LatLng(-33.6,151.2);

function createMap(myLatLng)
{

	 map=new google.maps.Map(document.getElementById('map'),
{
   center:myLatLng,
   
   zoom:8

});
	 var marker=new google.maps.Marker({

	 	position:myLatLng,
	 	map:map,
	 	
	 });

}



function createMarker(latlng,icn,name){

var marker = new google.maps.Marker({


	position:latlng,
	map:map,
	icon:icn,
	title:name
});

}



function nearbySearch(myLatLng,type)
{

	var request ={

	location : myLatLng,
	radius:'2500',
	types:[type]
};

service = new google.maps.places.PlacesService(map);
service.nearbySearch(request,callback);

function callback(results,status){


if(status==google.maps.places.PlacesServiceStatus.OK)
{
	for(var i=0;i<results.length;i++)
	{
         var place= results[i];


         latlng=place.geometry.location;
           
         icn="https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
         name=place.name;
         createMarker(latlng,icn,name);
	}


}

}

}

$('#find').submit(function(e)
{

e.preventDefault();
var cityval=$('#city').val();
            
var _token = $('input[name=_token]').val();
 $.ajax({
        url:"location_coords",
        method:'POST',

        data:{"city":cityval,_token:_token},
        dataType:"json",

        success:function(match){

        	if($.isEmptyObject(match.error)){

             $('.print-error-msg').remove();
            var myLatLng=new google.maps.LatLng(match[0],match[1]);

        	createMap(myLatLng);
        	type='school';
        	icn="https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png"

        	nearbySearch(myLatLng,type);	
        	createMarker(myLatLng,icn,name);
        	nearbySearch(myLatLng,type);
        	}

        	else{
        		printErrorMsg(match.error);
        	}
      }



        });


});


  function printErrorMsg (msg) {

            $(".print-error-msg").find("ul").html('');

            $(".print-error-msg").css('display','block');

            $.each( msg, function( key, value ) {

                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');

            });

        }

});