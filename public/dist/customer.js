
/*Create Customer Using Ajax*/

$('#customer_form').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 
   /* Submit form data using ajax*/
   $.ajax({
      url:`${APP_URL}/customers/add`,
      method: 'post',
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
         if (data.success) {
             swal(
               'Good job!',
               data.message,
               'success'
            )
              window.location.href=`${APP_URL}/download`;
         } else {
             swal(
               'Error!',
               data.message,
               'error'
            )
         }
      },
      error: function (data) {
         let errors = data.responseJSON.errors
         $.each(errors, function (key, value) {
            $('#' + key).text(value)
            $('#' + key).removeClass('alert-danger')
            $('#' + key).addClass("alert-danger", 10000);
         });
      }
   });
});