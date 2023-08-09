/******Change Password*************/
$('#sliderimage').on("click",function(e){
 $('#imageslider').hide();
});


$('#banner_form').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  let id = $('#banner_id').val();
   let url = '';
   let method='';
   if (id) {
        url= `${APP_URL}/banner/update`
        method='post'
    } else {
        url= `${APP_URL}/banner/add`
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


/*------------------Edit  Banner------------*/
$('.EditBanner').on('click',  function(e)
{
  $('#imageslider').show();
     var id=$(this).attr("data-id");
    $.ajax({
        url: `${APP_URL}/banner/edit/`+id,
        method: 'get',
        data:{'id':id},

        success: function(data)
        {
         
          var obj = JSON.parse(data);
          var image_name=obj.banner_image;
          var image_path=`${APP_URL}/public/`+obj[0].banner_image;
          $("#imageslider").attr("src",image_path);
            $('#banner_id').val(obj[0].id);
             $('#BannerModal').modal("show");      

        }
    });
});

/*-----Delete Single Row Data  Banner-----*/

$(document).on('click', '.deleteBanner', function(e)
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
            url:`${APP_URL}/banner/delete/`+id,
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
