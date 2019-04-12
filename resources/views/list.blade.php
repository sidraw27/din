@extends('layout.master')

@push('head')
    <link rel="stylesheet" href="{{ mix('css/list.css') }}">
@endpush

@section('content')
<div class="gl_outer1200 gl_flex-row">
    <div class="hl_main-content">
        <div class="result_wrapper">
            <div class="result_tit">
                共有<span>823</span>間飯店
            </div>
            <div class="result_sorting">
                <select class="sorting">
                    <option value="" disabled selected>排序方式</option>
                    <option value="最優組合">最優組合</option>
                    <option value="價格最低">價格最低</option>
                    <option value="評分最高">評分最高</option>
                </select>
            </div>
        </div>
        <ul class="hotel-list_wrapper">
            <li class="hotel-item hot-item">
                <div class="item-link" style="cursor: pointer" onclick="location.href=''">
                    <div class="hotel-info">
                        <div class="hotel-img" style="background-image: url('https://a0.muscache.com/im/pictures/47985619/11203a2d_original.jpg?aki_policy=xx_large')"></div>
                        <div class="info_container">
                            <h3 class="con_tit">
                                <a>
                                    台北貴都大飯店 Taipei Crystal Hotel
                                </a>
                            </h3>
                            <div class="con_rating">
                               <span class="star">
                                    <img src="/images/star.svg" alt="">
                                </span>
                            </div>
                            <div class="con_distance">距離市中心 <span>3.1 公里</span></div>
                            <div class="con_average-price">
                                <div class="price">NT<span>$2,345</span></div>
                                <div class="text">~</div>
                                <div class="price">NT$<span>2,345</span></div>
                            </div>
                            <div class="con_review">
                                <div class="review-num">8.1</div>
                                <div class="review-text">很讚</div>
                                <div class="review-count">
                                    (<span>1245</span>則評論)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info_price">
                        <div class="price_con">
                            <div class="con-top">
                                <span>4</span>
                                個價格，最低
                            </div>
                            <div class="con-midden">NT$<span>2,345 </span></div>
                            <div class="con-bottom"><span>Agoda.com</span></div>
                        </div>
                        <button class="price_btn">立即訂房</button>
                    </div>
                </div>
            </li>
            <li class="hotel-item"><a class="item-link" href="#">
                    <div class="hotel-info">
                        <div class="hotel-img"
                             style="background-image: url('https://dimg04.c-ctrip.com/images/22070v000000k6xek7609_R_1136_750_R5_D.jpg')"></div>
                        <div class="info_container">
                            <h3 class="con_tit">台北貴都大飯店 Taipei Crystal Hotel</h3>
                            <div class="con_rating"><span class="star"><img src="/images/star.svg" alt=""></span><span
                                        class="star"><img src="/images/star.svg" alt=""></span><span class="star"><img
                                            src="/images/star.svg" alt=""></span><span class="star"><img
                                            src="/images/star.svg" alt=""></span></div>
                            <div class="con_distance">台灣 <span>台北</span></div>
                            <div class="con_average-price">
                                <div class="price">NT<span>$2,345</span></div>
                                <div class="text">~</div>
                                <div class="price">NT$<span>2,345</span></div>
                            </div>
                            <div class="con_review">
                                <div class="review-num">8.1</div>
                                <div class="review-text">很讚</div>
                                <div class="review-count">
                                    (<span>1245</span>則評論)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info_price">
                        <div class="price_con">
                            <div class="con-top">
                                <span>4</span>
                                個價格，最低
                            </div>
                            <div class="con-midden">NT$<span>2,345 </span></div>
                            <div class="con-bottom"><span>Agoda.com</span></div>
                        </div>
                        <button class="price_btn">立即訂房</button>
                    </div>
                </a></li>
            <li class="hotel-item"><a class="item-link" href="#">
                    <div class="hotel-info">
                        <div class="hotel-img"
                             style="background-image: url('https://dimg04.c-ctrip.com/images/200110000000qaysw9880_R_1136_750_R5_D.jpg')"></div>
                        <div class="info_container">
                            <h3 class="con_tit">台北貴都大飯店 Taipei Crystal Hotel</h3>
                            <div class="con_rating"><span class="star"><img src="/images/star.svg" alt=""></span><span
                                        class="star"><img src="/images/star.svg" alt=""></span><span class="star"><img
                                            src="/images/star.svg" alt=""></span><span class="star"><img
                                            src="/images/star.svg" alt=""></span></div>
                            <div class="con_distance">台灣 <span>台北</span></div>
                            <div class="con_average-price">
                                <div class="price">NT<span>$2,345</span></div>
                                <div class="text">~</div>
                                <div class="price">NT$<span>2,345</span></div>
                            </div>
                            <div class="con_review">
                                <div class="review-num">8.1</div>
                                <div class="review-text">很讚</div>
                                <div class="review-count">
                                    (<span>1245</span>則評論)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info_price">
                        <div class="price_con">
                            <div class="con-top">
                                <span>4</span>
                                個價格，最低
                            </div>
                            <div class="con-midden">NT$<span>2,345 </span></div>
                            <div class="con-bottom"><span>Agoda.com</span></div>
                        </div>
                        <button class="price_btn">立即訂房</button>
                    </div>
                </a></li>
        </ul>
        <div class="none-hotel_wrapper" style="display: none;"><img src="/images/bed-img.svg" alt="">
            <div class="none-hotel">
                <div class="Title">找不到您搜尋的住宿地點</div>
                <div class="text">建議您重新設定篩選條件，以便搜尋到您理想的飯店。</div>
                <div class="btn-wrap">
                    <button>重設</button>
                </div>
            </div>
        </div>
        <ul class="pagination_wrapper">
            <li class="previous page-btn">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 94.25 175.48">
                        <defs>
                            <svg:style>
                                .cls-6 {
                                    fill: #aeca37;
                                }
                            </svg:style>
                        </defs>
                        <path class="cls-6"
                              d="M142.4,12.21a4.57,4.57,0,0,1,3.23,7.8L65.74,99.9l79.89,79.89a4.57,4.57,0,0,1-6.26,6.66l-.2-.2L52.82,99.9l86.35-86.35A4.56,4.56,0,0,1,142.4,12.21Z"
                              transform="translate(-52.82 -12.21)">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="page-num">
                <a href="#">
                    <span>1</span>
                </a>
            </li>
            <li class="page-num">
                <a class="active" href="#">
                    <span>2</span>
                </a>
            </li>
            <li class="page-num">
                <a href="#">
                    <span>3</span>
                </a>
            </li>
            <li class="previous page-btn">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 94.25 175.48">
                        <defs>
                            <svg:style>
                                .cls-6 {
                                    fill: #aeca37;
                                }
                            </svg:style>
                        </defs>
                        <path class="cls-6"
                              d="M57.49,187.69a4.57,4.57,0,0,1-3.23-7.8L134.15,100,54.26,20.11a4.57,4.57,0,0,1,6.26-6.66l.2.2L147.07,100,60.72,186.35A4.56,4.56,0,0,1,57.49,187.69Z"
                              transform="translate(-52.82 -12.21)">
                        </path>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
    <div class="hl_sidebar"></div>
</div>
@endsection