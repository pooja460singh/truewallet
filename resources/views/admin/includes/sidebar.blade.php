  @if(auth()->user()->role_id == 1)
 <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-profile">
          <div class="d-flex align-items-center justify-content-between">
            <img src="{{url('public/'.auth()->user()->image)}}" alt="profile">
            <div class="profile-desc">
              <p class="name mb-0">{{auth()->user()->name}}</p>
              <!--<p class="designation mb-0">Sales Manager</p>-->
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item active" style="background:#6201ed52;">
            <a class="nav-link" href="{{url('home')}}">
              <i class="fas fa-tachometer-alt menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('payment/gateway')}}">
              <i class="fa fa-snowflake-o menu-icon"></i>
              <span class="menu-title">Payment Gatway</span>
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="{{url('oprater')}}">
              <i class="fa fa-snowflake-o menu-icon"></i>
              <span class="menu-title">Operator</span>
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="{{url('operator/banner')}}">
              <i class="fa fa-picture-o menu-icon"></i>
              <span class="menu-title">Operator Banner</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="fa fa-tasks menu-icon"></i>
              <span class="menu-title"> Plan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{url('package')}}">Package</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('plan')}}">Plan</a></li>
                <li class="nav-item" style="border-bottom: transparent;"> 
                  <a class="nav-link" href="{{url('planduration')}}">Plan Duration</a>
                </li>
                
              </ul>
            </div>
          </li>
            <!--  <li class="nav-item">
            <a class="nav-link" href="{{url('plan')}}">
              <i class="fa fa-tasks menu-icon"></i>
              <span class="menu-title">Plan</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="{{url('banner')}}">
              <i class="fa fa-picture-o menu-icon"></i>
              <span class="menu-title">Add Banners</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="{{url('offer')}}">
              <i class="fa fa-gift menu-icon"></i>
              <span class="menu-title">Add Offer Banners</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="{{url('news')}}">
              <i class="fa fa-newspaper-o menu-icon"></i>
              <span class="menu-title">Add News</span>
            </a>
          </li>
           <!--<li class="nav-item">
            <a class="nav-link" href="{{url('cashback')}}">
              <i class="fa fa-money menu-icon"></i>
              <span class="menu-title">Cashback Management</span>
            </a>
          </li>-->
           <li class="nav-item">
            <a class="nav-link" href="{{url('recharge/report')}}">
              <i class="fa fa-money menu-icon"></i>
              <span class="menu-title">Recharge Report</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('payment/history')}}">
              <i class="fa fa-money menu-icon"></i>
              <span class="menu-title">Payment History</span>
            </a>
          </li>
          <!-- <li class="nav-item">-->
          <!--  <a class="nav-link" href="{{url('notification')}}">-->
          <!--    <i class="fa fa-bell menu-icon"></i>-->
          <!--    <span class="menu-title">Notification</span>-->
          <!--  </a>-->
          <!--</li>-->

          
           <li class="nav-item">
            <a class="nav-link" href="{{url('customers')}}">
              <i class="fas fa-users menu-icon"></i>
              <span class="menu-title">Customers</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="{{url('wallettowallet')}}">
              <i class="fas fa-wallet menu-icon"></i>
              <span class="menu-title">Wallet To Wallet</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('logout')}}">
              <i class="fa fa-power-off menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
      @endif