<!-- base:js -->
  <script src="{{url('public/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <script src="{{url('public/vendors/datatables/media/js/jquery.dataTables.min.js')}}"></script>
  <!-- inject:js -->
  <script src="{{url('public/js/off-canvas.js')}}"></script>
  <script src="{{url('public/js/hoverable-collapse.js')}}"></script>
  <script src="{{url('public/js/template.js')}}"></script>
  <script src="{{url('public/js/settings.js')}}"></script>
  <script src="{{url('public/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="{{url('public/vendors/chart.js/Chart.min.js')}}"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="{{url('public/js/dashboard.js')}}"></script>
   <script src="{{url('public/plugins/jquery/dist/sweetalert2.all.min.js')}}"></script>
      <script src="{{url('public/jquery/dist/toastr.min.js')}}"></script>
    <script src="{{url('public/dist/js/function.js')}}"></script>
    
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    
  <script type="text/javascript">
    $(document).ready(function() {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
  </script>
  <script>
         let APP_URL = {!! json_encode(url('/')) !!};
      </script>
       @stack('scripts')