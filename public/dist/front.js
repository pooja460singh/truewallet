/****************Mobile Recharge*********************/

$('#postpaid1').on("click",function(e){
  alert('ok');
$.ajax({
      type:'GET',
      url:`${APP_URL}/postpaid/getAjaxData`,
      data:{action:'Postpaid'},
      success:function(res){
       
      }
});
});

$('#mobile_recharge').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  var payment_mode=$('#payment_mode_first').val();
   var status=$('#status_first').val();
    
  if(payment_mode == 'Razorpay' && status == 'on'){

          $.ajax({
      url:`${APP_URL}/rozarpayment`,
      method: 'post',
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
       
            if(data.success)
            { 
              
             swal(
               'Good job!',
               data.message,
               'success'
            )
              var response= data.response;
              window.location.href=`${APP_URL}/payment/view/`+data.response;
            }
            else
            {
               swal(
               'Error!',
               data.message,
               'error'
            )
               window.location.href=`${APP_URL}/front`;  
              }
                    
        
      },

    
   }, "json");
    
  }else if(payment_mode == 'Billdesk' && status == 'on'){
   /* Submit form data using ajax*/
   $.ajax({
      url:`${APP_URL}/front/payment`,
      method: 'post',
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
       
        var order_id=data.order_id;
        var checksum=data.checksum;
        var amount=data.amount;
         var token=data.token;
        //var url=`${APP_URL}/front/recharge`;
        //alert(data.str+"|"+checksum);
  bdPayment.initialize({

"msg": data.str+"|"+checksum,
                 "options": {
                  "enableChildWindowPosting": true,
                  "enablePaymentRetry": true,
                  "retry_attempt_count": 3
                  
                  },
               
                    "callbackUrl":`${APP_URL}/front/recharge`
                });
            },
            error: function (error) {
      },
     
   });
 }
});

/**************************Postpaid Recharge***************/

$('#mobile_recharge_postpaid').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
     var payment_mode=$('#payment_mode_second').val();
     var status=$('#status_second').val();
    
  if(payment_mode == 'Razorpay' && status == 'on'){

          $.ajax({
      url:`${APP_URL}/rozarpayment`,
      method: 'post',
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
       
            if(data.success)
            { 
              
             swal(
               'Good job!',
               data.message,
               'success'
            )
              var response= data.response;
              window.location.href=`${APP_URL}/payment/view/`+data.response;
            }
            else
            {
               swal(
               'Error!',
               data.message,
               'error'
            )
               window.location.href=`${APP_URL}/front`;  
              }
                    
        
      },

    
   }, "json");
    
  }else if(payment_mode == 'Billdesk' && status == 'on'){
   /* Submit form data using ajax*/
   $.ajax({
      url:`${APP_URL}/front/payment`,
      method: 'post',
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
       
        var order_id=data.order_id;
        var checksum=data.checksum;
        var amount=data.amount;
         var token=data.token;
        //var url=`${APP_URL}/front/recharge`;
        //alert(data.str+"|"+checksum);
  bdPayment.initialize({

"msg": data.str+"|"+checksum,
                 "options": {
                  "enableChildWindowPosting": true,
                  "enablePaymentRetry": true,
                  "retry_attempt_count": 3
                  
                  },
               
                    "callbackUrl":`${APP_URL}/front/recharge`
                });
            },
            error: function (error) {
      },
     
   });
 }
});

/********************DTH Recharge********************/

$('#dth_recharge').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


    var payment_mode=$('#payment_mode_third').val();
     var status=$('#status_third').val();
    
  if(payment_mode == 'Razorpay' && status == 'on'){

          $.ajax({
      url:`${APP_URL}/rozarpayment`,
      method: 'post',
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
       
            if(data.success)
            { 
              
             swal(
               'Good job!',
               data.message,
               'success'
            )
              var response= data.response;
              window.location.href=`${APP_URL}/payment/view/`+data.response;
            }
            else
            {
               swal(
               'Error!',
               data.message,
               'error'
            )
               window.location.href=`${APP_URL}/front`;  
              }
                    
        
      },

    
   }, "json");
    
  }else if(payment_mode == 'Billdesk' && status == 'on'){
   /* Submit form data using ajax*/
   $.ajax({
      url:`${APP_URL}/front/payment`,
      method: 'post',
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
       
        var order_id=data.order_id;
        var checksum=data.checksum;
        var amount=data.amount;
         var token=data.token;
        //var url=`${APP_URL}/front/recharge`;
        //alert(data.str+"|"+checksum);
  bdPayment.initialize({

"msg": data.str+"|"+checksum,
                 "options": {
                  "enableChildWindowPosting": true,
                  "enablePaymentRetry": true,
                  "retry_attempt_count": 3
                  
                  },
               
                    "callbackUrl":`${APP_URL}/front/recharge`
                });
            },
            error: function (error) {
      },
     
   });
 }
});


/********************Electric Recharge********************/

$('#electric_recharge').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


  
    var payment_mode=$('#payment_mode_fourth').val();
     var status=$('#status_fourth').val();
    
  if(payment_mode == 'Razorpay' && status == 'on'){

          $.ajax({
      url:`${APP_URL}/rozarpayment`,
      method: 'post',
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
       
            if(data.success)
            { 
              
             swal(
               'Good job!',
               data.message,
               'success'
            )
              var response= data.response;
              window.location.href=`${APP_URL}/payment/view/`+data.response;
            }
            else
            {
               swal(
               'Error!',
               data.message,
               'error'
            )
               window.location.href=`${APP_URL}/front`;  
              }
                    
        
      },

    
   }, "json");
    
  }else if(payment_mode == 'Billdesk' && status == 'on'){
   /* Submit form data using ajax*/
   $.ajax({
      url:`${APP_URL}/front/payment`,
      method: 'post',
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
       
        var order_id=data.order_id;
        var checksum=data.checksum;
        var amount=data.amount;
         var token=data.token;
        //var url=`${APP_URL}/front/recharge`;
        //alert(data.str+"|"+checksum);
  bdPayment.initialize({

"msg": data.str+"|"+checksum,
                 "options": {
                  "enableChildWindowPosting": true,
                  "enablePaymentRetry": true,
                  "retry_attempt_count": 3
                  
                  },
               
                    "callbackUrl":`${APP_URL}/front/recharge`
                });
            },
            error: function (error) {
      },
     
   });
 }
});


/************************Forgot Password*******************/

$('#forgot_password').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
 
   /* Submit form data using ajax*/
   $.ajax({
      url: `${APP_URL}/forgot-password`,
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