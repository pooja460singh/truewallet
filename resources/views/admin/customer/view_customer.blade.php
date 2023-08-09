 @extends('admin.layouts.master')
 @section('content')
 <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Customer List</h4>
              <div class="row">
                <div class="col-12">
                <div class="table-wrap">
                  <div class="table-responsive">
                    <div id="datable_1_wrapper" class="dataTables_wrapper">
                    <table id="myTable" class="table table-hover display  pb-30" >
                      <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Contact</th>
                            <th>Wallet Amount</th>
                            <th>Created Date</th>
                            
                            
                            
                        </tr>
                      </thead>
                      <tbody>
                         <input type="hidden" name="" value="  {{$c=1}}">
                        
                        @foreach($customer as $customerlist)
                      
                        <tr>
                            <td>{{$c}}</td>
                            <td>{{$customerlist->customer_name}}</td>
                            <td>{{$customerlist->email}}</td>
                            <td>{{\Crypt::decryptString($customerlist->encrypt_password)}}</td>
                            <td>{{$customerlist->contact}}</td>
                              <td>{{$customerlist->wallet_amount}}</td>
                                <td>{{\Carbon\Carbon::parse($customerlist->created_at)->format('Y-m-d')}}</td>
                            
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