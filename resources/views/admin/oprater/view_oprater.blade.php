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
      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#OpraterModal" id="sliderimage">
      <i class="fa fa-plus"></i> Add Operator
      </a>
   </div>
   <!-- /Breadcrumb -->
</div>
<br>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Operator List</h4>
              <div class="row">
                <div class="col-12">
                <div class="table-wrap">
                  <div class="table-responsive">
                    <div id="datable_1_wrapper" class="dataTables_wrapper">
                    <table id="myTable" class="table table-hover display  pb-30" >
                      <thead>

                        <tr>
                             <th>Operator Name</th>
                            <th>Operator Code</th>
                             <th>Commision Type</th>
                            <th>Commission Rate</th>
                            <th>Action</th>
                            
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach($oprater as $opraterlist)
                        <tr>
                              <td>{{$opraterlist->oprater_name}}</td>
                             <td>{{$opraterlist->oprater_code}}</td>
                               <td>{{$opraterlist->commission_type}}</td>
                                 <td>{{$opraterlist->commission_rate}}</td>
                            <td>
                              <a href="javascript:void(0);" data-id="{{$opraterlist->id}}" class="btn btn-flat bg-green btn-sm edit EditOprater" data-token="{{csrf_token()}}"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="javascript:void(0);"  data-id="{{$opraterlist->id}}" data-token="{{csrf_token()}}" class="btn btn-flat bg-green btn-sm delete deleteOprater"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

        <div id="OpraterModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h4 class="modal-title"> Add Operator</h4>
         </div>
         <div class="modal-body">
            <form  method="post" id="oprator_form" enctype="multipart/form-data">
               {{ csrf_field() }} 
                 <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Operator Type</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                    <select name="oprator_type"  class="form-control">
                      <option value="">Choose Operator Type</option>
                    @foreach($oprater_type as $type)
                      <option value="{{$type->id}}">{{$type->name}}</option>
                     @endforeach
                   </select>
                  </div>
                   <div class="alert " id="oprator_type"></div>
               </div>
                <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Oprator Name</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                     <input type="text" class="form-control"  name="oprator_name" placeholder="Oprater Name">
                  </div>
                   <div class="alert " id="oprator_name"></div>
               </div>
              
               <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Operator Code</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                    <input type="text" class="form-control"  name="oprator_code" placeholder="Oprater Name">
                  </div>
                   <div class="alert " id="oprator_code"></div>
               </div>
               <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Commission Type</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                    <input type="radio" class="form-control"  name="commission_type" placeholder="Oprater Name" Value="Percent">Percent
                     <input type="radio" class="form-control"  name="commission_type" placeholder="Oprater Name" Value="Flat">Flat
                  </div>
                   <div class="alert " id="commission_type"></div>
               </div>
                 <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Commission Rate</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                    <input type="text" class="form-control"  name="commission_rate" placeholder="Commission Rate">
                  </div>
                   <div class="alert " id="commission_rate"></div>
               </div>
              
               <input type="hidden" name="oprater_id" id="oprater_id">                                              
         </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-success mr-10" name="SendOprater" id="SendOprater">Submit</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         </form>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script src="{{url('public/dist/oprator.js') }}"></script>
@endpush