<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
        <title>News - Sh4reMyP!c</title>
        @yield('css')
        <link href="{{url('design')}}/css/style.css" rel='stylesheet'/>
        <link href="{{url('design')}}/css/fonts.css" rel='stylesheet'/>
        <link href="{{url('design')}}/css/emo.css" rel="stylesheet"/>
        <link rel="stylesheet" href="{{url('design')}}/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script type='text/javascript' src="{{url('design')}}/js/scroll.js"></script>
        <script type='text/javascript' src="{{url('design')}}/js/css-pop.js"></script>
        @yield('js')
        <script>
        $(document).ready(function() {
            $('img.to-top').click(function (e) {
                e.preventDefault();
                scrollToElement('#scrollnothig');
            });
        });
        </script>
    </head>
    <body>
        <div id="app">
        <div id="blanket" style="display:none;" onclick="popup('popUpDiv');"></div>
        <div id="popUpDiv" style="display:none;">
        <img src='' id='popimg' />
        </div>