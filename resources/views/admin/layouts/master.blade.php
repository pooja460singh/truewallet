<!DOCTYPE html>
<html>
<head>
	
@include('admin.includes.head')
</head>
<body>
	@include('admin.includes.header')
	@include('admin.includes.sidebar')
	@yield('content')

	@include('admin.includes.footer')

</body>
	@include('admin.includes.footerscript')
</html>