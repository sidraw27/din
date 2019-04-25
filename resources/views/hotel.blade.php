@extends('layout.main')

@push('head')
    <title>{{ $meta['title'] }}</title>

    <meta name="title" content="{{ $meta['title'] }}">
    <meta name="description" content="{{ $meta['description'] }}">

    <link rel="stylesheet" href="{{ mix('css/hotel.css') }}">
@endpush

@section('main_content')
    <div class="breadcrumb-outer">
        @if (Agent::isMobile())
            <div class="breadcrumb_search-more">
                <div class="icons">
                    <img src="{{ asset('images/arrow-left.svg') }}" alt="arrow-left-icon">
                </div>
                <div class="search-more">
                    <a href="{{ $listLink }}">
                        搜尋其他房源
                    </a>
                </div>
            </div>
        @else
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="breadcrumb-link" href="{{ route('index') }}">
                        首頁
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="breadcrumb-link" href="{{ $listLink }}">
                        {{ $hotelView['name']['origin'] }}
                    </a>
                </li>
            </ul>
        @endif
    </div>

    <div class="gl_outer1200">
        <div class="hotel_head">
            <div class="hotel_title">
                <div class="hotel_tit-info">
                    <h1 class="title">
                        {{ $hotelView['name']['translated'] }} ({{ $hotelView['name']['origin'] }})
                    </h1>

                    <div class="rating-wrap">
                        <vue_star_rated star-rated="{{ $hotelView['starRated'] }}"></vue_star_rated>
                    </div>
                </div>

                <vue_price_trace></vue_price_trace>
            </div>

            <div class="address-info __anchor_overview">
                <div class="address_big">
                    <div class="add-icon">
                        <img src="{{ asset('images/add.svg') }}" alt="">
                    </div>
                    <div class="address">
                        {{ $hotelView['countryName'] }}
                        {{ $hotelView['address'] ?? '地址未取得' }}
                    </div>
                    <a class="add-map" onclick="scrollToAnchor('position')">
                        查看地圖
                    </a>
                </div>
                <a class="icon-right" onclick="scrollToAnchor('position')">
                    <span>地圖</span>
                    <img src="{{ asset('images/arrow-right.svg') }}" alt="arrow">
                </a>
            </div>
        </div>

        <div class="hotel_NavBar">
            <div class="top_tags">
                <ul class="Navbar_wrapper">
                    <li class="tabs-item __item_overview" onclick="scrollToAnchor('overview', 200)">
                        <span>
                            概述
                        </span>
                    </li>
                    <li class="tabs-item __item_price" onclick="scrollToAnchor('price')">
                        <span>
                            價格
                        </span>
                    </li>
                    <li class="tabs-item __item_position" onclick="scrollToAnchor('position')">
                        <span>
                            位置
                        </span>
                    </li>
                    <li class="tabs-item __item_comment" onclick="scrollToAnchor('comment')">
                        <span>
                            評論
                        </span>
                    </li>
                    <li class="tabs-item __item_info" onclick="scrollToAnchor('info')">
                        <span>
                            詳細資訊
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="hotel_intro">
            <vue_history_price></vue_history_price>

            <div class="intro_reviews inrto_min">
                <div class="reviews-wrap">
                    <div class="reviews_num">
                        <div class="Number-rating">
                            {{ $hotelView['rating']['statistics']['avg'] }}
                        </div>
                        <div class="total-rating">/10</div>
                    </div>
                    <div class="reviews_text">
                        {{ $hotelView['rating']['statistics']['promotion'] }}
                    </div>
                </div>
                <a class="icon-right" onclick="scrollToAnchor('comment')">
                    {{--<div class="reviewMore">--}}
                        {{--(共有<span>52</span>則評論)--}}
                    {{--</div>--}}
                    <img src="{{ asset('images/arrow-right.svg') }}" alt="arrow">
                </a>
            </div>
            <div class="intro_gallery inrto_min">
                @empty($hotelView['photos'])
                    <img src="{{ asset('images/noimg.svg') }}" alt="no-img" style="height: 100%;width: 100%">
                @else
                    <vue_carousel img-url="{{ json_encode($hotelView['photos']) }}"></vue_carousel>
                @endempty
            </div>
        </div>
    </div>

    <div class="gl_outer1200 gl_flex-row">
        <div class="hl_main-content">

            <vue_real_time_price hotel-url-id="{{ $hotelView['urlId'] }}"
                                 check-in="{{ $searchData['checkIn'] }}"
                                 check-out="{{ $searchData['checkOut'] }}"
                                 adult="{{ $searchData['adult'] }}">
            </vue_real_time_price>

            <div class="hl_map-wrapper __anchor_position">
                <div class="map_tit">
                    <h2 class="title">位置</h2>
                </div>
                <div class="map_box">
                    @if ( ! empty($hotelView['geo']))
                        <vue_map longitude="{{ $hotelView['geo']['lng'] }}" latitude="{{ $hotelView['geo']['lat'] }}"></vue_map>
                    @endif
                    <div class="map-distance">
                        <div class="distance_scroll">
                            @foreach($nearHotels as $nearHotel)
                                <div class="item-con">
                                <div class="item">
                                    <span class="name">
                                        <a href="{{ $nearHotel['link'] }}" target="_blank">
                                            {{ $nearHotel['name'] }}
                                        </a>
                                    </span>
                                    <span class="distance">
                                        {{ $nearHotel['distance'] }}
                                    </span>
                                </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="hl_review-wrapper __anchor_comment">
                <div class="review_tit">
                    <h2 class="title">評論</h2>
                </div>
                <div class="review_score-box">
                    <div class="score-box_total">
                        <div class="total-score">
                            <div class="score-number">
                                {{ $hotelView['rating']['statistics']['avg'] }}
                            </div>
                            <div class="score-ten">/10</div>
                        </div>
                        <div class="total-text">
                            {{ $hotelView['rating']['statistics']['promotion'] }}
                        </div>
                        {{--<div class="review-basedon">--}}
                            {{--(共有<span>52</span>則評論)--}}
                        {{--</div>--}}
                    </div>
                    <div class="score-box_intro">
                        @isset($hotelView['rating']['detail']['agoda'])
                            @foreach($hotelView['rating']['detail']['agoda'] as $rating)
                                <div class="review-standard_item">
                                    <div class="review-grade_wrap">
                                        <div class="category">
                                            {{ $rating['description'] }}
                                        </div>
                                        <div class="score">
                                            {{ round($rating['score'] / 10, 1) }}
                                        </div>
                                    </div>
                                    <div class="review-grade_progressBar">
                                        <div class="percent" style="width: {{ $rating['score'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
                <div class="review_resource">
                    <div class="resource_text">資料來源</div>
                    <div class="resource_wrap">
                        <div class="recource">
                            <img src="{{ asset('images/agoda-logo.svg') }}" alt="agoda">
                            <div class="detail"><span>數</span>則評論</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hl_information-wrapper __anchor_info">
                <div class="info_description info-box">
                    <h2 class="title">飯店介紹</h2>
                    <div class="description_wrap wrap-con">
                        <p class="hotel-desc">
                            {{ $hotelView['introduction'] }}
                        </p>
                    </div>
                    {{--<div class="btn-wrap">--}}
                        {{--<button class="more-btn">查看全部介紹</button>--}}
                    {{--</div>--}}
                </div>

                <div class="info_policy info-box">
                    <h2 class="title">飯店政策</h2>
                    <div class="policy_wrap wrap-con">
                        <div class="policy-type">
                            <img src="{{ asset('images/facility/room-icons-18.svg') }}" alt="room-info">
                        </div>
                        <div class="policy-item">
                            <div class="item-tit">入住時間＆退房時間</div>
                            <ul class="item-check">
                                <li>
                                    <div class="check-tit">入住時間</div>
                                    <div class="check-time">
                                        {{ $hotelView['info']['checkinTime'] ?? '未提供' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="check-tit">退房時間</div>
                                    <div class="check-time">
                                        {{ $hotelView['info']['checkoutTime'] ?? '未提供' }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="policy_wrap wrap-con">
                        <div class="policy-type">
                            <img src="{{ asset('images/facility/room-icons-19.svg') }}" alt="hotel-info">
                        </div>
                        <div class="policy-item">
                            <div class="item-tit">資訊概況</div>
                            <ul class="useful-info">
                                <li>
                                    <div class="info-tit">樓層高度:</div>
                                    <div class="info-text">
                                        {{ $hotelView['info']['floorTotal'] ?? '未知' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="info-tit">客房總數:</div>
                                    <div class="info-text">
                                        {{ $hotelView['info']['roomTotal'] ?? '未知' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="info-tit">開幕年份:</div>
                                    <div class="info-text">
                                        {{ $hotelView['info']['openYear'] ?? '未知' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="info-tit">近期裝修年份:</div>
                                    <div class="info-text">
                                        {{ $hotelView['info']['renovatedYear'] ?? '未知' }}
                                    </div>
                                </li>
                            </ul>
                            {{--<div class="btn-wrap">--}}
                            {{--<button class="more-btn">查看全部概況</button>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>

                <div class="info_facility info-box">
                    <h2 class="title">服務設施</h2>
                    <div class="facility_wrap wrap-con">
                        @foreach($hotelView['supportFacilities'] as $group => $facilities)
                            <div class="facility-list">
                                <div class="list-text">
                                    {{ $group }}
                                </div>
                                <ul class="list-con">
                                    @foreach($facilities as $facility)
                                        <li class="facility-item">
                                            @if (isset($facility['icon']))
                                                <img src="{{ asset("images/facility/room-icons-{$facility['icon']}.svg") }}" alt="icon">
                                            @else
                                                <img src="{{ asset('images/facility/room-icons-21.svg') }}" alt="icon">
                                            @endif
                                            <div class="name">
                                                {{ $facility['name'] }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @if ( ! empty($relatedHotels))
                <div class="hl_recommend-wrapper">
                    <div class="recommend_tit">
                        <h2 class="title">
                            附近的飯店
                        </h2>
                    </div>
                    <div class="recommend_scroll">
                        <ul class="recommed-list">
                            @foreach($relatedHotels as $relatedHotel)
                                <li class="recommed-item">
                                    <div class="item-img">
                                        <div class="image"
                                             style="background-image: url('{{ $relatedHotel['photo'] ?? 'images/noimg.svg' }}')">
                                        </div>
                                    </div>
                                    <div class="item-info">
                                        <a class="info-tit" href="{{ $relatedHotel['link'] }}">
                                            {{ $relatedHotel['name']['translated'] }}({{ $relatedHotel['name']['origin'] }})
                                        </a>

                                        <vue_star_rated star-rated="{{ $relatedHotel['starRated'] }}"></vue_star_rated>

                                        <div class="info-price">
                                            最低價
                                            <div class="currency">NT$</div>
                                            <div class="price">-</div>
                                        </div>
                                    </div>

                                    <div class="item-review">
                                        {{ $relatedHotel['rating']['statistics']['avg'] }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        <div class="hl_sidebar">
            @if (Agent::isDesktop())
                <vue_ad_sidebar></vue_ad_sidebar>
            @endif
        </div>
    </div>
@endsection

@push('modal')
    <!-- 點了.follow-btn ，幫我加上class: .is-open-->
    {{--<div class="followModal flex-outer">--}}
        {{--<div class="follow-box">--}}
            {{--<div class="Title">價格追蹤</div>--}}
            {{--<div class="slogan">台北貴都大飯店 Taipei Crystal Hotel</div>--}}
            {{--<div class="follow-con">--}}
                {{--<div class="follow-wrap">--}}
                    {{--<div class="title">何時入住</div>--}}
                    {{--<div class="date-wrap">--}}
                        {{--<div class="check-in">--}}
                            {{--<div class="picker_label">入住時間</div>--}}
                            {{--<div class="picker_date">4月10日</div>--}}
                        {{--</div>--}}
                        {{--<div class="right-icon"><img src="/images/cc-arrow-left.svg" alt=""></div>--}}
                        {{--<div class="check-out">--}}
                            {{--<div class="picker_label">退房時間</div>--}}
                            {{--<div class="picker_date">4月14日</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="follow-wrap">--}}
                    {{--<div class="title">入住人數</div>--}}
                    {{--<div class="occupancy-wrap">--}}
                        {{--<select>--}}
                            {{--<option value="1人">1 人</option>--}}
                            {{--<option value="2人">2 人</option>--}}
                            {{--<option value="3人">3 人</option>--}}
                            {{--<option value="4人">4 人</option>--}}
                            {{--<option value="5人">5 人</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<button class="sendOut-btn">立即追蹤</button>--}}
            {{--<button class="close-btn"><img src="/images/close.svg" alt=""></button>--}}
        {{--</div>--}}
    {{--</div>--}}
@endpush

@push('app_js')
    <script src="{{ mix('js/app/hotel.js') }}"></script>
@endpush

@push('action_js')
    <script src="{{ mix('js/action/hotel.js') }}"></script>
@endpush