<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
		<title>Login - Sh4reMyP!c</title>
		<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
		<script src="{{url('design')}}/js/modernizr.custom.js"></script>
		<script type="text/javascript" src="{{url('design')}}/js/jquery.novacancy.js"></script>
		<link href='{{url('design')}}/css/loginstyle.css' rel='stylesheet'/>
		<script type="text/javascript">
		$(document).ready(function() {
			$('#link').novacancy({
				'blink': 1,
				'off': 1,
				'color': 'white',
				'glow': ['0 0 80px white', '0 0 30px white', '0 0 6px white']
			});
		});
		</script>
    </head>
	<body>
		<div class="container">
			<div class="maincenter">
				<div id="app"> 