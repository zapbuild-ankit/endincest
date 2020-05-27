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

    });