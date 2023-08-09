<!DOCTYPE html>
<html>
<head>
	
@include('front.includes.head')
</head>
<body>
		<!--//==Preloader Start==//-->
      <div class="preloader">
         <div class="cssload-container">
            <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
         </div>
      </div>
	<!--//==Preloader End==//-->
	@include('front.includes.header')
	@yield('content')

	@include('front.includes.footer')

</body>
	@include('front.includes.footerscript')
</html>