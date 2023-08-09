
	
    <!--//==Header Start==//-->
      <header id="main-header">
         <div id="top-bar" class="wa-theme-bg color-light">
            <div class="container">
               <div class="row">
                  <div class="col-md-8 col-sm-8 pull-left">
                     <ul class="inline">
                        <li><a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i> (+91) 7860000332</a></li>
                        <li class="textnormal"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> info@truewallet.co.in</a></li>
                        <li class="textnormal"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> customercare@truewallet.co.in</a></li>
                     </ul>
                  </div>
                  <div class="col-md-4 col-sm-4 pull-right">
                     <!--<ul class="inline">-->
                     <!--   <li><a href="{{url('user/login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> sign in</a></li>-->
                     <!--   <li><a href="{{url('user/register')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> register</a></li>-->
                     <!--</ul>-->
                  </div>
               </div>
            </div>
         </div>
         <!--//==Navbar Start==//-->
         <div id="main-menu" class="wa-main-menu">
            <!-- Menu -->
            <div class="wathemes-menu relative">
               <!-- navbar -->
               <div class="navbar navbar-default navbar-bg-light" role="navigation">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="navbar-header">
                              <!-- Button For Responsive toggle -->
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                              <span class="sr-only">Toggle navigation</span> 
                              <span class="icon-bar"></span> 
                              <span class="icon-bar"></span> 
                              <span class="icon-bar"></span></button> 
                              <!-- Logo -->
                              <a class="navbar-brand" href="{{url('/')}}">
                              <img class="site_logo" alt="Site Logo"  src="{{url('public/assets/img/logo.png')}}" />
                              </a>
                           </div>
                           <!-- Navbar Collapse -->
                           <div class="navbar-collapse collapse">
                              <!-- nav -->
                              <ul class="nav navbar-nav">
                                 <!-- Home Menu -->
                                 <li class="{{ Request::path() == '/' ? 'active' : '' }}">
        									         <a href="{{url('/')}}">Home</a> 
        								         </li>
                                 <li class="{{ Request::path() == 'about' ? 'active' : '' }}">
                                    <a href="{{url('about')}}">About Us</a>
                                 </li>
                                 <li class="{{ Request::path() == 'services' ? 'active' : '' }}">
                                    <a href="{{url('services')}}">Services</a> 
                                 </li>
                                 <!-- Blog Menu -->
                                 <li class="{{ Request::path() == 'process' ? 'active' : '' }}">
                                    <a href="{{url('process')}}">Process</a>
                                 </li>
                                 <li class="{{ Request::path() == 'contact' ? 'active' : '' }}">
                                    <a href="{{url('contact')}}">Contact Us</a> 
                                 </li>
                                 <!-- Ends faq Menu -->
                                 <!-- login area Menu -->
                                 <li>
                                     <a href="https://play.google.com/store/apps/details?id=com.app.truejourney" style="background: transparent;padding: 0;">
                                    <button class="dark-button"><i class="fa fa-android"></i> Download App</button>
                                    </a>
                                 </li>
                                 <!-- Ends login area Menu -->
                                 <!-- Contact Block -->
                                
                                 <!-- Ends Widgets Block -->
                              </ul>
                              <!-- Right nav -->
                           </div>
                           <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.col-md-12 -->
                     </div>
                     <!-- /.row -->
                  </div>
                  <!-- /.container -->
               </div>
               <!-- navbar -->
            </div>
            <!--  Menu -->
         </div>
         <!--//==Navbar End==//-->
      </header>
    <!--//==Header End==//-->