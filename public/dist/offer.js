$('#offer_form').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
  let id = $('#offer_id').val();
   let url = '';
   let method='';
   if (id) {
        url= `${APP_URL}/offer/update`
        method='post'
    } else {
        url= `${APP_URL}/offer/add`
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


/*------------------Edit  Offer Banner------------*/
$('.EditOffer').on('click',  function(e)
{
  
     var id=$(this).attr("data-id");
    $.ajax({
        url: `${APP_URL}/offer/edit/`+id,
        method: 'get',
        data:{'id':id},

        success: function(data)
        {
         
          var obj = JSON.parse(data);
            $("input[name$='heading']").val(obj[0].heading);
             $("input[name$='date']").val(obj[0].valid_up_to);
           $("textarea[name$='offer_description']").val(obj[0].offer_description);
            $('#offer_id').val(obj[0].id);
             $('#OfferModal').modal("show");      

        }
    });
});

/*-----Delete Single Row Data  Offer Banner-----*/

$(document).on('click', '.deleteOffer', function(e)
{
     e.preventDefault();
     swal({
         title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) =>
    {
        if(result.value)
        {

        var id = $(this).attr("data-id");
        var table = $(this).attr("data-table");
         var v_token = $(this).attr("data-token"); ;
           $.ajax({
            method:'get',
            url:`${APP_URL}/offer/delete/`+id,
            data:{id:id},
            success:function(data)
            {
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {
           redirect_notify(data.message,'Please wait while we redirect',window.location.reload(),"success");

            }
            else
            {
                notify(data.message, "info");
                return false;

            }
            }
        });

            return false;
        }
    })

});
