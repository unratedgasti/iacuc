<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>IACUC</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="{!! URL::to(asset('css/bootstrap.min.css')) !!}" rel="stylesheet">
	<link href="{!! URL::to(asset('css/bootstrap-responsive.min.css')) !!}" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
	rel="stylesheet">
	<link href="{!! URL::to(asset('css/font-awesome.css')) !!}" rel="stylesheet">
	<link href="{!! URL::to(asset('css/style.css')) !!}" rel="stylesheet">
	<link href="{!! URL::to(asset('css/pages/dashboard.css')) !!}" rel="stylesheet">
	<link href="{!! URL::to(asset('css/sweetalert2.css')) !!}" rel="stylesheet">
	<link href="{!! URL::to(asset('css/bootstrap-select.min.css')) !!}" rel="stylesheet">
	
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
	@include('layouts.navbar')
	
	@include('layouts.subnavbar')


	@section('content_body')
	@show

	@include('layouts.extra')

	@include('layouts.footer')

	@include('layouts.scripts')

	@section('content_scripts')
	@show


	

	
	
	
</body>
</html>
