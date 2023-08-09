 @extends('admin.layouts.master')
 @section('content')
 <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Payment History</h4>
              <div class="row">
                <div class="col-12">
                <div class="table-wrap">
                  <div class="table-responsive">
                    <div id="datable_1_wrapper" class="dataTables_wrapper">
                    <table id="myTable" class="table table-hover display  pb-30" >
                      <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Remarked</th>
                            <th>Oprator Name</th>
                            <th>Voucher</th>
                            <th>Credit Amount</th>
                            <th>Debit Amount</th>
                            <th>Email</th>
                            <th>Contact</th>
                            
                            
                        </tr>
                      </thead>
                      <tbody>
                        

                        @foreach($history as $payment_history)
                      
                        <tr>
                            <td>{{$c}}</td>
                            <td>{{$payment_history->remarked}}</td>
                            <td>{{$payment_history->oprater_name}}</td>
                            <td>{{$payment_history->voucher}}</td>
                            <td>{{$payment_history->credit_amount}}</td>
                            <td>{{$payment_history->debit_amount}}</td>
                            <td>{{$payment_history->email}}</td>
                            <td>{{$payment_history->contact}}</td>
                            
                        </tr>
                        <input type="hidden" name="" value="  {{$c++}}">
                      
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