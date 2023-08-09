 @extends('admin.layouts.master')
 @section('content')
 <style type="text/css">
   .view
   {
   background: green;
   width: 30px;
   height: 30px;
   color: #fff;
   }
   .view:hover
   {
   color:#fff;
   }
   .edit
   {
   background: #f39c12 !important;
   width: 30px;
   height: 30px;
   color: #fff;
   }
   .edit:hover
   {
   color:#fff;
   }
   .delete
   {
   background: #dd4b39 !important;
   width: 30px;
   height: 30px;
   color: #fff;
   }
   .delete:hover
   {
   color:#fff;
   }
</style>
 <!-- partial -->

      <div class="main-panel">
        <div class="content-wrapper">
             <div class="row heading-bg">
   <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12">
      <h5 class="txt-dark"></h5>
   </div>
   <!-- Breadcrumb -->
   <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#PackageModal" id="sliderimage">
      <i class="fa fa-plus"></i> Add Package
      </a>
   </div>
   <!-- /Breadcrumb -->
</div>
<br>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Package List</h4>
              <div class="row">
                <div class="col-12">
                <div class="table-wrap">
                  <div class="table-responsive">
                    <div id="datable_1_wrapper" class="dataTables_wrapper">
                    <table id="myTable" class="table table-hover display  pb-30" >
                      <thead>

                        <tr>
                              <th>Operator Type</th>
                             <th>Operator Name</th>
                             <th>package Name</th>
                            <th>Action</th>
                            
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach($package as $package_list)
                        <tr>
                          <td>{{$package_list->name}}</td>
                          <td>{{$package_list->oprater_name}}</td>
                          <td>{{$package_list->pack_name}}</td>
                       

                            <td>
                              <a href="javascript:void(0);" data-id="{{$package_list->id}}" class="btn btn-flat bg-green btn-sm edit EditPackage" data-token="{{csrf_token()}}"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="javascript:void(0);"  data-id="{{$package_list->id}}" data-token="{{csrf_token()}}" class="btn btn-flat bg-green btn-sm delete deletepackage"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            
                        </tr>
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

        <div id="PackageModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h4 class="modal-title"> Add Package</h4>
         </div>
         <div class="modal-body">
            <form  method="post" id="package_form" enctype="multipart/form-data">
               {{ csrf_field() }} 
                <div class="row">
              <div class="col-sm-12">
                 <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Operator Type</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                    <select name="operator_type"  class="form-control" onchange="getOeprator(this.value);">
                      <option value="">Choose Operator Type</option>
                    @foreach($operator as $type)
                      <option value="{{$type->id}}">{{$type->name}}</option>
                     @endforeach
                   </select>
                  </div>
                   <div class="alert " id="operator_type"></div>
               </div>
             </div>
           </div>

             <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Oprator Name</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                      <input type="hidden" id="hdnoperator">
                           <select name="operator_name"  class="form-control">
                              <option value=''>Select Operator</option>

                           </select>
                  </div>
                   <div class="alert " id="operator_name"></div>
               </div>
             </div>
           </div>
               <div class="row">
              <div class="col-sm-12">
               <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">package Name</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                    <input type="text" class="form-control"  name="pack_name" placeholder="package Name">
                  </div>
                  <div class="alert " id="pack_name"></div>
               </div>
             </div>
           </div>
             
          
           <input type="hidden" name="pack_id" id="pack_id" value="">
         <div class="modal-footer">
         <button type="submit" class="btn btn-success mr-10" name="SendPlan" id="SendPlan">Submit</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         </form>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script src="{{url('public/dist/package.js') }}"></script>
@endpush