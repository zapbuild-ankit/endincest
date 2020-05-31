   $(document).ready(function()
    {

    $('form').parsley({
    errorClass: 'has-danger',
   successClass: 'has-success',
   classHandler: function(ParsleyField) {
     return ParsleyField.$element.closest('.form-group');
   },
   errorsContainer: function(ParsleyField) {
     return ParsleyField.$element.closest('.form-group');
   },
   errorsWrapper: '<span class="form-text text-danger"></span>',
   errorTemplate: '<span></span>'
 })


     $(function() {
      $('#image').change(function() {
            $(this).removeClass('input-validation-error').next('span').text('');
            if (this.files[0].size > 1000000 || this.files[0].size < 200000) {
                  $(this).addClass('input-validation-error').
                        next('span').text('File size must be between 200 kb to 1 mb');
                        alert("File size must be between 200 kb to 1 mb");
                        this.value = ''; // Clean field
                        return false;
            }

            var fileExtension = ['jpeg'];
                    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                         $(this).addClass('input-validation-error').
                        next('span').text('only .jpeg format is allowed');
                        alert("Only '.jpeg' format is allowed.");
                        this.value = ''; // Clean field
                        return false;
                      }
      });
});


     });