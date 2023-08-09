
<button class="main-btn" href="javascript:void(0)"  onclick="SubmitPay()" data-animation="fadeInUp" data-delay="1.5s" id="rzp-button1">Pay Now</button> 
   
   	<script type="text/javascript" id="resourceScript" src="https://services.billdesk.com/checkout-widget/src/app.bundle.js" async></script> 

	<script type="text/javascript">
		//window.onload=function(){
//document.getElementById('rzp-button1').click();	
//}

       // document.getElementById('rzp-button1').onclick = function(e){
       	function SubmitPay(){
        
		bdPayment.initialize ({
			"msg":'<?php echo $str.'|'. $checksum; ?>',
			
			"options": {
						"enableChildWindowPosting": true,
						"enablePaymentRetry": true,
						"retry_attempt_count": 3
						
						},
			"callbackUrl": "${APP_URL}/api/recharge"
			});		
		}
	
    </script>