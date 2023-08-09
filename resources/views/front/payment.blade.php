
<button id="rzp-button1" hidden="hidden">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "{{$response['razorpayId']}}", // Enter the Key ID generated from the Dashboard
    "amount": "{{$response['amount']}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "{{$response['name']}}",
    "description": "",
    "image": "http://truewallet.co.in/public/assets/img/logo.png",
    "order_id":"{{$response['order_id']}}",
   
    "handler": function (response){
    	document.getElementById('rzp_paymentid').value=response.razorpay_payment_id;
    	document.getElementById('rzp_orderid').value=response.razorpay_order_id;
    	document.getElementById('rzp_signature').value=response.razorpay_signature;
       
      //let's the form submit automatically
      document.getElementById('rzp-paymentresponse').click();	
    },
    "prefill": {
        "name": "{{$response['name']}}",
        "email": "{{$response['email']}}",
        "contact": "{{$response['contactNumber']}}"
    },
    "notes": {
        "address": "{{$response['address']}}"
    },
    "theme": {
        "color": "#E57721"
    }
};
var rzp1 = new Razorpay(options);
window.onload=function(){
document.getElementById('rzp-button1').click();	
}
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>

<form action="{{url('payment/complete')}}" method="POST" hidden="hidden">
	 {{ csrf_field() }} 
	 <input type="text" name="rzp_paymentid" id="rzp_paymentid">
	  <input type="text" name="rzp_orderid" id="rzp_orderid">
	   <input type="text" name="rzp_signature" id="rzp_signature">
	<button type="submit" id="rzp-paymentresponse" class="btn btn-success">Submit</button>
	</form>
