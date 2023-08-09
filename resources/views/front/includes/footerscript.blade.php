 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="{{url('public/assets/js/jquery.min.js')}}"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="{{url('public/assets/js/bootstrap.min.js')}}"></script>
	  
      <!-- jQuery plugins library-->
      <script type="text/javascript" src="{{url('public/assets/plugins/menu/js/hover-dropdown-menu.js')}}"></script> 
      <script type="text/javascript" src="{{url('public/assets/plugins/menu/js/jquery.hover-dropdown-menu-addon.js')}}"></script>	
      <script src="{{url('public/assets/plugins/owl-carousel/js/owl.carousel.js')}}"></script>	
      <script type="text/javascript" src="{{url('public/assets/plugins/counter/js/jquery.countTo.js')}}"></script> 
      <script type="text/javascript" src="{{url('public/assets/plugins/counter/js/jquery.appear.js')}}"></script>  	
      <script src="{{url('public/assets/plugins/mixitup/js/jquery.mixitup.js')}}"></script>	  
      <script src="{{url('public/assets/plugins/fancymedia/js/jquery.fancybox.pack.js')}}"></script>
      <script src="{{url('public/assets/plugins/fancymedia/js/jquery.fancybox-media.js')}}"></script> 
	
	  <!-- Custom JS -->
    <!--<script src="https://services.billdesk.com/checkout-widget/src/app.bundle.js"></script>-->
      <script type="text/javascript" src="{{url('public/assets/js/main.js')}}"></script> 

      <script src="{{url('public/plugins/jquery/dist/sweetalert2.all.min.js')}}"></script>
      <script src="{{url('public/jquery/dist/toastr.min.js')}}"></script>
    <script src="{{url('public/dist/js/function.js')}}"></script>
     <script>
         let APP_URL = {!! json_encode(url('/')) !!};
      </script>
     
      @stack('scripts')