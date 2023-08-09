   <!-- jquery-->
    <script src="{{url('public/login/js/jquery-3.5.0.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{url('public/login/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{url('public/login/js/bootstrap.min.js')}}"></script>
    <!-- Imagesloaded js -->
    <script src="{{url('public/login/js/imagesloaded.pkgd.min.js')}}"></script>
    <!-- Validator js -->
    <script src="{{url('public/login/js/validator.min.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{url('public/login/js/main.js')}}"></script>
    <script src="{{url('public/plugins/jquery/dist/sweetalert2.all.min.js')}}"></script>
      <script src="{{url('public/jquery/dist/toastr.min.js')}}"></script>
    <script src="{{url('public/dist/js/function.js')}}"></script>

     <script>
         let APP_URL = {!! json_encode(url('/')) !!};
      </script>
     
      @stack('scripts')