 @extends('admin.layouts.master')
 @section('content')
 <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Wallet Payment History</h4>
              <div class="row">
                <div class="col-12">
                <div class="table-wrap">
                  <div class="table-responsive">
                    <div id="datable_1_wrapper" class="dataTables_wrapper">
                    <table id="myTable" class="table table-hover display  pb-30" >
                      <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>SenderId</th>
                            <th>RecieverId</th>
                            <th>Amount</th>
                           
                            
                            
                        </tr>
                      </thead>
                      <tbody>
                          <input type="hidden" name="" value="  {{$c=1}}">

                        @foreach($wallet_to_wallet as $wallet)
                      
                        <tr>
                            <td>{{$c}}</td>
                            <td>{{$wallet->senderId}}</td>
                            <td>{{$wallet->recieverId}}</td>
                            <td>{{$wallet->amount}}</td>
                            
                            
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