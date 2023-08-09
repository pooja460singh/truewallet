

/*----Get Dropdown Plan Data--------*/
function getPlan(id){
    $.ajax({
      type:'GET',
      url:`${APP_URL}/plan/getAjaxData`,
      data:{id:id,action:'plan'},
      success:function(res){
        $("select[name$='plan_name']").html(res);
        if($('#hdnplan').val()!=null)
        $("select[name$='plan_name']").val($('#hdnplan').val());
      }
    });
  }


  /*********************Add Plan*************/
  $('#planduration_form').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  let id = $('#planduration_id').val();
   let url = '';
   let method='';
   if (id) {
        url= `${APP_URL}/planduration/update`
        method='post'
    } else {
        url= `${APP_URL}/planduration/add`
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
$('.EditPlanDuration').on('click',  function(e)
{
 
     var id=$(this).attr("data-id");

    $.ajax({
        url: `${APP_URL}/planduration/edit/`+id,
        method: 'get',
        data:{'id':id},

        success: function(data)
        {
          $('#PlanDurationModal').modal("show");
          var obj = JSON.parse(data);
            getOeprator(obj.operator_typeId); 
            getOepratortype(obj.operator_Id); 
            getPlan(obj.pack_id);  
          $("select[name$='operator_type']").val(obj.operator_typeId);
           $('#hdnoperator').val(obj.operator_Id);
             $('#hdnpackname').val(obj.pack_id);
            $('#hdnplan').val(obj.plan_id);
            $("input[name$='pack_id']").val(obj.pack_id);
            $("input[name$='talktime']").val(obj.talktime);
             $("input[name$='plan_name']").val(obj.plan_name);
              $("input[name$='validity']").val(obj.validity);
               $("input[name$='amount']").val(obj.amount);
               $("input[name$='data']").val(obj.data);
                 $("textarea[name$='description']").val(obj.description);
               $('#planduration_id').val(obj.id);
              
        }
    });
});

/*-----Delete Single Row Data  Plan-----*/

$(document).on('click', '.deletePlanDuration', function(e)
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
            url:`${APP_URL}/planduration/delete/`+id,
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
