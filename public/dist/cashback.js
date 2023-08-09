$('#cashback_form').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  let id = $('#cashback_id').val();
   let url = '';
   let method='';
   if (id) {
        url= `${APP_URL}/cashback/update`
        method='post'
    } else {
        url= `${APP_URL}/cashback/add`
        method='post'
    }

   /* Submit form data using ajax*/
   $.ajax({
      url: url,
      method: method,
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
         } else {
             swal(
               'Error!',
               data.message,
               'error'
            )
         }
         location.reload(true);
        $('#CashbackModal').modal("hide");     
      },
      error: function (data) {
         let errors = data.responseJSON.errors
         $.each(errors, function (key, value) {
            $('#' + key).text(value)
            $('#' + key).removeClass('alert-danger')
            $('#' + key).addClass('alert-danger', 10000);
         });
      }
   });
});


/*------------------Edit  Banner------------*/
$('.EditCashback').on('click',  function(e)
{
     var id=$(this).attr("data-id");
    $.ajax({
        url: `${APP_URL}/cashback/edit/`+id,
        method: 'get',
        data:{'id':id},

        success: function(data)
        {
         
          var obj = JSON.parse(data);
            $("input[name$='cashback']").val(obj[0].cashback);
            $('#cashback_id').val(obj[0].id);
             $('#OfferModal').modal("show");      

        }
    });
});