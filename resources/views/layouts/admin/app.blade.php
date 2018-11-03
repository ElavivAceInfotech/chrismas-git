<!DOCTYPE html>
<!--<html lang="{{ config('app.locale') }}">-->
<html lang="en">
    <head>  
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		{{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="/favicon.ico">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		
		<link href="{{ URL::to('public/adminlte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ URL::to('public/quickadmin/css') }}/select2.min.css"/>
		<link href="{{ URL::to('public/adminlte/css/AdminLTE.min.css') }}" rel="stylesheet">
		<link href="{{ URL::to('public/adminlte/css/custom.css') }}" rel="stylesheet">
		<link href="{{ URL::to('public/adminlte/css/skins/skin-blue.min.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
		<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
		<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>
		<link href="{{ URL::to('public/adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"/>
		<link href="{{ URL::to('public/css/toastr.min.css') }}" rel="stylesheet">
		{{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    	{{-- Scripts --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body class="skin-blue sidebar-mini">
		<div class="wrapper" id="app">
		@include('partials.admin.header_nav')
		@include('partials.admin.sidebar')
			<div class="content-wrapper">
				@include('partials.admin.page_header')
				<section class="content">
					@yield('content')
				</section>
			</div>
		</div>
		{!! Form::open(['route' => 'logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
			<button type="submit">Logout</button>
		{!! Form::close() !!}
		@include('partials.footer')
    </body>
</html>