@extends('layout.master')

@push('head')
    <link rel="stylesheet" href="{{ mix('css/index.css') }}">
@endpush

@section('content')
    <div class="main-search_wrapper">
        <div class="main-search_con">
            <h1 class="Title">盯房網</h1>
            <div class="slogan">幫您比較各大訂房網站的房價，即時通知您最低的價格，讓您輕鬆找到理想的飯店</div>
            <div class="searchBox">
                <div class="searchBox_wrapper">
                    <div class="search-input IconBox"><img src="/images/search.svg" alt="">
                        <input type="search" name="query" placeholder="搜尋你要找的飯店">
                    </div>
                    <div class="check-in IconBox">
                        <div class="picker-icons"><img src="/images/checkin.svg" alt=""></div>
                        <div class="picker-text">
                            <div class="picker_label">入住日期</div>
                            <div class="picker_date">2月20日，週一</div>
                        </div>
                    </div>
                    <div class="check-out IconBox">
                        <div class="picker-icons"><img src="/images/checkout.svg" alt=""></div>
                        <div class="picker-text">
                            <div class="picker_label">退房日期</div>
                            <div class="picker_date">2月23日，週四</div>
                        </div>
                    </div>
                    <div class="occupancy IconBox">
                        <div class="occupancy-wrap">
                            <div class="picker-icons"><img src="/images/travelers.svg" alt=""></div>
                            <div class="picker-text">
                                <div class="picker_label">入住人數</div>
                                <div class="picker_date">2人</div>
                            </div>
                            <div class="picker-icons_down"><img src="/images/arrow-down.svg" alt=""></div>
                        </div>
                        <div class="float_child-box">
                            <div class="child-count">
                                <div class="count-left">人數</div>
                                <div class="count-right">
                                    <div class="button-minus"><img src="/images/minus.svg" alt=""></div>
                                    <div class="counter">0</div>
                                    <div class="button-plus"><img src="/images/plus.svg" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="search-btn">搜尋房價</button>
                </div>
            </div>
        </div>
        <div class="main-search_bg"></div>
    </div>
    <div class="pop-login_box">
        <div class="pop-login">
            <div class="Title">成為Dinroom.com會員</div>
            <div class="text">可以及時通知您飯店最新房價，讓您不錯過理想的飯店</div>
            <button class="login-btn">登入會員</button>
            <button class="close-btn"><img src="/images/close.svg" alt=""></button>
        </div>
    </div>
    <div class="description_wrapper">
        <h3 class="Title">盯房網是？</h3>
        <div class="description-con">
            <div class="description">
                <div class="icon-img"><img src="/images/icons-01.svg" alt=""></div>
                <div class="slogan">
                    <div class="title">搜尋飯店</div>
                    <div class="text">超過 1,200,000 家酒店、公寓和旅舍可供搜尋。</div>
                </div>
            </div>
            <div class="description">
                <div class="icon-img"><img src="/images/icons-02.svg" alt=""></div>
                <div class="slogan">
                    <div class="title">即時通知</div>
                    <div class="text">您可以追蹤理想飯店的房價，若價格有變動，我們會即時的通知您，讓您不錯過最低房價。</div>
                </div>
            </div>
            <div class="description">
                <div class="icon-img"><img src="/images/icons-03.svg" alt=""></div>
                <div class="slogan">
                    <div class="title">歷史房價</div>
                    <div class="text">您可以看到飯店7天前的歷史房價，讓您用最低的價格入住理想的飯店。</div>
                </div>
            </div>
        </div>
    </div>
    <div class="tag_wrapper">
        <h3 class="title">熱門城市、飯店搜索</h3>
        <div class="tag-con"><a class="tag" href="#">東京住宿</a><a class="tag" href="#">大阪住宿</a><a class="tag"
                                                                                                href="#">惠州國際大酒店</a><a
                    class="tag" href="#">高雄中央公園英迪格酒店</a><a class="tag" href="#">香港住宿</a><a class="tag" href="#">首爾住宿</a><a
                    class="tag" href="#">高雄中央公園英迪格酒店</a></div>
    </div>
    <div class="topDestination_wrapper">
        <h3 class="title">推薦地區</h3>
        <div class="destination-scroll">
            <ul class="destination-con">
                <li class="item" style="background-image: url('/images/area/kyoto.jpg')"><a href="#">
                        <div class="MainTitle">京都</div>
                        <div class="SubTitle">日本</div>
                    </a></li>
                <li class="item" style="background-image: url('/images/area/osaka.jpg')"><a href="#">
                        <div class="MainTitle">大阪</div>
                        <div class="SubTitle">日本</div>
                    </a></li>
                <li class="item" style="background-image: url('/images/area/seoul.jpg')"><a href="#">
                        <div class="MainTitle">首爾</div>
                        <div class="SubTitle">韓國</div>
                    </a></li>
                <li class="item" style="background-image: url('/images/area/taipei.jpg')"><a href="#">
                        <div class="MainTitle">台北</div>
                        <div class="SubTitle">台灣</div>
                    </a></li>
            </ul>
        </div>
    </div>
@endsection