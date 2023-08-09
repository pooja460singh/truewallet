/*----Get Dropdown Oprator Name Data--------*/
function getOeprator(id){
    $.ajax({
      type:'GET',
      url:`${APP_URL}/operator/getAjaxData`,
      data:{id:id,action:'operator'},
      success:function(res){
        $("select[name$='operator_name']").html(res);
        if($('#hdnoperator').val()!=null)
        $("select[name$='operator_name']").val($('#hdnoperator').val());
      }
    });
  }


  /*********************Add Package*************/
  $('#package_form').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  let id = $('#pack_id').val();
   let url = '';
   let method='';
   if (id) {
        url= `${APP_URL}/package/update`
        method='post'
    } else {
        url= `${APP_URL}/package/add`
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
              location.reload(true);
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
            $('#' + key).addClass('alert-danger', 10000);
         });
      }
   });
});
    /*------------------Edit  Banner------------*/
$('.EditPackage').on('click',  function(e)
{
 
     var id=$(this).attr("data-id");

    $.ajax({
        url: `${APP_URL}/package/edit/`+id,
        method: 'get',
        data:{'id':id},

        success: function(data)
        {

          $('#PackageModal').modal("show");
          var obj = JSON.parse(data);
            getOeprator(obj.operator_type_id);   
          $("select[name$='operator_type']").val(obj.operator_type_id);
           $('#hdnoperator').val(obj.operator_id);
             $("input[name$='pack_name']").val(obj.pack_name);
               $('#pack_id').val(obj.id);
              
        }
    });
});

/*-----Delete Single Row Data  Plan-----*/

$(document).on('click', '.deletepackage', function(e)
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
            url:`${APP_URL}/package/delete/`+id,
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