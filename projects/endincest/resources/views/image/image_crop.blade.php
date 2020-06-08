@extends('layouts.admin')
@section('title') Images @endsection
@section('content')

 <div class="container">
    <br />
        <h3 align="center">Crop Image</h3>
      <br />
      <div class="card">
        <div class="card-header">Crop and Upload Image</div>
        <div class="card-body">
            <form method="post" id="upload_form" enctype="multipart/form-data">

          <div class="form-group">
               @csrf
            <div class="row">
              <div class="col-md-4" style="border-right:1px solid #ddd;">
                <div id="image-preview"></div>
              </div>
              <div class="col-md-4" style="padding:75px; border-right:1px solid #ddd;">
                <p><label>Select Image</label></p>
                <input type="file" name="image" id="upload_image"  />
                <br />
                <br />
               <input type="submit" name="upload" class="btn btn-success crop_image">


              </div>
             </form>
              <div class="col-md-4" style="padding:75px;background-color: #333">
                <div id="uploaded_image" align="center"></div>
              </div>
              <div>
              	<b><p id="saved_image" style='color:blue;'></p></b>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br />
          <br />

          <br />
          <br />
    </div>
 </body>
</html>

<script>
$(document).ready(function(){

  $image_crop = $('#image-preview').croppie({
    enableExif:true,
    viewport:{
      width:200,
      height:200,
      type:'square'
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').change(function(){



    var reader = new FileReader();


    reader.onload = function(event){
      $image_crop.croppie('bind', {
        url:event.target.result
      });
    }
    reader.readAsDataURL(this.files[0]);
  });

  $('.crop_image').click(function(event){
  	 event.preventDefault();

  	if ($("#upload_image").val() == "") {
    alert('Please select image file');
  }
  else
    $image_crop.croppie('result', {
      type:'canvas',
      size:'viewport'
    }).then(function(response){
      var _token = $('input[name=_token]').val();
      $.ajax({
        url:'{{ route("upload") }}',
        method:'POST',

        data:{"image":response, _token:_token},
        dataType:"json",


        success:function(data)
        {

          var crop_image = '<img src="'+data.path+'" />';
          $('#uploaded_image').html(crop_image);

          var saved_image = ' Image has been saved ';
          $('#saved_image').html(saved_image);
        }



      });
    });
  });


});
</script>

@endsection