 <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href=""><img src="{{url('public/images/Logo.png')}}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <img src="{{url('public/images/mini-logo.png')}}" alt="logo"/>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fa fa-bars"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
          <!--<li class="nav-item dropdown">-->
          <!--  <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">-->
          <!--    <i class="fa fa-bell mx-0"></i>-->
          <!--  </a>-->
          <!--  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">-->
          <!--    <p class="mb-0 font-weight-normal float-left dropdown-header text-primary">Notifications</p>-->
          <!--    <a class="dropdown-item preview-item">-->
          <!--      <div class="preview-thumbnail">-->
          <!--        <div class="preview-icon bg-info">-->
          <!--          <i class="fa fa-adjust mx-0"></i>-->
          <!--        </div>-->
          <!--      </div>-->
          <!--      <div class="preview-item-content">-->
          <!--        <h6 class="preview-subject font-weight-normal">New user registration</h6>-->
          <!--        <p class="font-weight-light small-text mb-0 text-muted">-->
          <!--          2 days ago-->
          <!--        </p>-->
          <!--      </div>-->
          <!--    </a>-->
          <!--    <a class="dropdown-item preview-item">-->
          <!--      <div class="preview-thumbnail">-->
          <!--        <div class="preview-icon bg-info">-->
          <!--          <i class="fa fa-adjust mx-0"></i>-->
          <!--        </div>-->
          <!--      </div>-->
          <!--      <div class="preview-item-content">-->
          <!--        <h6 class="preview-subject font-weight-normal">New user registration</h6>-->
          <!--        <p class="font-weight-light small-text mb-0 text-muted">-->
          <!--          2 days ago-->
          <!--        </p>-->
          <!--      </div>-->
          <!--    </a>-->
          <!--  </div>-->
          <!--</li>-->
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{url('public/'.auth()->user()->image)}}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#ProfileChangeModal">
                <i class="fa fa-user text-primary"></i>
                Change Profile Image
              </a>
              <a class="dropdown-item" data-toggle="modal" data-target="#ChangeModal">
                <i class="fa fa-cog text-primary"></i>
                Change Password
              </a>
              <a class="dropdown-item" href="{{url('logout')}}">
                <i class="fa fa-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="fa fa-bars"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
     
     
       <div id="ProfileChangeModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
            <h4 class="modal-title">Change Profile Picture</h4>
         </div>
         <div class="modal-body">
            <form method="post" id="profile_image"  enctype="multipart/form-data">
               {{ csrf_field() }} 
                <img src="{{url('public/'.auth()->user()->image)}}" class="img-responsive" style="height:150px;"><br>
                  <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Email</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                     <input type="text" class="form-control"  name="email" placeholder="Email" value="{{auth()->user()->email}}" readonly="readonly">
                  </div>
                  <div class="alert d-none" id="email"></div>
               </div>
                <div class="form-group">
                        <label class="control-label mb-10" for="customer image">Image</label>
                        <div class="input-group">
                           <!--<div class="input-group-addon"><i class="fa fa-picture-o"></i></div>-->
                            <input type="file" class="form-control"  name="profile_image" >
                        </div>
                         <div class="alert " id="profile_image"></div>
                     </div>
            
              
               <input type="hidden"  id="profile_id" name="profile_id">
         </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-success mr-10" name="SendCustomerProfile" id="SendCustomerProfile">Submit</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         </form>
      </div>
   </div>
</div>
     
      
      <!-- partial -->
      <div id="ChangeModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h4 class="modal-title">Change Password</h4>
         </div>
         <div class="modal-body">
            <form method="post" id="change_password"  enctype="multipart/form-data" class="forms-sample row">
               {{ csrf_field() }} 
                <div class="col-sm-12">
                   <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                     <input type="text" class="form-control"  name="email" placeholder="Email" value="{{auth()->user()->email}}" readonly="readonly">
                  <div class="alert d-none" id="email"></div>
               </div>
             </div>
              <div class="col-sm-12">
                <div class="form-group">
                        <label for="exampleInputName1">Old Password</label>
                           <input type="password" class="form-control"  name="old_password" placeholder="*******">
                         <div class="alert " id="password"></div>
                     </div>
                   </div>
                    <div class="col-sm-12">
                <div class="form-group">
                        <label for="exampleInputName1">New Password</label>
                            <input type="password" class="form-control"  name="password" placeholder="*******">
                         <div class="alert " id="password"></div>
                     </div>
                   </div>
              <div class="col-sm-12">
                <div class="form-group">
                        <label for="exampleInputName1">Confirm Password</label>
                             <input type="password" class="form-control"  name="confirm_password" placeholder="*******">
                         <div class="alert " id="password"></div>
                     </div>
                   </div>
            
              
               <input type="hidden"  id="password_id" name="password_id">
         </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-success mr-10" name="SendCustomerpassword" id="SendCustomerpassword">Submit</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         </form>
      </div>
   </div>
</div>
@push('scripts')
<script src="{{url('public/dist/admin.js') }}"></script>
@endpush