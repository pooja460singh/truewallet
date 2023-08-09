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
      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#PlanModal" id="sliderimage">
      <i class="fa fa-plus"></i> Add Plan
      </a>
   </div>
   <!-- /Breadcrumb -->
</div>
<br>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Plan List</h4>
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
                              <th>Pack Name</th>
                             <th>Plan Name</th>
                            <th>Action</th>
                            
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach($plan as $plan_list)
                        <tr>
                          <td>{{$plan_list->name}}</td>
                          <td>{{$plan_list->oprater_name}}</td>
                           <td>{{$plan_list->pack_name}}</td>
                          <td>{{$plan_list->plan_name}}</td>
                       

                            <td>
                              <a href="javascript:void(0);" data-id="{{$plan_list->id}}" class="btn btn-flat bg-green btn-sm edit EditPlan" data-token="{{csrf_token()}}"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="javascript:void(0);"  data-id="{{$plan_list->id}}" data-token="{{csrf_token()}}" class="btn btn-flat bg-green btn-sm delete deletePlan"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

        <div id="PlanModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h4 class="modal-title"> Add Plan</h4>
         </div>
         <div class="modal-body">
            <form  method="post" id="plan_form" enctype="multipart/form-data">
               {{ csrf_field() }} 
                <div class="row">
              <div class="col-sm-6">
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
                   <div class="alert " id="oprator_type"></div>
               </div>
             </div>
               <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Oprator Name</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                      <input type="hidden" id="hdnoperator">
                           <select name="operator_name"  class="form-control" onchange="getOepratortype(this.value);">
                              <option value=''>Select Operator</option>
                           </select>
                  </div>
                   <div class="alert " id="operator_name"></div>
               </div>
             </div>
           </div>

               <div class="row">
                  <div class="col-sm-6">
               <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Pack Name</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                      <input type="hidden" id="hdnpackname">
                    <select name="pack_name"  class="form-control" >
                         <option value=''>Select Pack Name</option>
                           </select>
                  </div>
                  <div class="alert " id="pack_name"></div>
               </div>
             </div>
              <div class="col-sm-6">
               <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Plan Name</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                    <input type="text" class="form-control"  name="plan_name" placeholder="Plan Name">
                  </div>
                  <div class="alert " id="plan_name"></div>
               </div>
             </div>
           </div>
             
          
           <input type="hidden" name="plan_id" id="plan_id" value="">
         <div class="modal-footer">
         <button type="submit" class="btn btn-success mr-10" name="SendPlan" id="SendPlan">Submit</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         </form>
      </div>
   </div>
</div>
</div>
@endsection
@push('scripts')
<script src="{{url('public/dist/plan.js') }}"></script>
@endpush