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
      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#NewsModal" id="sliderimage">
      <i class="fa fa-plus"></i> Add News
      </a>
   </div>
   <!-- /Breadcrumb -->
</div>
<br>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">News List</h4>
              <div class="row">
                <div class="col-12">
                <div class="table-wrap">
                  <div class="table-responsive">
                    <div id="datable_1_wrapper" class="dataTables_wrapper">
                    <table id="myTable" class="table table-hover display  pb-30" >
                      <thead>

                        <tr>
                           <th>Image</th>
                             <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                            
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach($news_list as $news)
                        <tr>  <td><img src="{{url('public/'.$news->news_image)}}"></td>
                              <td>{{$news->title}}</td>
                            <td>{{$news->description}}</td>
                            <td>
                              <a href="javascript:void(0);" data-id="{{$news->id}}" class="btn btn-flat bg-green btn-sm edit EditNews" data-token="{{csrf_token()}}"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="javascript:void(0);"  data-id="{{$news->id}}" data-token="{{csrf_token()}}" class="btn btn-flat bg-green btn-sm delete deleteNews"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

        <div id="NewsModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h4 class="modal-title"> Add News</h4>
         </div>
         <div class="modal-body">
            <form  method="post" id="news_form" enctype="multipart/form-data">
               {{ csrf_field() }} 
                <img src="" id="imageslider" class="img-responsive" style="width:100%;height:150px;">
                <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">News Image</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                     <input type="file" class="form-control"  name="news_image" placeholder="Heading">
                  </div>
                   <div class="alert " id="news_image"></div>
               </div>
                <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">News Title</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                     <input type="text" class="form-control"  name="title" placeholder="Title">
                  </div>
                   <div class="alert " id="title"></div>
               </div>
              
               <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Description</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                     <textarea type="text" class="form-control"  name="news_description" placeholder=" Description" rows="4" cols="50"></textarea>
                  </div>
                   <div class="alert " id="news_description"></div>
               </div>
              
               <input type="hidden" name="news_id" id="news_id">                                              
         </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-success mr-10" name="SendNews" id="SendNews">Submit</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         </form>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script src="{{url('public/dist/news.js') }}"></script>
@endpush