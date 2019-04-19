@extends('layout.main')

@push('head')
    <link rel="stylesheet" href="{{ mix('css/list.css') }}">
@endpush

@inject('paginatePresenter', 'App\Presenters\PaginatePresenter')

@section('main_content')
    <div class="gl_outer1200 gl_flex-row">
        <div class="hl_main-content">
            <div class="result_wrapper">
                <div class="result_tit">
                    共有
                    <span>{{ $list['total'] }}</span>
                    間 相關飯店
                </div>
                {{--<div class="result_sorting">--}}
                    {{--<select class="sorting">--}}
                        {{--<option value="" disabled selected>排序方式</option>--}}
                        {{--<option value="最優組合">最優組合</option>--}}
                        {{--<option value="價格最低">價格最低</option>--}}
                        {{--<option value="評分最高">評分最高</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
            </div>

            @if (empty($list['data']))
                <div class="none-hotel_wrapper">
                    <img src="{{ asset('images/bed-img.svg') }}" alt="bed">
                    <div class="none-hotel">
                        <div class="Title">找不到您搜尋的住宿地點</div>
                        <div class="text">建議您重新設定篩選條件，以便搜尋到您理想的飯店。</div>
                        {{--<div class="btn-wrap">--}}
                            {{--<button>重設</button>--}}
                        {{--</div>--}}
                    </div>
                </div>
            @else
                <ul class="hotel-list_wrapper">
                    @foreach($list['data'] as $hotel)
                        <li class="hotel-item hot-item">
                            <div class="item-link" style="cursor: pointer" onclick="location.href='{{ $hotel['link'] }}'">
                                <div class="hotel-info">
                                    <div class="hotel-img"
                                         style="background-image: url('{{ $hotel['photo'] ?? asset('images/noimg.svg') }}')"></div>
                                    <div class="info_container">
                                        <h3 class="con_tit">
                                            <a href="{{ $hotel['link'] }}">
                                                {{ $hotel['translatedName'] }}({{ $hotel['name'] }})
                                            </a>
                                        </h3>
                                        <div class="con_rating">
                                            @if(is_null($hotel['starRated']))
                                                未確認星級
                                            @else
                                                <vue_star_rated star-rated="{{ $hotel['starRated'] }}"></vue_star_rated>
                                            @endif
                                        </div>
                                        <div class="con_distance">
                                            {{ $hotel['address'] }}
                                        </div>
                                        <div class="con_average-price">
                                            <div class="price">NT<span>$2,345</span></div>
                                            <div class="text">~</div>
                                            <div class="price">NT$<span>2,345</span></div>
                                        </div>
                                        <div class="con_review">
                                            <div class="review-num">
                                                {{ $hotel['ratingScore'] }}
                                            </div>
                                            <div class="review-text">
                                                {{ $hotel['ratingPromotion'] }}
                                            </div>
                                            {{--<div class="review-count">--}}
                                                {{--(<span>1245</span>則評論)--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="info_price">
                                    <div class="price_con">
                                        <div class="con-top">
                                            {{--<span>4</span>--}}
                                            {{--個價格，最低--}}
                                            尚未取得價格
                                        </div>
                                        <div class="con-midden">NT$<span> - </span></div>
                                        {{--<div class="con-bottom"><span>Agoda.com</span></div>--}}
                                    </div>
                                    <button class="price_btn"
                                            v-tooltip.top="'該價格為歷史平均價格，準確優惠的價格依照時段會有不同的浮動請進入內頁查看詳細資訊。'">
                                        查看價格
                                    </button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                {!! $paginatePresenter->renderPage($list['paginate'], ['target', 'checkIn', 'checkOut', 'adult']) !!}
            @endif

        </div>
        <div class="hl_sidebar"></div>
    </div>
@endsection

@push('app_js')
    <script src="{{ mix('js/app/list.js') }}"></script>
@endpush