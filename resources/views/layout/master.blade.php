<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <title>dinroom</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/hotel.css') }}">
</head>

<body>
    <div id="app">
        <div class="__adjust_top"></div>
        <div class="topbar-outer">
            <div class="topbar_logo">
                <a href="{{ route('index') }}">盯房網</a>
            </div>

            <div class="topbar_nav">
                <a class="nav-link" href="#">飯店清單</a>
                <a class="nav-link signin-btn" href="#">登入</a>
                <a class="nav-link sign-in" href="#">
                    <img src="{{ asset('images/user.jpg') }}" alt="">
                    <span class="signin-name">MAO CATHY</span>
                </a>
            </div>

            <div class="topbar_min-nav">
                <a class="search-btn" href="#">
                    <img src="{{ asset('images/search.svg') }}" alt="">
                </a>
                <a class="nav-hamburger" href="#">
                    <img src="{{ asset('images/hamburger.svg') }}" alt="">
                </a>
            </div>
        </div>

        <vue_search_bar></vue_search_bar>

        @yield('content')

        <div class="footer_wrapper">
            <div class="footer">
                <div class="footer_link"><a href="#">首頁</a><a href="#">服務條款</a><a href="#">隱私政策</a></div>
                <div class="footer_copyright"><span>Copyright © 2019  dinroom.tw</span></div>
            </div>
        </div>
    </div>

    @stack('modal')

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/action/master.js') }}"></script>
    @stack('javascript')
</body>
</html>