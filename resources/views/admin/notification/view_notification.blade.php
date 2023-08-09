 @extends('admin.layouts.master')
 @section('content')
 <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Notification History</h4>
              <div class="row">
                <div class="col-12">
                <div class="table-wrap">
                  <div class="table-responsive">
                    <div id="datable_1_wrapper" class="dataTables_wrapper">
                    <table id="myTable" class="table table-hover display  pb-30" >
                      <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Purchased On</th>
                            <th>Customer</th>
                            <th>Ship to</th>
                            <th>Base Price</th>
                            <th>Purchased Price</th>
                            <th>Status</th>
                            
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>1</td>
                            <td>2012/08/03</td>
                            <td>Edinburgh</td>
                            <td>New York</td>
                            <td>Rs-1500</td>
                            <td>Rs-3200</td>
                            <td>
                              <label class="badge badge-info">On hold</label>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2015/04/01</td>
                            <td>Doe</td>
                            <td>Brazil</td>
                            <td>Rs-4500</td>
                            <td>Rs-7500</td>
                            <td>
                              <label class="badge badge-danger">Pending</label>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2010/11/21</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>Rs-2100</td>
                            <td>Rs-6300</td>
                            <td>
                              <label class="badge badge-success">Closed</label>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>2016/01/12</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>Rs-2100</td>
                            <td>Rs-6300</td>
                            <td>
                              <label class="badge badge-success">Closed</label>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>2017/12/28</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>Rs-2100</td>
                            <td>Rs-6300</td>
                            <td>
                              <label class="badge badge-success">Closed</label>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>2000/10/30</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>Rs-2100</td>
                            <td>Rs-6300</td>
                            <td>
                              <label class="badge badge-info">On-hold</label>
                            </td>
                            

                        </tr>
                        <tr>
                            <td>7</td>
                            <td>2011/03/11</td>
                            <td>Cris</td>
                            <td>Tokyo</td>
                            <td>Rs-2100</td>
                            <td>Rs-6300</td>
                            <td>
                              <label class="badge badge-success">Closed</label>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>2015/06/25</td>
                            <td>Tim</td>
                            <td>Italy</td>
                            <td>Rs-6300</td>
                            <td>Rs-2100</td>
                            <td>
                              <label class="badge badge-info">On-hold</label>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>2016/11/12</td>
                            <td>John</td>
                            <td>Tokyo</td>
                            <td>Rs-2100</td>
                            <td>Rs-6300</td>
                            <td>
                              <label class="badge badge-success">Closed</label>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>2003/12/26</td>
                            <td>Tom</td>
                            <td>Germany</td>
                            <td>Rs-1100</td>
                            <td>Rs-2300</td>
                            <td>
                              <label class="badge badge-danger">Pending</label>
                            </td>
                            
                        </tr>
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