<template>
    <div class="hl_rate-wrapper __anchor_price">

        <div class="hl_min-detail-filter" v-if="this.$parent.isMobile()">
            <div class="min_filter-box">
                <div class="filter-date" @click.stop="openDate()">
                    <div class="check-in min-text">
                        <div class="picker_label">入住日期</div>
                        <div class="picker_date">
                            {{ checkTime.in.mobileStr }}
                        </div>
                    </div>
                    <div class="right-icon">
                        <img src="/images/cc-arrow-left.svg" alt="">
                    </div>
                    <div class="check-out min-text">
                        <div class="picker_label">退房日期</div>
                        <div class="picker_date">
                            {{ checkTime.out.mobileStr }}
                        </div>
                    </div>
                </div>
                <div class="filter-child min-text">
                    <div class="picker_label">人</div>
                    <div class="picker_date">2</div>
                </div>
            </div>
            <!--<div class="min_filter-tags">-->
            <!--<ul class="filter-tags_wrapper">-->
            <!--<li class="tags active">免費早餐</li>-->
            <!--<li class="tags">到店付款</li>-->
            <!--<li class="tags">免費取消</li>-->
            <!--<li class="tags">到店付款</li>-->
            <!--<li class="tags">到店付款</li>-->
            <!--</ul>-->
            <!--</div>-->
        </div>

        <div class="hl_detail-filter" v-else>
            <div class="filter_box">
                <div class="filter_date filter-bg" @click.stop="openDate()">
                    <div class="filter-icon">
                        <img src="/images/date.svg" alt="">
                    </div>
                    <div class="picker-label">
                        {{ checkTime.in.str }}
                    </div>
                    <span>～</span>
                    <div class="picker-label">
                        {{ checkTime.out.str }}
                    </div>
                </div>

                <div class="filter_child filter-bg" v-click-outside="hiddenNumsDrop">
                    <div class="child-wrap" @click="() => {nums.isDrop = ! nums.isDrop}">
                        <div class="filter-icon">
                            <img src="/images/people.svg" alt="">
                        </div>
                        <div class="picker-label">
                            <span class="room-info">{{ numsOfPeople }} 人</span>
                        </div>
                        <div class="arrow-icon">
                            <img src="/images/arrow-down.svg" alt="">
                        </div>
                    </div>
                    <div class="float_child-box" style="user-select: none" :class="{'open': nums.isDrop}">
                        <div class="child-count">
                            <div class="count-left">人數</div>
                            <div class="count-right">
                                <div class="button-minus" @click="adjustNums(false)">
                                    <img src="/images/minus.svg" alt="">
                                </div>
                                <div class="counter">
                                    {{ numsOfPeople }}
                                </div>
                                <div class="button-plus" @click="adjustNums()">
                                    <img src="/images/plus.svg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="filter_button" @click="this.renewal">
                    更新
                </button>
            </div>

            <ul class="filter_tags">
                <li class="tags active">免費早餐</li>
                <li class="tags">到店付款</li>
                <li class="tags">免費取消</li>
            </ul>
        </div>

        <AirbnbStyleDatepicker
                :style="{'z-index': this.$parent.isMobile() ? 100 : 1}"
                :triggerElementId="'price-datepicker-target'"
                :mode="'range'"
                :offset-y="datePickerConfig.offset.y"
                :offset-x="datePickerConfig.offset.x"
                :minDate="new Date()"
                :fullscreen-mobile="true"
                :date-one="checkTime.in.date"
                :date-two="checkTime.out.date"
                :trigger="datePickerConfig.trigger"
                :showActionButtons="this.$parent.isMobile()"
                :showShortcutsMenuTrigger="false"
                mobileHeader="選擇住宿日期"
                @date-one-selected="val => { checkTime.in.date = val }"
                @date-two-selected="val => { checkTime.out.date = val}"
                @closed="() => {this.datePickerConfig.trigger = false}"
                @apply="renewal"
        />

        <div class="hl_rate-list" id="price-datepicker-target">
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
                <div class="text">
                    <span>{{ daysNight }}</span>晚，
                </div>
                <div class="text">
                    <span>{{ numsOfPeople }}</span>
                    位房客
                </div>
            </div>

            <ul class="list_wrapper" v-if="checkHasInfo">
                <li class="list-item" v-for="info in price" :key="info.provider">
                    <div class="item-wrap">
                        <div class="provider_logo">
                            <img :src="info.imgUrl" alt="">
                        </div>

                        <div class="provider_info">
                            <div class="room-con">{{ info['roomType'] }}</div>
                            <div class="room-attributes">
                                <!--<div class="text">不包括早餐</div>-->
                                <!--<div class="text green">免費取消</div>-->
                                <!--<div class="text blue">到店付款</div>-->
                            </div>
                        </div>

                        <div class="provider_price">
                            <div class="price">
                                NT$
                                <span>
                                    {{ info['price'] }}
                                </span>
                            </div>

                            <div class="hotel-name">
                                {{ info['provider']}}
                            </div>
                        </div>
                    </div>
                    <div @click="redirect(info.landingUrl)">
                        <div class="check-btn">
                            前往網站
                        </div>
                        <div class="icons">
                            <img src="/images/arrow-right.svg" alt="">
                        </div>
                    </div>
                </li>
            </ul>

            <div class="lds-roller" v-else-if="isLoading">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            </div>

            <div v-else>
                未取得資料
            </div>

            <div class="rate-ps">
                平均每晚的價格是由我們的合作夥伴提供，且可能不含任何稅金和服務費。
                顯示的稅金及費用皆僅為約略金額。 如需更多詳細資料，請參閱我們合作夥伴的網站。
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'hotelId'
        ],
        data: function () {
            const defaultDate = this.$parent.createDateRange(1, 3);

            return {
                datePickerConfig: {
                    offset: {
                        x: -30,
                        y: 690
                    },
                    trigger: false
                },
                price: {},
                isLoading: false,
                checkTime: {
                    in: {
                        date: defaultDate[0],
                        str: '',
                        mobileStr: ''
                    },
                    out: {
                        date: defaultDate[1],
                        str: '',
                        mobileStr: ''
                    }
                },
                nums: {
                    pool: [1, 2, 3, 4, 5, 6, 7, 8],
                    currentIndex: 1,
                    isDrop: false
                },
                daysNight: 0
            }
        },
        mounted: function () {
            this.renewal();
        },
        computed: {
            checkHasInfo: function () {
                return _.size(this.price) > 0;
            },
            numsOfPeople: function () {
                return this.nums.pool[this.nums.currentIndex];
            }
        },
        watch: {
            price: {
                handler: function () {
                    if (typeof window.initDetectScrollElem === 'function') {
                        window.initDetectScrollElem();
                    }
                },
                immediate: true
            },
            checkTime: {
                handler: function (time) {
                    _.forEach(time, item => {
                        if (item.date !== '') {
                            const tmpDate = new Date(item.date);
                            item.str = item.date + "，週" + this.$parent.formatRDayToZhDay(tmpDate.getDay());
                            item.mobileStr = (tmpDate.getMonth() + 1) + "月" + tmpDate.getDate() + "日";
                        }
                    });

                    const outDateObj = new Date(time.out.date);
                    const inDateObj = new Date(time.in.date);
                    if (outDateObj > inDateObj) {
                        const tmp = Math.abs(outDateObj - inDateObj) / 1000;
                        this.daysNight = Math.floor(tmp / 86400);
                    }
                },
                immediate: true,
                deep: true
            }
        },
        methods: {
            hiddenNumsDrop: function () {
                this.nums.isDrop = false;
            },
            openDate: function () {
                this.datePickerConfig.trigger = true;
            },
            renewal: function () {
                this.isLoading = true;
                this.price = {};
                const provider = [
                    'agoda',
                    'booking'
                ];

                setTimeout(() => {
                    _.forEach(provider, value => {
                        const promise = this.getPrice(value);

                        promise.then(
                            response => {
                                let data = response.data.message;
                                data.imgUrl = '/images/' + data.provider + '-logo.svg';
                                this.$set(this.price, value, response.data.message);
                                if (this.isLoading) this.isLoading = false;
                            }
                        ).catch(
                            () => {
                                if (this.isLoading) this.isLoading = false;
                            }
                        );
                    });
                }, 1000)
            },
            getPrice: function (provider) {
                const data = {
                    'check-in': this.checkTime.in.date,
                    'check-out': this.checkTime.out.date,
                    'provider': provider,
                    'nums': this.nums.pool[this.nums.currentIndex],
                };

                let parameters = '?';
                _.forEach(data, (value, key) => {
                   parameters += key + '=' + value + '&';
                });
                parameters = _.trimEnd(parameters, '&');

                return window.$http.get(
                    '/api/affiliate/price/' + this.hotelId + parameters
                );
            },
            adjustNums: function (isPlus = true) {
                if (isPlus) {
                    if (this.nums.currentIndex + 1 === this.nums.pool.length) return;
                    this.nums.currentIndex ++;
                } else {
                    if (this.nums.currentIndex === 0) return;
                    this.nums.currentIndex --;
                }
            },
            redirect: function (url) {
                window.open(url);
            }
        }
    }
</script>

<style>
    .mx-input {
        display: none;
    }
    .lds-roller {
        display: flex;
        position: relative;
        justify-content: center;
        width: 90%;
        height: 100px;
    }
    .lds-roller div {
        animation: lds-roller 2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        transform-origin: 32px 32px;
    }
    .lds-roller div:after {
        content: " ";
        display: block;
        position: absolute;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #ffa83b;
        margin: -3px 0 0 -3px;
    }
    .lds-roller div:nth-child(1) {
        animation-delay: -0.036s;
    }
    .lds-roller div:nth-child(1):after {
        top: 50px;
        left: 50px;
    }
    .lds-roller div:nth-child(2) {
        animation-delay: -0.072s;
    }
    .lds-roller div:nth-child(2):after {
        top: 54px;
        left: 45px;
    }
    .lds-roller div:nth-child(3) {
        animation-delay: -0.108s;
    }
    .lds-roller div:nth-child(3):after {
        top: 57px;
        left: 39px;
    }
    .lds-roller div:nth-child(4) {
        animation-delay: -0.144s;
    }
    .lds-roller div:nth-child(4):after {
        top: 58px;
        left: 32px;
    }
    .lds-roller div:nth-child(5) {
        animation-delay: -0.18s;
    }
    .lds-roller div:nth-child(5):after {
        top: 57px;
        left: 25px;
    }
    .lds-roller div:nth-child(6) {
        animation-delay: -0.216s;
    }
    .lds-roller div:nth-child(6):after {
        top: 54px;
        left: 19px;
    }
    .lds-roller div:nth-child(7) {
        animation-delay: -0.252s;
    }
    .lds-roller div:nth-child(7):after {
        top: 50px;
        left: 14px;
    }
    .lds-roller div:nth-child(8) {
        animation-delay: -0.288s;
    }
    .lds-roller div:nth-child(8):after {
        top: 45px;
        left: 10px;
    }
    @keyframes lds-roller {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>