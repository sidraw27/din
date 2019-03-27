@extends('layout.master')

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
            <li class="breadcrumb-item">
                <a class="breadcrumb-link" href="#">
                    {{ $hotelView['cityName'] }}
                </a>
            </li>
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
                        <span class="star">
                            <img src="{{ asset('images/star.svg') }}" alt="">
                        </span>
                            <span class="star">
                            <img src="{{ asset('images/star.svg') }}" alt="">
                        </span>
                            <span class="star">
                            <img src="{{ asset('images/star.svg') }}" alt="">
                        </span><span class="star">
                            <img src="{{ asset('images/star.svg') }}" alt="">
                        </span>
                    </div>
                </div>

                <div class="hotel_follow-btn">
                    <button class="follow-btn">
                        <img src="{{ asset('images/follow.svg') }}" alt="">
                        <span>價格追蹤</span>
                    </button>
                </div>
            </div>

            <div class="address-info">
                <div class="address_big">
                    <div class="add-icon">
                        <img src="{{ asset('images/add.svg') }}" alt="">
                    </div>
                    <div class="address">
                        {{ $hotelView['countryName'] }} {{ $hotelView['cityName'] }}
                        {{ $hotelView['address'] ?? '地址未取得' }}
                    </div>
                    <a class="add-map" href="#">
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
            <ul class="Navbar_wrapper">
                <li class="tabs-item current">
                    <span>概述</span>
                </li>
                <li class="tabs-item">
                    <span>價格</span>
                </li>
                <li class="tabs-item">
                    <span>位置</span>
                </li>
                <li class="tabs-item">
                    <span>評論</span>
                </li>
                <li class="tabs-item">
                    <span>設施與服務</span>
                </li>
            </ul>
        </div>
        <div class="hotel_intro">
            <div class="intro_chart inrto_min">
                <div class="chart_tit">
                    <h3 class="title">歷史價格</h3><span>(以每晚價格統計)</span>
                </div>
            </div>
            <div class="intro_reviews inrto_min">
                <div class="reviews-wrap">
                    <div class="reviews_num">
                        <div class="Number-rating">7.9</div>
                        <div class="total-rating">/10</div>
                    </div>
                    <div class="reviews_text">很讚</div>
                </div>
                <a class="icon-right" href="#">
                    <div class="reviewMore">(共有<span>52</span>則評論)</div>
                    <img src="{{ asset('images/arrow-right.svg') }}" alt=""></a>
            </div>
            <div class="intro_gallery inrto_min">
                <img style="height: 100%;width: 100%"
                     src="http://pix2.agoda.net/hotelimages/agoda-homes/6584501/fa5afcc98691249611041402b4c32665.jpg?s=700x">
            </div>
        </div>
    </div>
    <div class="gl_outer1200 gl_flex-row">
        <div class="hl_main-content">
            <div class="hl_rate-wrapper">
                <div class="hl_detail-filter">
                    <div class="filter_box">
                        <div class="filter_date filter-bg">
                            <div class="filter-icon">
                                <img src="{{ asset('images/date.svg') }}" alt="">
                            </div>
                            <div class="picker-label">3月10日,週日</div>
                            <span>～</span>
                            <div class="picker-label">3月15日,週五</div>
                        </div>
                        <div class="filter_room filter-bg">
                            <div class="picker-label">一間客房</div>
                            <div class="arrow-icon">
                                <img src="{{ asset('images/arrow-down.svg') }}" alt="">
                            </div>
                        </div>
                        <div class="filter_child filter-bg">
                            <div class="filter-icon">
                                <img src="{{ asset('images/people.svg') }}" alt="">
                            </div>
                            <div class="picker-label">
                                <span class="room-info">2 成人</span>
                                <span>，</span>
                                <span class="room-info">0 兒童</span>
                            </div>
                            <div class="arrow-icon">
                                <img src="{{ asset('images/arrow-down.svg') }}" alt="">
                            </div>
                        </div>
                        <button class="filter_button">更新</button>
                    </div>
                    <ul class="filter_tags">
                        <li class="tags active">免費早餐</li>
                        <li class="tags">到店付款</li>
                        <li class="tags">免費取消</li>
                    </ul>
                </div>
                <div class="hl_min-detail-filter">
                    <div class="min_filter-box">
                        <div class="filter-date">
                            <div class="check-in min-text">
                                <div class="picker_label">入住日期</div>
                                <div class="picker_date">3月13日</div>
                            </div>
                            <div class="right-icon">
                                <img src="{{ asset('images/cc-arrow-left.svg') }}" alt="">
                            </div>
                            <div class="check-out min-text">
                                <div class="picker_label">退房日期</div>
                                <div class="picker_date">3月15日</div>
                            </div>
                        </div>
                        <div class="filter-child min-text">
                            <div class="picker_label">人</div>
                            <div class="picker_date">2</div>
                        </div>
                        <div class="filter-room min-text">
                            <div class="picker_label">客房</div>
                            <div class="picker_date">1</div>
                        </div>
                    </div>
                    <div class="min_filter-tags">
                        <ul class="filter-tags_wrapper">
                            <li class="tags active">免費早餐</li>
                            <li class="tags">到店付款</li>
                            <li class="tags">免費取消</li>
                            <li class="tags">到店付款</li>
                            <li class="tags">到店付款</li>
                        </ul>
                    </div>
                </div>
                <div class="hl_rate-list">
                    <div class="list_tit">
                        <h3 class="title">來自所有網站的價格</h3>
                        <div class="price-wrap">平均價格
                            <div class="price">NT$7,345</div>
                            <span>～</span>
                            <div class="price">NT$8,136</div>
                        </div>
                        <div class="text">(共<span>5</span>筆)</div>
                    </div>
                    <div class="list_room-detail">
                        <div class="text"><span>5</span>晚，</div>
                        <div class="text"><span>2</span>位房客，</div>
                        <div class="text"><span>1</span>間客房的總價</div>
                    </div>
                    <ul class="list_wrapper">
                        <li class="list-item">
                            <div class="item-wrap">
                                <div class="provider_logo">
                                    <img src="{{ asset('images/agoda-logo.svg') }}" alt="">
                                </div>
                                <div class="provider_info">
                                    <div class="room-con">標準雙人房 - 無窗 (Standard Double Room No Window)</div>
                                    <div class="room-attributes">
                                        <div class="text">不包括早餐</div>
                                        <div class="text green">免費取消</div>
                                        <div class="text blue">到店付款</div>
                                    </div>
                                </div>
                                <div class="provider_price">
                                    <div class="price">NT$<span>3,415</span></div>
                                    <div class="hotel-name">agoda.com</div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="check-btn">前往網站</div>
                                <div class="icons">
                                    <img src="{{ asset('images/arrow-right.svg') }}" alt="">
                                </div>
                            </a>
                        </li>
                        <li class="list-item">
                            <div class="item-wrap">
                                <div class="provider_logo">
                                    <img src="{{ asset('images/trip-logo.svg') }}" alt="">
                                </div>
                                <div class="provider_info">
                                    <div class="room-con">標準雙人房 - 無窗</div>
                                    <div class="room-attributes">
                                        <div class="text">不包括早餐</div>
                                        <div class="text blue">到店付款</div>
                                    </div>
                                </div>
                                <div class="provider_price">
                                    <div class="price">NT$<span>3,415</span></div>
                                    <div class="hotel-name">trip.com</div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="check-btn">前往網站</div>
                                <div class="icons">
                                    <img src="{{ asset('images/arrow-right.svg') }}" alt="">
                                </div>
                            </a>
                        </li>
                        <li class="list-item">
                            <div class="item-wrap">
                                <div class="provider_logo">
                                    <img src="{{ asset('images/hotels-logo.svg') }}" alt="">
                                </div>
                                <div class="provider_info">
                                    <div class="room-con">Standard Double Room</div>
                                    <div class="room-attributes">
                                        <div class="text">不包括早餐</div>
                                        <div class="text green">免費取消</div>
                                    </div>
                                </div>
                                <div class="provider_price">
                                    <div class="price">NT$<span>3,415</span></div>
                                    <div class="hotel-name">hotels.com</div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="check-btn">前往網站</div>
                                <div class="icons">
                                    <img src="{{ asset('images/arrow-right.svg') }}" alt="">
                                </div>
                            </a>
                        </li>
                        <li class="list-item">
                            <div class="item-wrap">
                                <div class="provider_logo">
                                    <img src="{{ asset('images/booking-logo.svg') }}" alt="">
                                </div>
                                <div class="provider_info">
                                    <div class="room-con">小型雙人房 (Small Double Room)</div>
                                    <div class="room-attributes">
                                        <div class="text">不包括早餐</div>
                                    </div>
                                </div>
                                <div class="provider_price">
                                    <div class="price">NT$<span>3,415</span></div>
                                    <div class="hotel-name">booking.com</div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="check-btn">前往網站</div>
                                <div class="icons">
                                    <img src="{{ asset('images/arrow-right.svg') }}" alt="">
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="rate-ps">平均每晚的價格是由我們的合作夥伴提供，且可能不含任何稅金和服務費。 顯示的稅金及費用皆僅為約略金額。 如需更多詳細資料，請參閱我們合作夥伴的網站。</div>
                </div>
            </div>
            <div class="hl_map-wrapper">
                <div class="map_tit">
                    <h3 class="title">位置</h3>
                </div>
                <div class="map_box">
                    <div class="map-localtion">
                        {{--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14460.468282249692!2d121.5028641!3d25.0301008!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x978d80a93c0fb030!2z6LK06YO95aSn6aOv5bqX!5e0!3m2!1szh-TW!2stw!4v1552551355958"--}}
                                {{--width="580" height="350" frameborder="0" style="border:0" allowfullscreen="">--}}
                        {{--</iframe>--}}
                    </div>
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
            <div class="hl_review-wrapper">
                <div class="review_tit">
                    <h3 class="title">評論</h3>
                </div>
                <div class="review_score-box">
                    <div class="score-box_total">
                        <div class="total-score">
                            <div class="score-number">7.9</div>
                            <div class="score-ten">/10</div>
                        </div>
                        <div class="total-text">很讚</div>
                        <div class="review-basedon">(共有<span>52</span>則評論)</div>
                    </div>
                    <div class="score-box_intro">
                        <div class="review-standard_item">
                            <div class="review-grade_wrap">
                                <div class="category">整體狀況及整潔度</div>
                                <div class="score">7.2</div>
                            </div>
                            <div class="review-grade_progressBar">
                                <div class="percent" style="width: 72%"></div>
                            </div>
                        </div>
                        <div class="review-standard_item">
                            <div class="review-grade_wrap">
                                <div class="category">設施與設備</div>
                                <div class="score">8.1</div>
                            </div>
                            <div class="review-grade_progressBar">
                                <div class="percent" style="width: 81%"></div>
                            </div>
                        </div>
                        <div class="review-standard_item">
                            <div class="review-grade_wrap">
                                <div class="category">客房舒適度</div>
                                <div class="score">8.5</div>
                            </div>
                            <div class="review-grade_progressBar">
                                <div class="percent" style="width: 85%"></div>
                            </div>
                        </div>
                        <div class="review-standard_item">
                            <div class="review-grade_wrap">
                                <div class="category">服務</div>
                                <div class="score">8.2</div>
                            </div>
                            <div class="review-grade_progressBar">
                                <div class="percent" style="width: 82%"></div>
                            </div>
                        </div>
                        <div class="review-standard_item">
                            <div class="review-grade_wrap">
                                <div class="category">CP值</div>
                                <div class="score">8.0</div>
                            </div>
                            <div class="review-grade_progressBar">
                                <div class="percent" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="review-standard_item">
                            <div class="review-grade_wrap">
                                <div class="category">位置</div>
                                <div class="score">7.8</div>
                            </div>
                            <div class="review-grade_progressBar">
                                <div class="percent" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review_resource">
                    <div class="resource_text">資料來源</div>
                    <div class="resource_wrap">
                        <div class="recource"><img src="{{ asset('images/booking-logo.svg') }}" alt="">
                            <div class="detail"><span>73</span>則評論</div>
                        </div>
                        <div class="recource"><img src="{{ asset('images/agoda-logo.svg') }}" alt="">
                            <div class="detail"><span>73</span>則評論</div>
                        </div>
                        <div class="recource"><img src="{{ asset('images/hotels-logo.svg') }}" alt="">
                            <div class="detail"><span>73</span>則評論</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hl_information-wrapper">
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
                        <div class="facility-list">
                            <div class="list-text">服務設施</div>
                            <ul class="list-con">
                                <li class="facility-item"><img src="/images/facility/room-icons-08.svg" alt="">
                                    <div class="name">免費WI-FI</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-14.svg" alt="">
                                    <div class="name">24小時櫃檯服務</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-16.svg" alt="">
                                    <div class="name">停車場</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-17.svg" alt="">
                                    <div class="name">可帶寵物</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-15.svg" alt="">
                                    <div class="name">餐廳</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-13.svg" alt="">
                                    <div class="name">游泳池</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-12.svg" alt="">
                                    <div class="name">健身房</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-11.svg" alt="">
                                    <div class="name">酒吧</div>
                                </li>
                            </ul>
                        </div>
                        <div class="facility-list">
                            <div class="list-text">所有客房均提供</div>
                            <ul class="list-con">
                                <li class="facility-item"><img src="/images/facility/room-icons-01.svg" alt="">
                                    <div class="name">吹風機</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-02.svg" alt="">
                                    <div class="name">浴巾</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-03.svg" alt="">
                                    <div class="name">浴缸</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-04.svg" alt="">
                                    <div class="name">免費瓶裝水</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-05.svg" alt="">
                                    <div class="name">盥洗用品</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-06.svg" alt="">
                                    <div class="name">冰箱</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-07.svg" alt="">
                                    <div class="name">電視</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-08.svg" alt="">
                                    <div class="name">免費WI-FI</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-09.svg" alt="">
                                    <div class="name">冷氣</div>
                                </li>
                                <li class="facility-item"><img src="/images/facility/room-icons-10.svg" alt="">
                                    <div class="name">淋浴設備</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="info_policy info-box">
                    <h3 class="title">飯店政策</h3>
                    <div class="policy_wrap wrap-con">
                        <div class="policy-type"><img src="/images/facility/room-icons-18.svg" alt=""></div>
                        <div class="policy-item">
                            <div class="item-tit">入住時間＆退房時間</div>
                            <ul class="item-check">
                                <li>
                                    <div class="check-tit">入住時間</div>
                                    <div class="check-time">15:00</div>
                                </li>
                                <li>
                                    <div class="check-tit">退房時間</div>
                                    <div class="check-time">11:00</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="policy_wrap wrap-con">
                        <div class="policy-type"><img src="/images/facility/room-icons-19.svg" alt=""></div>
                        <div class="policy-item">
                            <div class="item-tit">住宿概況</div>
                            <ul class="useful-info">
                                <li>
                                    <div class="info-tit">禁菸房/禁菸樓層:</div>
                                    <div class="info-text">Yes</div>
                                </li>
                                <li>
                                    <div class="info-tit">酒吧/Lounge間數:</div>
                                    <div class="info-text">0</div>
                                </li>
                                <li>
                                    <div class="info-tit">樓層總數:</div>
                                    <div class="info-text">8</div>
                                </li>
                                <li>
                                    <div class="info-tit">餐廳總數:</div>
                                    <div class="info-text">1</div>
                                </li>
                                <li>
                                    <div class="info-tit">客房總數:</div>
                                    <div class="info-text">210</div>
                                </li>
                                <li>
                                    <div class="info-tit">客房室內電壓:</div>
                                    <div class="info-text">110</div>
                                </li>
                                <li>
                                    <div class="info-tit">建築完工年份:</div>
                                    <div class="info-text">2015</div>
                                </li>
                                <li>
                                    <div class="info-tit">最近裝修年份:</div>
                                    <div class="info-text">2015</div>
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
                            <div class="item-info"><a class="info-tit" href="#">紐約千禧希爾頓酒店(The Millennium Hilton New
                                    York)</a>
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