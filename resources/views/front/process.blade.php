  @extends('front.layouts.master')
 @section('content')
 <!--//==Page Header Start==//-->	  
      <div class="page-header black-overlay">
         <div class="container breadcrumb-section">
		    <div class="row pad-s15">
				<div class="col-md-12">
				   <h2><span class="wa-theme-color">Process</span> </h2>
				   <div class="clear"></div>
				   <div class="breadcrumb-box">
					  <ul class="breadcrumb">
						 <li>
							<a href="{{url('/')}}" class="text-white">Home</a>
						 </li>
						 <li class="active">Process</li>
					  </ul>
				   </div>
				</div>
            </div>
         </div>
      </div>
	  <!--//==Page Header End==//-->
	  
	  <!--//=======How we work Start=======//-->        
      <section class="how_we_work padT60 mb-60">
        <div class="container">
          <div class="wa-heading-style1 mb-backs pad-s15 text-center">
            <h2><span class="wa-theme-color">Prep</span>aid</h2>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr></tr>
            </thead>
            <tbody>
              <tr>
                <td>Airtel</td>
                <td>RA</td>
              </tr>
              <tr>
                <td>BSNL</td>
                <td>RB</td>
              </tr>
              <tr>
                <td>Bsnl Special</td>
                <td>BS</td>
              </tr>
              <tr>
                <td>Idea</td>
                <td>RI</td>
              </tr>
              <tr>
                <td>Vodafone</td>
                <td>RV</td>
              </tr>
              <tr>
                <td>RelianceJio</td>
                <td>RJ</td>
              </tr>
              <tr>
                <td>RelianceJio Special</td>
                <td>  RJ</td>
              </tr>
            </tbody>
          </table>
        </div>
     </section>
   <!--//=======How we work End=======//-->
   <section class="how_we_work mb-60">
        <div class="container">
          <div class="wa-heading-style1 mb-backs pad-s15 text-center">
            <h2><span class="wa-theme-color">DT</span>H</h2>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr></tr>
            </thead>
            <tbody>
              <tr>
                <td>Airtel DTH</td>
                <td>DA</td>
              </tr>
              <tr>
                <td>Dish Tv</td>
                <td>DT</td>
              </tr>
              <tr>
                <td>Sun Direct</td>
                <td>SDT</td>
              </tr>
              <tr>
                <td>Tata Sky</td>
                <td>TS</td>
              </tr>
              <tr>
                <td>Videocon D2H</td>
                <td>DV</td>
              </tr>
              <tr>
                <td>Reliance Big Tv</td>
                <td>DB</td>
              </tr>
              
            </tbody>
          </table>
        </div>
     </section> 
	  
	
	 

	 
     
	  
	   <!--//======= Partener sections Start=======//-->
     
      <!--//======= Partener sections End=======//-->  
      @endsection 