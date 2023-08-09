
 @extends('admin.layouts.master')
 @section('content')
 <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Payment Mode</h4>
              <div class="row">
                <div class="col-12">
                <div class="table-wrap">
                  <div class="table-responsive">
                    <div id="datable_1_wrapper" class="dataTables_wrapper">
                    <table id="myTable" class="table table-hover display  pb-30" >
                      <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Payment Mode</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                            
                            
                        </tr>
                      </thead>
                      <tbody>
                        
                      
                        @foreach($payment_mode as $payment_gateway)
                        
                        <tr>
                            <td>{{$c}}</td>
                            <td>{{$payment_gateway->payment_gateway}}</td>
                            <td>{{$payment_gateway->status}}</td>
                            <td> <a href="javascript:changeStatus({{$payment_gateway->id}})" class="btn {{ $payment_gateway->status == 'on' ? 'btn-danger' : 'btn btn-success' }} btn-sm">{{ $payment_gateway->status == 'on' ? 'OFF' : 'ON' }}</td>
                            
                            
                        </tr>
                        <input type="hidden" name="" value="{{$c++}}">
                      
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
               </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        @endsection
        @push('scripts')
<script src="{{url('public/dist/payment_gateway.js') }}"></script>
@endpush