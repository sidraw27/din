@extends('layout.master')

@push('head')
    <link rel="stylesheet" href="{{ mix('css/hotel.css') }}">
@endpush

@section('content')
    <div class="breadcrumb-outer">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="breadcrumb-link" href="#">
                    首頁
                </a>
            </li>
            <li class="breadcrumb-item">
                <a class="breadcrumb-link" href="#">
                    {{ $hotelView['countryName'] }}
                </a>
            </li>
            {{--<li class="breadcrumb-item">--}}
                {{--<a class="breadcrumb-link" href="#">--}}
                    {{--{{ $hotelView['cityName'] }}--}}
                {{--</a>--}}
            {{--</li>--}}
            <li class="breadcrumb-item">
                <span>{{ $hotelView['name']['origin'] }} ({{ $hotelView['name']['translated'] }})</span>
            </li>
        </ul>

        <div class="breadcrumb_search-more">
            <div class="icons">
                <img src="{{ asset('images/arrow-left.svg') }}" alt="arrow-left-icon">
            </div>
            <div class="search-more">
                查看更多
                <span>{{ $hotelView['countryName'] }}</span>
                的飯店
            </div>
        </div>
    </div>

    <div class="gl_outer1200">
        <div class="hotel_head">
            <div class="hotel_title">
                <div class="hotel_tit-info">
                    <h1 class="title">
                        {{ $hotelView['name']['origin'] }} ({{ $hotelView['name']['translated'] }})
                    </h1>

                    <div class="rating-wrap">
                        @for($i = 0; $i <= $hotelView['starRated']; $i++)
                            <span class="star">
                                <img src="{{ asset('images/star.svg') }}" alt="star-rated">
                            </span>
                        @endfor
                    </div>
                </div>

                <div class="hotel_follow-btn">
                    <button class="follow-btn">
                        <img src="{{ asset('images/track-border.svg') }}" alt="">
                        <span>價格追蹤</span>
                    </button>
                </div>
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
                <a class="icon-right" href="#">
                    <span>地圖</span>
                    <img src="{{ asset('images/arrow-right.svg') }}" alt="">
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
                        <div class="Number-rating">7.9</div>
                        <div class="total-rating">/10</div>
                    </div>
                    <div class="reviews_text">很讚</div>
                </div>
                <a class="icon-right" href="#">
                    <div class="reviewMore">
                        (共有<span>52</span>則評論)
                    </div>
                    <img src="{{ asset('images/arrow-right.svg') }}" alt="">
                </a>
            </div>
            <div class="intro_gallery inrto_min">
                @empty($hotelView['photos'])
                    目前沒有提供照片
                @else
                    <vue_carousel img-url="{{ json_encode($hotelView['photos']) }}"></vue_carousel>
                @endempty

            </div>
        </div>
    </div>

    <div class="gl_outer1200 gl_flex-row">
        <div class="hl_main-content">

            <vue_real_time_price hotel-url-id="{{ $hotelView['urlId'] }}"></vue_real_time_price>

            <div class="hl_map-wrapper __anchor_position">
                <div class="map_tit">
                    <h3 class="title">位置</h3>
                </div>
                <div class="map_box">
                    @if ( ! empty($hotelView['geo']))
                        <vue_map longitude="{{ $hotelView['geo']['lng'] }}" latitude="{{ $hotelView['geo']['lat'] }}"></vue_map>
                    @endif
                    <div class="map-distance">
                        <div class="distance_scroll">
                            <div class="item-con">
                                <div class="item">
                                    <span class="name">附近機場</span>
                                    <span class="distance">6.23 公里</span>
                                </div>
                            </div>
                            <div class="item-con">
                                <div class="item">
                                    <span class="name">捷運巨蛋站</span>
                                    <span class="distance">160 公尺</span>
                                </div>
                                <div class="item">
                                    <span class="name">捷運凹子底站</span>
                                    <span class="distance">990 公尺</span>
                                </div>
                            </div>
                            <div class="item-con">
                                <div class="item">
                                    <span class="name">高雄市立聯合醫院</span>
                                    <span class="distance">1.8 公里</span>
                                </div>
                            </div>
                            <div class="item-con">
                                <div class="item">
                                    <span class="name">夢時代購物中心</span>
                                    <span class="distance">6.9 公里</span>
                                </div>
                            </div>
                            <div class="item-con">
                                <div class="item">
                                    <span class="name">捷運巨蛋站</span>
                                    <span class="distance">160 公尺</span>
                                </div>
                                <div class="item">
                                    <span class="name">捷運凹子底站</span>
                                    <span class="distance">990 公尺</span>
                                </div>
                            </div>
                            <div class="item-con">
                                <div class="item">
                                    <span class="name">高雄市立聯合醫院</span>
                                    <span class="distance">1.8 公里</span>
                                </div>
                            </div>
                            <div class="item-con">
                                <div class="item">
                                    <span class="name">夢時代購物中心</span>
                                    <span class="distance">6.9 公里</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hl_review-wrapper __anchor_comment">
                <div class="review_tit">
                    <h3 class="title">評論</h3>
                </div>
                <div class="review_score-box">
                    <div class="score-box_total">
                        <div class="total-score">
                            <div class="score-number">
                                @isset($hotelView['rating']['statistics'])
                                    {{ $hotelView['rating']['statistics']['avg'] }}
                                @else
                                    0
                                @endisset
                            </div>
                            <div class="score-ten">/10</div>
                        </div>
                        <div class="total-text">很讚</div>
                        <div class="review-basedon">(共有<span>52</span>則評論)</div>
                    </div>
                    <div class="score-box_intro">
                        @isset($hotelView['rating']['detail'])
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
                            <img src="{{ asset('images/booking-logo.svg') }}" alt="">
                            <div class="detail"><span>73</span>則評論</div>
                        </div>
                        <div class="recource">
                            <img src="{{ asset('images/agoda-logo.svg') }}" alt="">
                            <div class="detail"><span>73</span>則評論</div>
                        </div>
                        <div class="recource">
                            <img src="{{ asset('images/hotels-logo.svg') }}" alt="">
                            <div class="detail"><span>73</span>則評論</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hl_information-wrapper __anchor_info">
                <div class="info_description info-box">
                    <h3 class="title">飯店介紹</h3>
                    <div class="description_wrap wrap-con">
                        <p class="hotel-desc">
                            {{ $hotelView['introduction'] }}
                        </p>
                    </div>
                    <div class="btn-wrap">
                        <button class="more-btn">查看全部介紹</button>
                    </div>
                </div>
                <div class="info_facility info-box">
                    <h3 class="title">服務設施</h3>
                    <div class="facility_wrap wrap-con">
                        @foreach($hotelView['supportFacilities'] as $group => $facilities)
                            <div class="facility-list">
                                <div class="list-text">
                                    {{ $group }}
                                </div>
                                <ul class="list-con">
                                    @foreach($facilities as $facility)
                                        <li class="facility-item">
                                            <img src="{{ asset('images/facility/room-icons-08.svg') }}" alt="icon">
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
                <div class="info_policy info-box">
                    <h3 class="title">飯店政策</h3>
                    <div class="policy_wrap wrap-con">
                        <div class="policy-type">
                            <img src="{{ asset('images/facility/room-icons-18.svg') }}" alt="">
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
                            <img src="{{ asset('images/facility/room-icons-19.svg') }}" alt="">
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
                            <div class="btn-wrap">
                                <button class="more-btn">查看全部概況</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hl_recommend-wrapper">
                <div class="recommend_tit">
                    <h3 class="title">您可能也會喜歡</h3>
                </div>
                <div class="recommend_scroll">
                    <ul class="recommed-list">
                        <li class="recommed-item">
                            <div class="item-img">
                                <div class="image"
                                     style="background-image: url('https://a0.muscache.com/im/pictures/47985619/11203a2d_original.jpg?aki_policy=xx_large')"></div>
                            </div>
                            <div class="item-info">
                                <a class="info-tit" href="#">紐約千禧希爾頓酒店(The Millennium Hilton New York)</a>
                                <div class="info-rating">
                                <span class="star">
                                    <img src="/images/star.svg" alt="">
                                </span>
                                    <span class="star">
                                    <img src="/images/star.svg" alt="">
                                </span>
                                    <span class="star">
                                    <img src="/images/star.svg" alt="">
                                </span>
                                    <span class="star">
                                    <img src="/images/star.svg" alt="">
                                </span>
                                </div>
                                <div class="info-price">最低價
                                    <div class="currency">NT$</div>
                                    <div class="price">2,345</div>
                                </div>
                            </div>
                            <div class="item-review">8.3</div>
                        </li>
                        <li class="recommed-item">
                            <div class="item-img">
                                <div class="image"
                                     style="background-image: url('https://a0.muscache.com/im/pictures/47985619/11203a2d_original.jpg?aki_policy=xx_large')"></div>
                            </div>
                            <div class="item-info"><a class="info-tit" href="#">紐約千禧希爾頓酒店(The Millennium Hilton New
                                    York)</a>
                                <div class="info-rating"><span class="star"><img src="/images/star.svg"
                                                                                 alt=""></span><span
                                            class="star"><img src="/images/star.svg" alt=""></span><span
                                            class="star"><img
                                                src="/images/star.svg" alt=""></span><span class="star"><img
                                                src="/images/star.svg" alt=""></span></div>
                                <div class="info-price">最低價
                                    <div class="currency">NT$</div>
                                    <div class="price">2,345</div>
                                </div>
                            </div>
                            <div class="item-review">8.3</div>
                        </li>
                        <li class="recommed-item">
                            <div class="item-img">
                                <div class="image"
                                     style="background-image: url('https://a0.muscache.com/im/pictures/47985619/11203a2d_original.jpg?aki_policy=xx_large')"></div>
                            </div>
                            <div class="item-info"><a class="info-tit" href="#">紐約千禧希爾頓酒店(The Millennium Hilton New
                                    York)</a>
                                <div class="info-rating"><span class="star"><img src="/images/star.svg"
                                                                                 alt=""></span><span
                                            class="star"><img src="/images/star.svg" alt=""></span><span
                                            class="star"><img
                                                src="/images/star.svg" alt=""></span><span class="star"><img
                                                src="/images/star.svg" alt=""></span></div>
                                <div class="info-price">最低價
                                    <div class="currency">NT$</div>
                                    <div class="price">2,345</div>
                                </div>
                            </div>
                            <div class="item-review">8.3</div>
                        </li>
                        <li class="recommed-item">
                            <div class="item-img">
                                <div class="image"
                                     style="background-image: url('https://a0.muscache.com/im/pictures/47985619/11203a2d_original.jpg?aki_policy=xx_large')"></div>
                            </div>
                            <div class="item-info">
                                <a class="info-tit" href="#">
                                    紐約千禧希爾頓酒店(The Millennium Hilton New York)
                                </a>
                                <div class="info-rating">
                                    <span class="star">
                                        <img src="/images/star.svg" alt="">
                                    </span>
                                    <span class="star">
                                        <img src="/images/star.svg" alt="">
                                    </span>
                                    <span class="star">
                                        <img src="/images/star.svg" alt="">
                                    </span>
                                    <span class="star">
                                        <img src="/images/star.svg" alt="">
                                    </span>
                                </div>
                                <div class="info-price">最低價
                                    <div class="currency">NT$</div>
                                    <div class="price">2,345</div>
                                </div>
                            </div>
                            <div class="item-review">8.3</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="hl_sidebar"></div>
    </div>
@endsection

@push('modal')
    <!-- 點了.follow-btn ，幫我加上class: .is-open-->
    <div class="followModal flex-outer">
        <div class="follow-box">
            <div class="Title">價格追蹤</div>
            <div class="slogan">台北貴都大飯店 Taipei Crystal Hotel</div>
            <div class="follow-con">
                <div class="follow-wrap">
                    <div class="title">何時入住</div>
                    <div class="date-wrap">
                        <div class="check-in">
                            <div class="picker_label">入住時間</div>
                            <div class="picker_date">4月10日</div>
                        </div>
                        <div class="right-icon"><img src="/images/cc-arrow-left.svg" alt=""></div>
                        <div class="check-out">
                            <div class="picker_label">退房時間</div>
                            <div class="picker_date">4月14日</div>
                        </div>
                    </div>
                </div>
                <div class="follow-wrap">
                    <div class="title">入住人數</div>
                    <div class="occupancy-wrap">
                        <select>
                            <option value="1人">1 人</option>
                            <option value="2人">2 人</option>
                            <option value="3人">3 人</option>
                            <option value="4人">4 人</option>
                            <option value="5人">5 人</option>
                        </select>
                    </div>
                </div>
            </div>
            <button class="sendOut-btn">立即追蹤</button>
            <button class="close-btn"><img src="/images/close.svg" alt=""></button>
        </div>
    </div>
@endpush

@push('javascript')
    <script src="{{ mix('js/action/hotel.js') }}"></script>
@endpush