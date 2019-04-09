<template itemscope>
    <div class="searchBox">
        <div class="searchBox_wrapper">
            <div class="search-input IconBox">
                <img src="/images/search.svg" alt="">
                <input type="search" name="query" placeholder="搜尋你要找的飯店">
            </div>

            <div class="check-in IconBox" @click="openDate()" id="search_bar-datepicker-target">
                <div class="picker-icons">
                    <img src="/images/checkin.svg" alt="">
                </div>
                <div class="picker-text">
                    <div class="picker_label">入住日期</div>
                    <div class="picker_date">{{ checkTime.in.str }}</div>
                </div>
            </div>

            <div class="check-out IconBox" @click="openDate()">
                <div class="picker-icons">
                    <img src="/images/checkout.svg" alt="">
                </div>
                <div class="picker-text">
                    <div class="picker_label">退房日期</div>
                    <div class="picker_date">{{ checkTime.out.str }}</div>
                </div>
            </div>

            <AirbnbStyleDatepicker
                    :triggerElementId="'search_bar-datepicker-target'"
                    :mode="'range'"
                    :minDate="new Date()"
                    :offset-y="datePickerConfig.offset.y"
                    :offset-x="datePickerConfig.offset.x"
                    :fullscreen-mobile="true"
                    :date-one="checkTime.in.date"
                    :date-two="checkTime.out.date"
                    :trigger="datePickerConfig.trigger"
                    :showActionButtons="false"
                    :showShortcutsMenuTrigger="false"
                    @date-one-selected="val => { checkTime.in.date = val }"
                    @date-two-selected="val => { checkTime.out.date = val}"
                    @closed="() => {datePickerConfig.trigger = false}"
            />

            <div class="occupancy IconBox" v-click-outside="hiddenNumsDrop">
                <div class="occupancy-wrap" @click="() => {nums.isDrop = ! nums.isDrop}">
                    <div class="picker-icons">
                        <img src="/images/travelers.svg" alt="">
                    </div>
                    <div class="picker-text">
                        <div class="picker_label">入住人數</div>
                        <div class="picker_date">
                            {{ nums.pool[nums.currentIndex] }}人
                        </div>
                    </div>
                    <div class="picker-icons_down">
                        <img src="/images/arrow-down.svg" alt="">
                    </div>
                </div>
                <div class="float_child-box" :class="{'open': nums.isDrop}">
                    <div class="child-count" style="user-select: none">
                        <div class="count-left">人數</div>
                        <div class="count-right">
                            <div class="button-minus" @click="adjustNums(false)">
                                <img src="/images/minus.svg" alt="">
                            </div>
                            <div class="counter">
                                {{ nums.pool[nums.currentIndex] }}
                            </div>
                            <div class="button-plus" @click="adjustNums()">
                                <img src="/images/plus.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="search-btn" @click="search">搜尋房價</button>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            const defaultDate = this.$parent.createDateRange(1, 3);

            return {
                datePickerConfig: {
                    offset: {
                        x: -95,
                        y: 90
                    },
                    trigger: false
                },
                dateFormat: 'YYYY-MM-DD',
                checkTime: {
                    in: {
                        date: defaultDate[0],
                        str: ''
                    },
                    out: {
                        date: defaultDate[1],
                        str: ''
                    }
                },
                nums: {
                    pool: [1, 2, 3, 4, 5, 6, 7, 8],
                    currentIndex: 1,
                    isDrop: false
                }
            }
        },
        watch: {
            checkTime: {
                handler: function (time) {
                    _.forEach(time, item => {
                        if (item.date !== '') {
                            const tmpDate = new Date(item.date);
                            item.str = item.date + "(週" + this.$parent.formatRDayToZhDay(tmpDate.getDay()) + ")";
                        }
                    })
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
            adjustNums: function (isPlus = true) {
                if (isPlus) {
                    if (this.nums.currentIndex + 1 === this.nums.pool.length) return;
                    this.nums.currentIndex ++;
                } else {
                    if (this.nums.currentIndex === 0) return;
                    this.nums.currentIndex --;
                }
            },
            search: function () {

            }
        }
    }
</script>

<style>
    .mx-input {
        display: none;
    }
</style>