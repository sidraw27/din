<div class="__adjust_top"></div>
<div class="topbar-outer">
    <div class="topbar_logo">
        <a href="{{ route('index') }}">
            <img src="{{ asset('images/logo.svg') }}" alt="logo">
        </a>
    </div>

    <div class="topbar_nav">
        {{--<a class="nav-link" href="#">--}}
            {{--飯店清單--}}
        {{--</a>--}}
        @guest
            <div class="nav-link signin-btn" style="cursor: pointer">
                登入
            </div>
        @endguest

        @auth
            <a class="nav-link sign-in">
                <img src="{{ Auth::user()->avatar }}" alt="user">
                <span class="signin-name">
                    {{ Auth::user()->display_name }}
                </span>
            </a>
        @endauth
    </div>

    <div class="topbar_min-nav">
        <a class="nav-hamburger" href="#">
            <img src="{{ asset('images/hamburger.svg') }}" alt="">
        </a>
    </div>
</div>