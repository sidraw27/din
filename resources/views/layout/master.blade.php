<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <title>dinroom</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">

    @stack('head')

    <style>
        [v-cloak] {
            display: none;
        }
        #nprogress .bar {
            background: rgba(124, 219, 47, 0.79) !important;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('layout.header')

        @yield('content')

        @include('layout.footer')
    </div>

    @stack('modal')

    <script src="{{ mix('js/app.js') }}"></script>
    @stack('app_js')
    <script src="{{ mix('js/action/master.js') }}"></script>
    @stack('action_js')
</body>
</html>