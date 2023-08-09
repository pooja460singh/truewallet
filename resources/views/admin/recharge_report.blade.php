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
                            <th>TransactionId</th>
                            <th>MemberId</th>
                            <th>Outlet Name</th>
                            <th>Recharge Number</th>
                            <th>Operator Name</th>
                            <th>Date Time</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Balance Amount</th>
                            <th>Operator Id</th>
                            <th>Responce Time</th>
                            <th>Mode</th>
                            <th>ApiName</th>
                            <th>Action</th>
                            
                            
                        </tr>
                      </thead>
                      <tbody>
                        

                        @foreach($report as $payment_report)
                      
                        <tr>
                            <td>{{$c}}</td>
                            <td>{{$payment_report->orderID}}</td>
                            <td>{{$payment_report->email}}</td>
                            <td>{{$payment_report->customer_name}}</td>
                            <td>{{$payment_report->contact}}</td>
                            <td>{{$payment_report->oprater_name}}</td>
                            <td>{{$payment_report->created_at}}</td>
                            <td>{{$payment_report->amount}}</td>
                            <td>{{$payment_report->recharge_status}}</td>
                            <td></td>
                            <td></td>
                            <td>{{$payment_report->created_at}}</td>
                            <td>{{$payment_report->signal}}</td>
                            <td></td>
                            <td></td>
                           
                            
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