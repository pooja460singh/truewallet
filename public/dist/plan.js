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
/*----Get Dropdown Oprator Name Data--------*/
function getOepratortype(id){
    $.ajax({
      type:'GET',
      url:`${APP_URL}/operatortype/getAjaxData`,
      data:{id:id,action:'operator'},
      success:function(res){
        $("select[name$='pack_name']").html(res);
        if($('#hdnpackname').val()!=null)
        $("select[name$='pack_name']").val($('#hdnpackname').val());
      }
    });
  }

  /*********************Add Plan*************/
  $('#plan_form').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  let id = $('#plan_id').val();
   let url = '';
   let method='';
   if (id) {
        url= `${APP_URL}/plan/update`
        method='post'
    } else {
        url= `${APP_URL}/plan/add`
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
$('.EditPlan').on('click',  function(e)
{
 
     var id=$(this).attr("data-id");

    $.ajax({
        url: `${APP_URL}/plan/edit/`+id,
        method: 'get',
        data:{'id':id},

        success: function(data)
        {
          $('#PlanModal').modal("show");
          var obj = JSON.parse(data);
            getOeprator(obj.operator_type);   
             getOepratortype(obj.operator_ID);   
          $("select[name$='operator_type']").val(obj.operator_type);
           $('#hdnoperator').val(obj.operator_ID);
            $('#hdnpackname').val(obj.pack_name);
             $("input[name$='plan_name']").val(obj.plan_name);
              $('#plan_id').val(obj.id);
              
        }
    });
});

/*-----Delete Single Row Data  Plan-----*/

$(document).on('click', '.deletePlan', function(e)
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
            url:`${APP_URL}/plan/delete/`+id,
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
