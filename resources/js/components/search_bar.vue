<template itemscope>
    <div class="searchBox">
        <div class="searchBox_wrapper">
            <div class="search-input IconBox">
                <img src="/images/search.svg" alt="">
                <input type="search" name="query" placeholder="搜尋你要找的飯店">
            </div>

            <div class="check-in IconBox">
                <div class="picker-icons">
                    <img src="/images/checkin.svg" alt="">
                </div>
                <div class="picker-text" @click.stop="openDate">
                    <div class="picker_label">入住日期</div>
                    <div class="picker_date">{{ checkinTime }}</div>
                    <date-picker v-model="rangeDate" :lang="config.lang"
                                 confirm confirm-text="確認"
                                 :shortcuts="config.shortcuts"
                                 :not-before="config.disableBefore" range>
                    </date-picker>
                </div>
            </div>

            <div class="check-out IconBox" @click.stop="openDate">
                <div class="picker-icons">
                    <img src="/images/checkout.svg" alt="">
                </div>
                <div class="picker-text">
                    <div class="picker_label">退房日期</div>
                    <div class="picker_date">{{ checkoutTime }}</div>
                </div>
            </div>

            <div class="occupancy IconBox">
                <div class="picker-icons">
                    <img src="/images/travelers.svg" alt=""
                    ></div>
                <div class="picker-text">
                    <div class="picker_label">入住人數</div>
                    <div class="picker_date">{{ numberOfPeople }} 人</div>
                </div>
                <div class="picker-icons_down">
                    <img src="/images/arrow-down.svg" alt="">
                </div>
            </div>

            <button class="search-btn" @click="search">搜尋房價</button>
        </div>
    </div>
</template>

<script>
    import DatePicker from 'modules/vue2-datepicker';

    export default {
        components: {
            DatePicker
        },
        watch: {
            rangeDate: {
                handler: function (item) {
                    let rs = [];

                    for (let i = 0; i <= 1; i++) {
                        rs[i] = item[i].toJSON().slice(0,10).replace(/-/g,'-');
                        rs[i] += "(" + this.config.lang.days[item[i].getDay()] +")";
                    }

                    this.checkinTime  = rs[0];
                    this.checkoutTime = rs[1];
                },
                immediate: true
            }
        },
        data: function () {
            return {
                checkinTime: '',
                checkoutTime: '',
                rangeDate: this.createDateRange(1, 3),
                numberOfPeople: 2,
                config: {
                    lang: {
                        days: ['日', '一', '二', '三', '四', '五', '六'],
                        months: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月']
                    },
                    disableBefore: new Date().toJSON().slice(0,10).replace(/-/g,'-'),
                    shortcuts: [
                        {
                            text: '下七天',
                            onClick: () => {
                                this.rangeDate = this.createDateRange(1, 8)
                            }
                        }
                    ]
                }
            }
        },
        methods: {
            openDate: function () {
                document.getElementsByClassName('mx-input')[0].click()
            },
            createDateRange: function(beginDiffDay, endDiffDay) {
                const todayDate = new Date();

                let beginDate = new Date(todayDate);
                beginDate.setDate(todayDate.getDate() + beginDiffDay);
                let endDate = new Date(todayDate);
                endDate.setDate(todayDate.getDate() + endDiffDay);

                return [
                    beginDate,
                    endDate
                ]
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