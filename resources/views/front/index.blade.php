  @extends('front.layouts.master')
 @section('content')
  <!--//=======Main Static Banner Start=======//-->         
      <!--<div class="wa_main_bn_wrap">-->
      <!--   <div id="home1-main-slider" class="owl-carousel owl-theme">-->
      <!--      <div class="item ">-->
      <!--         <figure>-->
      <!--            <img src="{{url('public/assets/img/slider/slider2.jpg')}}" class="new-fig01" alt=""/>-->
                 
      <!--         </figure>-->
      <!--      </div>-->
      <!--      <div class="item ">-->
      <!--         <figure>-->
      <!--            <img src="{{url('public/assets/img/slider/slider1.jpg')}}" class="new-fig01" alt=""/>-->
      <!--            <figcaption>-->
                    
      <!--               <h2> Welcome To <span class="wa-theme-color"> TrueWallet</span></h2>-->
                    
      <!--            </figcaption>-->
      <!--         </figure>-->
      <!--      </div>-->
      <!--      <div class="item ">-->
      <!--         <figure>-->
      <!--            <img src="{{url('public/assets/img/slider/slider3.jpg')}}" class="new-fig01" alt=""/>-->
                  
      <!--         </figure>-->
      <!--      </div>-->
            
           
      <!--   </div>-->
      <!--</div>-->
  <!--//=======Main Static Banner End=======//--> 
   <!--//=======Recharge Section=======//--> 
      <section class="padT60" style="background-image: url('{{ asset('public/assets/img/slider/slider1.jpg')}}');background-repeat: no-repeat;background-color: #f2f2f2;background-position: right;">
         <div class="container-fluid">          
            <div class="row color-light">
               <div class="col-sm-12">
                  <div class="wa-heading-style1 pad-s15 text-center true-wl">
                        <h2><span class="wa-theme-color">Recharge &</span> Bill Payment</h2>
                        <div class="clear"></div>
                        <em>when an unknown printer took a galley of type and scrambled it to make a type, aque ipsa  
                        inventore</em>
                  </div>
                  
                  <!--wa Info Tabs-->
                  <div class="wa-info-tabs">
                     <!--wa Tabs-->
                     <div class="sidebar-tab wa-tabs col-md-7 col-sm-7" id="wa-tabs">
                        <div class="col-md-4 col-sm-4 padL0">
                           <div class="">
                             <!--Tab Btns-->
                             <div class="tab-btns clearfix mb9-back">
                               <a href="#wa-mob" class="tab-btn active-btn"><i class="fa fa-mobile" aria-hidden="true"></i>Prepaid</a>
                               <a href="#wa-postpaid" class="tab-btn"><i class="fa fa-mobile" aria-hidden="true"></i>Postpaid</a>
                               <a href="#wa-dth" class="tab-btn"><i class="fa fa-television" aria-hidden="true"></i>DTH</a>
                        
                               <a href="#wa-electricity" class="tab-btn"><i class="fa fa-lightbulb-o" aria-hidden="true"></i>Electricity</a>
                               
                               <a href="#wa-electricity" class="tab-btn"><i class="fa fa-free-code-camp" aria-hidden="true"></i>Gas</a>
                               <a href="#wa-electricity" class="tab-btn"><i class="fa fa-tint" aria-hidden="true"></i>Water</a>
                               <a href="#wa-electricity" class="tab-btn"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i>DataCard</a>
                               <a href="#wa-electricity" class="tab-btn"><i class="fa fa-phone" aria-hidden="true"></i>Landline</a>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-8 col-sm-8 default-color">
                           <div class="">
                              <!--Tabs Container-->
                              <div class="tabs-container mb-backs pad30 white-bg marB-s30">
                                  <!--Tab-->
                                  <form action="" method="post" id="mobile_recharge" enctype="multipart/form-data">
                                      {{ csrf_field() }} 
                                  <div class="tab active-tab" id="wa-mob">
                                    <h4 class="mb9-back">Recharge your mobile</h4>
                                    <div class="billing-fields row">
                                       
                                        <input type="hidden" id="prepaid1" name="selector1" checked="checked" value="Prepaid">
                                       <div class="clear"></div>
                                       <p class="form-row col-sm-12" >
                                         <label for="prepaid1">Mobile Number</label>
                                         <input type="text" name="phone_number" id="phn" placeholder="Mobile Number" class="form-controller">
                                             <span class="alert " id="phone_number"></span>
                                       </p>
                                       <p class="form-row col-sm-6">
                                         <label for="prepaid1">Amount</label>
                                         <input type="text" name="amount" id="phn" placeholder="Amount" class="form-controller">
                                         <input type="hidden" name="payment_mode_first" value="{{$payment_mode}}" id="payment_mode_first">
                                         <input type="hidden" name="status_first" value="{{$status}}" id="status_first">
                                          <span class="alert " id="amount"></span>
                                          
                                       </p>

                                       <p class="form-row col-sm-6">
                                          <label for="prepaid1">Choose Oprator</label>
                                          <select name="oprator"  class="form-controller prepaid">
                                          @foreach($oprator as $oprator_list)
                                            <option value="{{$oprator_list->oprater_code}}">{{$oprator_list->oprater_name}}</option>
                                           @endforeach
                                         </select>
                                         
                                          <div class="alert " id="oprator"></div>
                                       </p>
                                       <p class="col-sm-12">
                                         <input type="submit" value="Recharge" name="signup" class="wa-button marL0">
                                       </p>
                                    </div>
                                 </div>
                               </form>
                              <form action="" method="post" id="mobile_recharge_postpaid" enctype="multipart/form-data">
                                      {{ csrf_field() }} 
                                  <div class="tab " id="wa-postpaid">
                                    <h4 class="mb9-back">Pay your postpaid bill</h4>
                                    <div class="billing-fields row">
                                       <input type="hidden" id="postpaid1" name="selector1" value="Postpaid">
                                      
                                       <div class="clear"></div>
                                       <p class="form-row col-sm-12" >
                                         <label for="prepaid1">Mobile Number</label>
                                         <input type="text" name="phone_number" id="phn" placeholder="Mobile Number" class="form-controller">
                                             <span class="alert " id="phone_number"></span>
                                       </p>
                                       <p class="form-row col-sm-6">
                                         <label for="prepaid1">Amount</label>
                                         <input type="text" name="amount" id="phn" placeholder="Amount" class="form-controller">
                                          <span class="alert " id="amount"></span>
                                          
                                       </p>
                                       <input type="hidden" name="payment_mode_second" value="{{$payment_mode}}" id="payment_mode_second">
                                         <input type="hidden" name="status_second" value="{{$status}}" id="status_second">

                                       <p class="form-row col-sm-6">
                                          <label for="prepaid1">Choose Oprator</label>
                                          <select name="oprator"  class="form-controller prepaid">
                                          @foreach($preoprator as $oprator_list)
                                            <option value="{{$oprator_list->oprater_code}}">{{$oprator_list->oprater_name}}</option>
                                           @endforeach
                                         </select>
                                         
                                          <div class="alert " id="oprator"></div>
                                       </p>
                                       <p class="col-sm-12">
                                         <input type="submit" value="Recharge" name="signup" class="wa-button marL0">
                                       </p>
                                    </div>
                                 </div>
                               </form>
                               <div class="dth">
                               <form action="" method="post" id="dth_recharge" enctype="multipart/form-data">
                                      {{ csrf_field() }} 
                                  <div class="tab" id="wa-dth">
                                    <h4>Recharge your DTH </h4>
                                    <div class="billing-fields row marT20">
                                        <input type="hidden" id="dth" name="selector1"  value="DTH">
                                       <p class="form-row col-sm-12">
                                           <select name="oprator"  class="form-controller">
                                             <option value="">DTH Operator</option>
                                          @foreach($oprator_dth as $dth)
                                            <option value="{{$dth->oprater_code}}">{{$dth->oprater_name}}</option>
                                           @endforeach
                                         </select>
                                       </p>
                                       <div class="clear"></div>

                                       <input type="hidden" name="payment_mode_third" value="{{$payment_mode}}" id="payment_mode_third">
                                         <input type="hidden" name="status_third" value="{{$status}}" id="status_third">

                                       <p class="form-row col-sm-6">
                                         <label for="prepaid1">Customer Id</label>
                                         <input type="text" name="phone_number" id="phn" placeholder="Number: e.g. +919993480549" class="form-controller">
                                             <span class="alert " id="phone_number"></span>
                                       </p>
                                       <p class="form-row col-sm-6">
                                         <label for="prepaid1">Amount</label>
                                         <input type="text" name="amount" id="phn" placeholder="Amount" class="form-controller">
                                          <span class="alert " id="amount"></span>
                                          
                                       </p>

                                       <div class="clear"></div>
                                       <p class="col-sm-12">
                                         <input type="submit" value="Recharge" name="signup" class="wa-button marL0">
                                       </p>
                                    </div>
                                 </div>
                                  </form>
                                  </div>
                                   <div class="electricity">
                                    <div class="electric_Recharge">
                                  <form action="" method="post" id="electric_recharge" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                  <div class="tab" id="wa-electricity">
                                    <h4>Pay your electricity bill</h4>
                                    <div class="billing-fields row marT20">
                                         <input type="hidden" id="dth" name="selector1"  value="Electricity">
                                       <p class="form-row col-sm-12">
                                        <select name="oprator"  class="form-controller">
                                             <option value="">Electric Operator</option>
                                          @foreach($oprator_electric as $electric)
                                            <option value="{{$electric->oprater_code}}">{{$electric->oprater_name}}</option>
                                           @endforeach
                                         </select>
                                       </p>
                                     <div class="clear"></div>
                                     <input type="hidden" name="payment_mode_fourth" value="{{$payment_mode}}" id="payment_mode_fourth">
                                         <input type="hidden" name="status_fourth" value="{{$status}}" id="status_fourth">

                                       <p class="form-row col-sm-6">
                                         <label for="prepaid1">Account No.</label>
                                         <input type="text" name="phone_number" id="phn" placeholder="Number: e.g. +919993480549" class="form-controller">
                                             <span class="alert " id="phone_number"></span>
                                       </p>
                                       <p class="form-row col-sm-6">
                                         <label for="prepaid1">Amount</label>
                                         <input type="text" name="amount" id="phn" placeholder="Amount" class="form-controller">
                                          <span class="alert " id="amount"></span>
                                          
                                       </p>
                                       <p class="col-sm-12">
                                         <input type="submit" value="Recharge" name="signup" class="wa-button marL0">
                                       </p>
                                    </div>
                                 </div>
                                 </form>
                                 </div>
                                 </div>
                              </div>
                           </div>
                        </div>                     
                     </div>
                     <div class="col-sm-5 col-md-5">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                              <li data-target="#myCarousel" data-slide-to="1"></li>
                              <li data-target="#myCarousel" data-slide-to="2"></li>
                           </ol>

                           <!-- Wrapper for slides -->
                           <div class="carousel-inner">
                              <div class="item active">
                                <img src="{{url('public/assets/img/background/pay3.jpg')}}" alt="Los Angeles" style="width:100%;">
                              </div>
                              <div class="item">
                                <img src="{{url('public/assets/img/background/pay1.jpg')}}" alt="Chicago" style="width:100%;">
                              </div>
                              <div class="item">
                                <img src="{{url('public/assets/img/background/pay6.jpg')}}" alt="New york" style="width:100%;">
                              </div>
                           </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                              <span class="glyphicon glyphicon-chevron-left"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                              <span class="glyphicon glyphicon-chevron-right"></span>
                              <span class="sr-only">Next</span>
                            </a>
                        </div>
                     </div>
                  </div>
                  <!--wa Info Tabs Close-->
               </div>
            </div>         
         </div>
      </section>
   <!--//=======Recharge Section End=======//--> 


  <!--//=======How we work Start=======//-->      
      <section class="how_we_work padT100 mb-60">
         <div class="container">
       <div class="row">
        <div class="col-md-6 col-md-offset-0 col-sm-6 marB-s30">
                  <img src="{{url('public/assets/img/all/about.jpg')}}" alt="" style="border-radius: 8px;">
        </div>
        
        <div class="col-md-6 col-sm-6">       
          <div class="wa-heading-style1 mb-backs pad-s15 text-center">
             <h2><span class="wa-theme-color">About</span> Us</h2>
             <div class="clear"></div>
             <em>when an unknown printer took a galley of type and scrambled it to make a type</em>
          </div>
          <p class="text-justify">
                     Welcome at True Wallet Pvt Ltd.
 to join a life long business opportunity with us. Recharge stands among the best Online Mobile / DTH Recharge Service Providers, including all major mobile operators and DTH service providers. Become a part of this giant with a very small investment. Start today for a better future. Start your own mobile recharge business with us. Establishment of higher marketing standard is a key of global market structure. Every financial standard and life standard of people depends upon the effective marketing strategy. Impost Money brings you a standard and all new marketing plan in network marketing.
               </p> 
            </div>
       </div>
     </div>
    </section>
  <!--//=======How we work End=======//--> 
  <!--//==Services Sections Start==//-->
      <section class="services padT60 d-sec pb-55">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12">
         
           <!--//==Section Heading Start==//-->
                  <div class="wa-heading-style1 pad-s15 text-center">
                     <h2><span class="wa-theme-color text-white">Our</span><span class="text-white"> Services</span></h2>
                     <div class="clear"></div>
                     <em class="text-white">Mobile Recharge, Travel & Bulk SMS API Made Easy!</em>
                     <p class="text-white" style="margin-top: 20px;">
                        Welcome at True Wallet Pvt Ltd.
 to join a life long business opportunity with us. Recharge stands among the best Online Mobile / DTH Recharge Service Providers, including all major mobile operators and DTH service providers.

                        Become a part of this giant with a very small investment. Start today for a better future. Start your own mobile recharge business with us. Establishment of higher marketing standard is a key of global market structure. Every financial standard and life standard of people depends upon the effective marketing strategy. Impost Money brings you a standard and all new marketing plan in network marketing.
                     </p>
                  </div>
          <!--//==Section Heading End==//-->
           
                  <div class="wa-row-only-md">
          
           <!--//==Services Item Start==//-->
                     <div class="col-md-4 col-sm-6">
                        <div class="wa-box-style2">
                           <div class="icon"> 
                              <img src="{{url('public/assets/img/background/service1.png')}}">
                           </div>
                           <div class="text">
                              <h4 class="blue-colr"><a href="#">MOBILE RECHARGES</a></h4>
                              <p>
                                 We provide recharge service in India for the mobile networks. Online recharge service is convenient and fast that facilitates recharge of prepaid mobile.
                              </p>
                           </div>
                        </div>
                     </div>
           <!--//==Services Item End==//-->
           
           <!--//==Services Item Start==//-->
                     <div class="col-md-4 col-sm-6">
                        <div class="wa-box-style2">
                           <div class="icon"> 
                              <img src="{{url('public/assets/img/background/service2.png')}}">
                           </div>
                           <div class="text">
                              <h4 class="blue-colr"><a href="#">MONEY TRANSFER</a></h4>
                              <p>
                                 We take pride in weaving leading edge money transfer solutions that enables quick, safe and convenient transfer of money.
                              </p>
                              <p style="visibility: hidden;">
                                 and convenient transfer of money.
                              </p>
                           </div>
                        </div>
                     </div>
           <!--//==Services Item End==//-->
           
           <!--//==Services Item Start==//-->
                     <div class="col-md-4 col-sm-6">
                        <div class="wa-box-style2">
                           <div class="icon"> 
                               <img src="{{url('public/assets/img/background/service3.png')}}">
                           </div>
                           <div class="text">
                              <h4 class="blue-colr"><a href="#">TRAVEL BOOKING</a></h4>
                              <p>
                                 Air ticket fares vary every day. Airlines follow a weekly cycle i.e. they have a pricing system for each week.
                              </p>
                              <p style="visibility: hidden;">
                                 and convenient transfer of money.
                              </p>
                           </div>
                        </div>
                     </div>
           <!--//==Services Item End==//-->
           
           <!--//==Services Item Start==//-->
                     <div class="col-md-4 col-sm-6">
                        <div class="wa-box-style2">
                           <div class="icon"> 
                              <img src="{{url('public/assets/img/background/service4.png')}}">
                           </div>
                           <div class="text">
                              <h4 class="blue-colr"><a href="#">BILL PAYMENT</a></h4>
                              <p>
                                Truewallet Bill Payment service currently provide Payment facility to Electricity bill, Broadband bill, Gas bill, Landline bill, Water bill and insurance.
                              </p>
                              <p style="visibility: hidden;">
                                 and convenient transfer of money.
                              </p>
                           </div>
                        </div>
                     </div>
           <!--//==Services Item End==//-->
           
           <!--//==Services Item Start==//-->
                     <div class="col-md-4 col-sm-6">
                        <div class="wa-box-style2">
                           <div class="icon"> 
                              <img src="{{url('public/assets/img/background/service5.png')}}">
                           </div>
                           <div class="text">
                              <h4 class="blue-colr"><a href="#">DTH Recharges</a></h4>
                              <p>
                                 We provides recharge service in India for the DTH Recharges.Online recharge service is convenient and fast that facilitates online/Offline DTH recharge service provider.
                              </p>
                           </div>
                        </div>
                     </div>
           <!--//==Services Item End==//-->
           
           <!--//==Services Item Start==//-->
                     <div class="col-md-4 col-sm-6">
                        <div class="wa-box-style2">
                           <div class="icon"> 
                              <img src="{{url('public/assets/img/background/service6.png')}}">
                           </div>
                           <div class="text">
                              <h4 class="blue-colr"><a href="#">Data Recharges</a></h4>
                              <p>
                                 We provides recharge service for the Data Recharges. Online recharge service is convenient and fast that facilitates online/Offline Data Recharges service provider.
                              </p>
                           </div>
                        </div>
                     </div>
                 <!--//==Services Item End==//-->          
             </div>
               </div>
            </div>
         </div>
      </section>
    <!--//==Services Sections End==//-->
    
    <!--//======= Coupon Section Start=======//-->
      <section class="wa-main-coupon padT70 padB30">
         <div class="container">
            <div class="row">
               <div class="col-md-5 col-sm-5">
                  <img src="{{url('public/assets/img/background/app-mobile.png')}}">
               </div>
               <div class="col-md-7 col-sm-7">
                  <div class="wa-heading-style1 pad-s15">
                     <h2><span class="wa-theme-color">Download Our Truewallet
                        </span> Mobile App Now</h2>
                     <div class="clear"></div>
                     <em>Download our app for the fastest, most convenient way to send Recharge.</em>
                     <p class="mt-20 text-justify">
                        Ridens mediocritatem ius an, eu nec magna imperdiet. Mediocrem qualisque in has. Enim utroque perfecto id mei, ad eam tritani labores facilisis, ullum sensibus no cum. Eius eleifend in quo.
                     </p>
                     <ul>
                        <li>
                           Recharge
                        </li>
                        <li>
                           Bill Payment
                        </li>
                        <li>
                           Booking Online
                        </li>
                        <li>
                           and much more.....
                        </li>
                     </ul>
                     <!--<img src="{{url('public/assets/img/background/app-store.png')}}" class="mr-15 mt-20">-->
                     <a href="https://play.google.com/store/apps/details?id=com.app.truejourney">
                     <img src="{{url('public/assets/img/background/google-play-store.png')}}" class="mr-15 mt-20">
                     </a>
                  </div>
                  
               </div>
      </div>
     </div>
    </section>
  <!--//======= Coupon Section End=======//-->      

  <!--//======= Testimonial and Why Choose Us Section Start=======//-->
    <section class="wa_multi_layout grey-bg">
        <div class="special-style special-style-dark-theme left-one-third col-md-7 col-md-offset-5 pull-right">
            <div class="bg-image" style="background-image:url('{{ asset('public/assets/img/background/special-bg.jpg')}}');"></div>
        </div>
        <div class="container special-area-widthfull">
          <div class="row">
            <!--//======= Testimonial Section Start=======//-->
            <div class="grey-bg-sm col-md-4 col-sm-12">
              <div class="padTB60">
                <!--//==Section Heading Start==//-->
                <div class="wa-heading-style1 pad-s15">
                 <h2><span class="wa-theme-color">Our Client</span> Testimonials</h2>
                 <div class="clear"></div>
                 <em>when an unknown printer took a galley of type and scrambled it to make a type.</em>
                  </div>
                <!--//==Section Heading End==//-->            
                <!--//==Testimonial List Start==//-->
                <div id="testimonial-section1" class="owl-carousel-style1 pad-s15">
                  <!--//==Testimonial List Item Start==//-->
                  <div class="wa-item">               
                    <div class="testimonial-block-style1">
                       <blockquote>
                        But also the leap into electronic type 
                        set remaining essentially unchang
                        It was popularised in the 1960s with 
                        the release of Letraset sheets contain 
                        Lorem Ipsum passages
                       </blockquote>
                       <div class="client-detail-style1">
                        <figure>
                         <img src="{{url('public/assets/img/testimonial/img1.jpg')}}" alt="" class="img-circle">
                        </figure>
                        <div class="client-meta-style1">
                         <span class="member-name">Shane Foodle</span>
                         <span class="member-designation">ceo Webaashi</span>
                        </div>
                       </div>
                    </div>
                   </div>
                  <!--//==Testimonial List Item Start==//-->
                  <!--//==Testimonial List Item End==//-->
                   <div class="wa-item">
                    <div class="testimonial-block-style1">
                       <blockquote>
                        But also the leap into electronic type 
                        set remaining essentially unchang
                        It was popularised in the 1960s with 
                        the release of Letraset sheets contain 
                        Lorem Ipsum passages
                       </blockquote>
                       <div class="client-detail-style1">
                        <figure>
                         <img src="{{url('public/assets/img/testimonial/img2.jpg')}}" alt="" class="img-circle">
                        </figure>
                        <div class="client-meta-style1">
                         <span class="member-name">Shane Foodle</span>
                         <span class="member-designation">ceo Webaashi</span>
                        </div>
                       </div>
                    </div>
                  </div>
                  <!--//==Testimonial List Item Start==//-->
                  <!--//==Testimonial List Item End==//-->
                  <div class="wa-item">
                    <div class="testimonial-block-style1">
                       <blockquote>
                        But also the leap into electronic type 
                        set remaining essentially unchang
                        It was popularised in the 1960s with 
                        the release of Letraset sheets contain 
                        Lorem Ipsum passages
                       </blockquote>
                       <div class="client-detail-style1">
                        <figure>
                         <img src="{{url('public/assets/img/testimonial/img3.jpg')}}" alt="" class="img-circle">
                        </figure>
                        <div class="client-meta-style1">
                         <span class="member-name">Shane Foodle</span>
                         <span class="member-designation">ceo Webaashi</span>
                        </div>
                       </div>
                    </div>
                  </div>
                  <!--//==Testimonial List Item End==//-->
                </div>
                <!--//==Testimonial List End==//-->
                
              </div>
            </div>
            <!--//======= Testimonial Section End=======//-->
            <!--//======= Why Choose Us Section Start=======//-->
              <div class="col-md-8 col-sm-12">
              <div class="wa-heading-style1 wa-heading-style1-reverse padL80 padT60 pad-s15">
                      <h2><span class="wa-theme-color">Why Choose</span> Truewallet</h2>
                      <div class="clear"></div>
                      <em>when an unknown printer took a galley of type and scrambled it to make a type, aque ipsa inventore</em>
                   </div>
              <div class="row color-light padL80 padB80 pad-s15">
                <div class="col-md-12 col-sm-12 marB20">
                  <div class="col-md-1 col-sm-1 col-xs-2">
                     <div class="row">
                      <div class="special-metabox theme-metabox">
                      <span class="bottom-box"><i class="fa fa-life-ring" aria-hidden="true"></i></span>
                      </div>
                     </div>
                  </div>
                  <div class="col-md-10 col-sm-10 col-xs-10">
                     <h4 class="features-fnt">Direct Tie-Up With All Operators.</h4>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="col-md-12 col-sm-12 marB20">
                  <div class="col-md-1 col-sm-1 col-xs-2">
                     <div class="row">
                      <div class="special-metabox theme-metabox">
                       
                       <span class="bottom-box"><i class="fa fa-life-ring" aria-hidden="true"></i></span>
                      </div>
                     </div>
                  </div>
                  <div class="col-md-10 col-sm-10 col-xs-10">
                     <h4 class="features-fnt">All Types Of Recharges (SPECIAL, VALIDITY,3G & FLEXI)</h4>
                     
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="col-md-12 col-sm-12 marB20">
                  <div class="col-md-1 col-sm-1 col-xs-2">
                     <div class="row">
                      <div class="special-metabox theme-metabox">
                       
                       <span class="bottom-box"><i class="fa fa-life-ring" aria-hidden="true"></i></span>
                      </div>
                     </div>
                  </div>
                  <div class="col-md-10 col-sm-10 col-xs-10">
                     <h4 class="features-fnt">Centralized Dispute Handling System</h4>
                     
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="col-md-12 col-sm-12 marB20">
                  <div class="col-md-1 col-sm-1 col-xs-2">
                     <div class="row">
                      <div class="special-metabox theme-metabox">
                       
                       <span class="bottom-box"><i class="fa fa-life-ring" aria-hidden="true"></i></span>
                      </div>
                     </div>
                  </div>
                  <div class="col-md-10 col-sm-10 col-xs-10">
                     <h4 class="features-fnt">Mobile , DTH, Data Card, Insurance, Gas, Electricity Bills, Post-Paid, Prepaid Etc.</h4>
                     
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="col-md-12 col-sm-12 marB20">
                  <div class="col-md-1 col-sm-1 col-xs-2">
                     <div class="row">
                      <div class="special-metabox theme-metabox">
                       
                       <span class="bottom-box"><i class="fa fa-life-ring" aria-hidden="true"></i></span>
                      </div>
                     </div>
                  </div>
                  <div class="col-md-10 col-sm-10 col-xs-10">
                     <h4 class="features-fnt">Offline Recharge System Through Any Sim Card</h4>
                     
                  </div>
                  <div class="clear"></div>
                </div>
              </div>           
            </div>
            <!--//======= Why Choose Us Section End=======//-->
          </div>
        </div>
    </section>
  <!--//======= Testimonial and Why Choose Us Section End=======//--> 
  
    
  
    
   
  <!--//======= Partener sections Start=======//-->
     
      <form action="{{url('front/recharge')}}" method="POST" hidden="hidden">
   {{ csrf_field() }} 
   <input type="text" name="MerchantID" id="MerchantID">
    <input type="text" name="CustomerID" id="CustomerID">
   
  <button type="submit" id="rzp-paymentresponse" class="btn btn-success">Submit</button>
  </form>
  <!--//======= Partener sections End=======//-->
  @endsection  
  @push('scripts')
<script type="text/javascript" id="resourceScript" src="https://pgi.billdesk.com/payments-checkout-widget/src/app.bundle.js" async></script>
<script src="{{url('public/dist/front.js') }}"></script>

@endpush