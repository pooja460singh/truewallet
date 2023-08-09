 /* Submit form data using ajax*/
   $.ajax({
      url:`${APP_URL}/api/checksum`,
      method: 'post',
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        var checksum=data.checksum;
  bdPayment.initialize({

"msg": data.str+"|"+checksum,
                 "options": {
                  "enableChildWindowPosting": true,
                  "enablePaymentRetry": true,
                  "retry_attempt_count": 3
                  
                  },
               
                    "callbackUrl":`${APP_URL}/api/recharge`
                });
            },
            error: function (error) {
      },
     
   });