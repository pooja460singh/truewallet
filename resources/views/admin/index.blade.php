  @extends('admin.layouts.master')
 @section('content')
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
               @include('front.partials.alerts')
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                  <h5 class="mr-4 mb-0 font-weight-bold blue-colr">Dashboard</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
              <div class="card icon-card-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="fa fa-user"></i>
                      </div>
                      <p class="font-weight-medium mb-0">Customers</p>
                    </div>
                    <div class="d-flex align-items-center mt-3 flex-wrap">
                      <h3 class="font-weight-normal mb-0 mr-2">{{$customer_count}}</h3>
                    </div>
                    <small class="font-weight-medium d-block mt-2">Total Customer</small>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
              <div class="card icon-card-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="fa fa-credit-card"></i>
                      </div>
                      <p class="font-weight-medium mb-0">Transaction</p>
                    </div>
                    <div class="d-flex align-items-center mt-3 flex-wrap">
                      <h3 class="font-weight-normal mb-0 mr-2">{{$transaction}}</h3>
                    </div>
                    <small class="font-weight-medium d-block mt-2">Total Transaction</small>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
              <div class="card icon-card-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="fas fa-money-bill-alt"></i>
                      </div>
                      <p class="font-weight-medium mb-0">Revenue</p>
                    </div>
                    <div class="d-flex align-items-center mt-3 flex-wrap">
                      <h3 class="font-weight-normal mb-0 mr-2">{{number_format($revenue,'2')}}</h3>
                    </div>
                    <small class="font-weight-medium d-block mt-2">Total Revenue</small>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
              <div class="card icon-card-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                       <i class="fa fa-money" aria-hidden="true"></i>
                      </div>
                      <p class="font-weight-medium mb-0">Expense</p>
                    </div>
                    <div class="d-flex align-items-center mt-3 flex-wrap">
                      <h3 class="font-weight-normal mb-0 mr-2">{{number_format($expense,'2')}}</h3>
                    </div>
                    <small class="font-weight-medium d-block mt-2">Total Expense</small>
                </div>
              </div>
            </div>
          </div>
         
          
          <div class="row">
            <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                    <p class="card-title flex-grow">Payment History</p>
                  </div>
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
        @endsection