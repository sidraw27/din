<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta http-equiv="content-language" content="zh-tw">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">

    @stack('head')

    @if (env('APP_ENV') === 'production')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-138969781-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-138969781-1');
        </script>
    @endif

    <style>
        [v-cloak] {
            display: none;
        }
        #nprogress .bar {
            background: rgba(124, 219, 47, 0.79) !important;
        }
        .stop-scrolling {
            height: 100%;
            overflow: hidden;
        }
        div#driver-page-overlay {
            background: #404555 !important;
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

    @guest
        <div class="LoginModal flex-outer">
            <div class="login-box">
                <div class="Title">歡迎加入盯房網</div>
                <div class="slogan">透過訂閱追蹤飯店，即時通知你更優惠的飯店價格</div>
                <a class="login-link facebook-btn" href="{{ route('auth.login', ['provider' => 'facebook']) }}">
                    <img src="{{ asset('images/facebook.svg') }}" alt="login-facebook">
                    <span>使用Facebook帳號登入</span>
                </a>
                <div class="separator">
                    <div class="separator_line"></div>
                    <div class="separator_text">或改為</div>
                </div>
                <a class="login-link border-btn active" href="#">
                    <span>使用其他方式登入</span>
                </a>
                <a class="login-link google-btn" href="{{ route('auth.login', ['provider' => 'google']) }}">
                    <img src="{{ asset('images/google.svg') }}" alt="login-google">
                    <span>使用Google帳號登入</span>
                </a>
                <div class="footer-text">我們不會將您的登入資訊用於任何商業用途，或公開於任何頁面上。</div>
                {{--<button class="close-btn">--}}
{{--                    <img src="{{ asset('images/close.svg') }}" alt="">--}}
                {{--</button>--}}
            </div>
        </div>
    @endguest

    <script src="{{ mix('js/app.js') }}"></script>
    @stack('app_js')
    <script src="{{ mix('js/action/master.js') }}"></script>
    @stack('action_js')
</body>
</html>
