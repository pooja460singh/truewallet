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
  $('#operator_banner_form').on('submit', function(event){
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
        url= `${APP_URL}/operator/banner/update`
        method='post'
    } else {
        url= `${APP_URL}/operator/banner/store`
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

  /*-----Delete Single Row Data  Operator Banner-----*/

$(document).on('click', '.delete_operator_banner', function(e)
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
            url:`${APP_URL}/operator/banner/delete/`+id,
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

 /*------------------Operator banner Image------------*/
$('.BannerImage').on('click',  function(e)
 {

    
     var banner_id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/banner/detail/`+banner_id,
        method: 'get',
        data:{'banner_id':banner_id},
      
        success: function(data)
        {

          var obj = JSON.parse(data); 
          url=`${APP_URL}`;
$("#data_detail").empty(); 
  var option1='';  
  option1+="<table class='table table-striped table-hover table-bordered'>";
 option1+="<thead class='thead-detail'>";
  option1+="<tr>";
option1+="<th>Image</th>";
option1+="</tr> ;";
 option1+="<thead>";
  option1+="<tbody>";
 for (var i=0;i<obj.length;i++)
{

option1+="</tr>";
option1+="</thead>";
option1+="<tbody class='detail-td text-center'>";
option1+="<tr>";
 option1+="<td><img src='"+url+"/public/"+obj[i].banner_image+"' class='img-fluid' width='60px' height='60px'></td>";
option1+="</tr>";

}
 option1+="</tbody>";
  option1+="<table>";
 $("#data_detail").append(option1);
   $('#OperatorBanner').modal('show')

   }
    });
});