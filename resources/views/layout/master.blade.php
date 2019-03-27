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

        <div class="min-top-fixed">
            <div class="top_header">
                <div class="icons">
                    <img src="{{ asset('images/arrow-left.svg') }}" alt="">
                </div>
                <div class="hotel-name">台北貴都大飯店 Taipei Crystal Hotel</div>
            </div>
            <div class="top_tags">
                <ul class="tags_wrapper">
                    <li class="tabs-item current"><span>概述</span></li>
                    <li class="tabs-item"><span>價格</span></li>
                    <li class="tabs-item"><span>位置</span></li>
                    <li class="tabs-item"><span>評論</span></li>
                    <li class="tabs-item"><span>設施與服務</span></li>
                </ul>
            </div>
        </div>

        <div class="bottom-nav-outer">
            <div class="bottom-nav_left">
                <div class="top">
                    <div class="title">最低價格</div>
                    <div class="text">比價<span>4</span>個網站</div>
                </div>
                <div class="bottom"><span>agoda.com</span></div>
            </div>
            <div class="bottom-nav_middle">
                <div class="price_currency">NT$</div>
                <div class="price_num">3,410</div>
            </div>
            <div class="bottom-nav_right"><a class="btn_gray" href="#">前往訂房</a></div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>