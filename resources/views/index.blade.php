@extends('layout.master')

@push('head')
    <link rel="stylesheet" href="{{ mix('css/index.css') }}">
@endpush

@section('content')
    <div class="main-search_wrapper main-search_bg">
        <div class="main-search_con">
            <h1 class="Title">
                盯房網
            </h1>

            <div class="slogan">
                幫您比較各大訂房網站的房價，即時通知您最低的價格，讓您輕鬆找到理想的飯店
            </div>

            <vue_search_bar action="{{ route('list') }}"
                            :is-on-index="true"
                            :offset-x="-550"
                            :offset-y="20">
            </vue_search_bar>
        </div>
    </div>

    {{--<div class="pop-login_box">--}}
    {{--<div class="pop-login">--}}
    {{--<div class="Title">成為Dinroom.com會員</div>--}}
    {{--<div class="text">可以及時通知您飯店最新房價，讓您不錯過理想的飯店</div>--}}
    {{--<button class="login-btn">登入會員</button>--}}
    {{--<button class="close-btn"><img src="/images/close.svg" alt=""></button>--}}
    {{--</div>--}}
    {{--</div>--}}

    <div class="description_wrapper">
        <h3 class="Title">盯房網是？</h3>
        <div class="description-con">
            <div class="description">
                <div class="icon-img">
                    <img src="{{ asset('images/icons-01.svg') }}" alt="info-search">
                </div>
                <div class="slogan">
                    <div class="title">搜尋飯店</div>
                    <div class="text">蒐羅台、日、韓地區，各種特色及星級飯店，只要你想要都找的到。</div>
                </div>
            </div>
            <div class="description">
                <div class="icon-img">
                    <img src="{{ asset('images/icons-02.svg') }}" alt="info-notification">
                </div>
                <div class="slogan">
                    <div class="title">即時通知</div>
                    <div class="text">您可以追蹤理想飯店的房價，若價格低於平均價格，我們會即時的通知您，讓您不錯過最低房價。</div>
                </div>
            </div>
            <div class="description">
                <div class="icon-img">
                    <img src="{{ asset('images/icons-03.svg') }}" alt="info-history-price">
                </div>
                <div class="slogan">
                    <div class="title">歷史房價</div>
                    <div class="text">蒐集來自各平台的價格，我們會統計後呈現其每日價格浮動，讓您用最低的價格入住理想的飯店。</div>
                </div>
            </div>
        </div>
    </div>

    <div class="tag_wrapper">
        <h3 class="title">熱門城市、飯店搜索</h3>

        <div class="tag-con">
            <a class="tag" href="{{ route('list') }}?target=東京">東京住宿</a>
            <a class="tag" href="{{ route('list') }}?target=大阪">大阪住宿</a>
            <a class="tag" href="{{ route('list') }}?target=首爾">首爾住宿</a>
            <a class="tag" href="{{ route('list') }}?target=京都">京都住宿</a>
            <a class="tag" href="{{ route('list') }}?target=台北">台北住宿</a>
        </div>

        <div class="topDestination_wrapper">
            <h3 class="title">推薦地區</h3>
            <div class="destination-scroll">
                <ul class="destination-con">
                    <li class="item" style="background-image: url('{{ asset('images/area/kyoto.jpg') }}')">
                        <div class="area-wrap" onclick="location.href='{{ route('list') }}?target=京都'">
                            <a href="{{ route('list') }}?target=京都" class="MainTitle">
                                京都
                            </a>
                            <div class="SubTitle">日本</div>
                        </div>
                    </li>
                    <li class="item" style="background-image: url('{{ asset('images/area/osaka.jpg') }}')">
                        <div class="area-wrap" onclick="location.href='{{ route('list') }}?target=大阪'">
                            <a href="{{ route('list') }}?target=大阪" class="MainTitle">
                                大阪
                            </a>
                            <div class="SubTitle">日本</div>
                        </div>
                    </li>
                    <li class="item" style="background-image: url('{{ asset('images/area/seoul.jpg') }}')">
                        <div class="area-wrap" onclick="location.href='{{ route('list') }}?target=首爾'">
                            <a href="{{ route('list') }}?target=首爾" class="MainTitle">
                                首爾
                            </a>
                            <div class="SubTitle">韓國</div>
                        </div>
                    </li>
                    <li class="item" style="background-image: url('{{ asset('images/area/taipei.jpg') }}')">
                        <div class="area-wrap" onclick="location.href='{{ route('list') }}?target=台北'">
                            <a href="{{ route('list') }}?target=台北" class="MainTitle">
                                台北
                            </a>
                            <div class="SubTitle">台灣</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('app_js')
    <script src="{{ mix('js/app/index.js') }}"></script>
@endpush