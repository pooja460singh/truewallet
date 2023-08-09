 @extends('front.layouts.master')
 @section('content')
<!--//==Page Header Start==//-->	  
      <div class="page-header black-overlay">
         <div class="container breadcrumb-section">
            <div class="row pad-s15">
				<div class="col-md-12">
				   <h2><span class="wa-theme-color">Contact Us</span> </h2>
				   <div class="clear"></div>
				   <div class="breadcrumb-box">
					  <ul class="breadcrumb">
						 <li>
							<a href="{{url('/')}}" class="text-white">Home</a>
						 </li>
						 <li class="active">Contact Us</li>
					  </ul>
				   </div>
				</div>
            </div>
         </div>
      </div>
	  <!--//==Page Header End==//-->

	  <!--//==Contact Page Start==//-->
      <section class="padTB60">
         <div class="container">
            <div class="row pad-s15">
			
   			   <!--//==Contact Map Section Start==//-->
                  <div class="col-md-4 col-sm-6">
   			      <!--//==Section Heading Start==//-->
                     <div class="wa-heading-style1">
                        <h2><span class="wa-theme-color">Contact</span> Info</h2>
                        <div class="clear"></div>
                     </div>
   				  <!--//==Section Heading End==//-->
   				  
                     <div class="row">
   				     
   					 <!--//==Mailing Address==//-->
                        <div class="col-md-12 col-sm-12 marB20">
                           <div class="col-md-2 col-sm-2 col-xs-2">
                              <div class="row">
                                 <div class="special-metabox light-metabox">
                                    <span class="top-box"><i class="fa fa-home"></i></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-10 col-sm-10 col-xs-10">
                              <p>Plot Number 63/11, Sewak Park, Dwarka Mor, New Delhi - 110059 </p>
                           </div>
                        </div>
   					 
   					 <!--//==Phone==//-->
                        <div class="col-md-12 col-sm-12 marB20">
                           <div class="col-md-2 col-sm-2 col-xs-2">
                              <div class="row">
                                 <div class="special-metabox light-metabox">
                                    <span class="top-box"><i class="fa fa-whatsapp"></i></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-10 col-sm-10 col-xs-10"> 
                              (+91) 7860000332
                           </div>
                        </div>
   					 
   					 <!--//==Fax==//-->
                        
   					 
   					 <!--//==Email Address==//-->
                        <div class="col-md-12 col-sm-12 marB20">
                           <div class="col-md-2 col-sm-2 col-xs-2">
                              <div class="row">
                                 <div class="special-metabox light-metabox">
                                    <span class="top-box"><i class="fa fa-envelope-o"></i></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-10 col-sm-10 col-xs-10">
                              <p>info@truewallet.co.in<br> customercare@truewallet.co.in</p>
                           </div>
                        </div>
                     </div>
                 
                  </div>
   			   <!--//==Contact Info Section End==//-->
   			   
   			   <!--//==Contact Map Section Start==//-->
                  <div class="col-md-8 col-sm-6 marB20">
                     <div style='overflow:hidden;height:410px;width:100%;'>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28496.643123503643!2d83.05216609243723!3d26.77370727398798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399125296d7a1329%3A0x5c6441e08978bf29!2sKhalilabad%2C%20Uttar%20Pradesh%20272175!5e0!3m2!1sen!2sin!4v1568029070878!5m2!1sen!2sin" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                     </div>
                  </div>
   			   <!--//==Contact Map Section End==//-->
			   </div>
         </div>
      </section>
	  <!--//==Contact Page End==//-->
      <section class="services padT60 d-sec pb-55">
         <div class="container">
            <div class="col-md-12">
               
              <!--//==Section Heading Start==//-->
                  <div class="wa-heading-style1 text-center">
                     <h2><span class="wa-theme-color text-white">Get In Touch</span></h2>
                     <div class="clear"></div>
                     <em class="text-white">when an unknown printer took a galley of type and scrambled it to make a type, aque ipsa  
                     inventore</em>
                  </div>
              <!--//==Section Heading End==//-->
              
              <!--//==Contact Form Row Start==//-->
                  <div class="row">
                     <div class="contact-form-section">
                        <div class="row">
                           <div class="col-md-12">
                        
                       <!--//==Contact Form Start==//-->
                              <form class="contact-form">
                       
                         <!--//==Contact Input Field==//-->
                                 <div class="col-md-6 form-group">
                                    <input type="text"  placeholder="Your Name">
                                 </div>
                         
                         <!--//==Contact Input Field==//-->
                                 <div class="col-md-6 form-group">
                                    <input type="email"  id="exampleInputEmail" placeholder="Your Email">
                                 </div>
                         
                         <!--//==Contact Input Field==//-->
                                 <div class="col-md-6 form-group">
                                    <input type="number"  id="exampleInputNUmber" placeholder="Your Number">
                                 </div>
                         
                         <!--//==Contact Input Field==//-->
                                 <div class="col-md-6 form-group">
                                    <input type="text"  id="exampleInputWeburl" placeholder="Your Website Url">
                                 </div>
                         
                         <!--//==Contact Input Field==//-->
                                 <div class="col-md-12 form-group">
                                    <textarea name="contact_message" class="textarea-message" placeholder="Your Message" rows="10"></textarea>                    
                                 </div>
                         
                                 <div class="col-md-12">
                                    <button type="submit" class="wa-button blue-btn">Send Message</button>
                                 </div>
                              </form>
                       <!--//==Contact Form End==//-->
                       
                           </div>
                        </div>
                     </div>
                  </div>
              <!--//==Contact Form Row End==//-->
            </div>
         </div>
      </section>
	  <!--//======= Partener sections Start=======//-->
      
      <!--//======= Partener sections End=======//-->  
      @endsection