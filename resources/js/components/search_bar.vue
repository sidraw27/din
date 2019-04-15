<template itemscope>
    <div>
        <div class="hl_min-search-bar" v-if="this.$parent.isMobile()">
            <div class="min-search-bar" :style="beforeMaskStyle">
                <div class="search-input IconBox">
                    <img src="/images/search.svg" alt="">
                    <form autocomplete="off" @submit="goSearch">
                        <vue-autosuggest
                                @focus="toggleMask(true)"
                                :suggestions="suggestions"
                                :limit="10"
                                :searchInput="this.value"
                                :section-configs="sectionConfigs"
                                :input-props="inputProps">
                            <template slot-scope="{suggestion}">
                                <span class="my-suggestion-item">
                                    {{ suggestion.item }}
                                </span>
                            </template>
                        </vue-autosuggest>
                    </form>
                </div>
            </div>

            <div class="min_filter-box">
                <div class="filter-date" :id="triggerElementId" @click="openDate">
                    <div class="check-in min-text">
                        <div class="picker_label">入住日期</div>
                        <div class="picker_date">{{ checkTime.in.str }}</div>
                    </div>
                    <div class="right-icon">
                        <img src="/images/cc-arrow-left.svg" alt="">
                    </div>
                    <div class="check-out min-text">
                        <div class="picker_label">退房日期</div>
                        <div class="picker_date">{{ checkTime.out.str }}</div>
                    </div>
                </div>

                <AirbnbStyleDatepicker
                        :style="beforeMaskStyle"
                        :triggerElementId="triggerElementId"
                        :mode="'range'"
                        :minDate="new Date()"
                        :fullscreen-mobile="true"
                        :date-one="checkTime.in.date"
                        :date-two="checkTime.out.date"
                        :trigger="datePickerConfig.trigger"
                        :showActionButtons="this.$parent.isMobile()"
                        :showShortcutsMenuTrigger="false"
                        :mobileHeader="'選擇入住日期'"
                        @date-one-selected="val => { checkTime.in.date = val }"
                        @date-two-selected="val => { checkTime.out.date = val}"
                        @opened="toggleMask(true)"
                        @closed="() => {datePickerConfig.trigger = this.isShowMask = false}"
                        @apply="goSearch"
                />

                <div class="filter-child">
                    <div class="picker_label">
                        <img src="/images/people.svg" alt="">
                    </div>
                    <div class="picker_date">
                        <label>
                            <select class="people-num" v-model="nums.adult.currentIndex" @change="goSearch">
                                <option v-for="value in nums.adult.pool" :value="value -1">
                                    {{ value }}人
                                </option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="searchBox" v-else :style="beforeMaskStyle">
            <div class="searchBox_wrapper">
                <div class="search-input IconBox">
                    <img src="/images/search.svg" alt="">
                    <form autocomplete="off" style="width: 100%">
                        <vue-autosuggest
                                @focus="toggleMask(true)"
                                :suggestions="suggestions"
                                :limit="10"
                                :searchInput="this.value"
                                :section-configs="sectionConfigs"
                                :input-props="inputProps">
                            <template slot-scope="{suggestion}">
                                <span class="my-suggestion-item">
                                    {{ suggestion.item }}
                                </span>
                            </template>
                        </vue-autosuggest>
                    </form>
                </div>

                <div class="check-in IconBox" @click="openDate" :id="triggerElementId">
                    <div class="picker-icons">
                        <img src="/images/checkin.svg" alt="">
                    </div>
                    <div class="picker-text">
                        <div class="picker_label">
                            入住日期
                        </div>
                        <div class="picker_date">
                            {{ checkTime.in.str }}
                        </div>
                    </div>
                </div>

                <div class="check-out IconBox" @click="openDate">
                    <div class="picker-icons">
                        <img src="/images/checkout.svg" alt="">
                    </div>
                    <div class="picker-text">
                        <div class="picker_label">
                            退房日期
                        </div>
                        <div class="picker_date">
                            {{ checkTime.out.str }}
                        </div>
                    </div>
                </div>

                <AirbnbStyleDatepicker
                        :style="beforeMaskStyle"
                        :triggerElementId="triggerElementId"
                        :mode="'range'"
                        :minDate="new Date()"
                        :offset-y="datePickerConfig.offset.y"
                        :offset-x="datePickerConfig.offset.x"
                        :fullscreen-mobile="true"
                        :date-one="checkTime.in.date"
                        :date-two="checkTime.out.date"
                        :trigger="datePickerConfig.trigger"
                        :showActionButtons="this.$parent.isMobile()"
                        :showShortcutsMenuTrigger="false"
                        :mobileHeader="'選擇入住日期'"
                        @date-one-selected="val => { checkTime.in.date = val }"
                        @date-two-selected="val => { checkTime.out.date = val}"
                        @opened="toggleMask(true)"
                        @closed="() => {datePickerConfig.trigger = false}"
                        @apply="goSearch"
                />

                <div class="occupancy IconBox" v-click-outside="hiddenNumsDrop">
                    <div class="occupancy-wrap" @click="() => {nums.isDrop = ! nums.isDrop}">
                        <div class="picker-icons">
                            <img src="/images/travelers.svg" alt="">
                        </div>
                        <div class="picker-text">
                            <div class="picker_label">
                                入住人數
                            </div>
                            <div class="picker_date">
                                {{ nums.adult.pool[nums.adult.currentIndex] }}人
                            </div>
                        </div>
                        <div class="picker-icons_down">
                            <img src="/images/arrow-down.svg" alt="">
                        </div>
                    </div>
                    <div class="float_child-box" :class="{'open': nums.isDrop}">
                        <div class="child-count" style="user-select: none">
                            <div class="count-left">
                                人數
                            </div>
                            <div class="count-right">
                                <div class="button-minus" @click="adjustNums(false)">
                                    <img src="/images/minus.svg" alt="">
                                </div>
                                <div class="counter">
                                    {{ nums.adult.pool[nums.adult.currentIndex] }}
                                </div>
                                <div class="button-plus" @click="adjustNums()">
                                    <img src="/images/plus.svg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="search-btn" @click="goSearch">
                    搜出好房
                </button>
            </div>
        </div>

        <vue_mask :show="isShowMask" @close="closeMask"></vue_mask>
    </div>
</template>

<script>
    import {VueAutosuggest} from 'vue-autosuggest';
    import vue_mask from '../components/mask';

    export default {
        props: [
            'action',
            'target',
            'checkIn',
            'checkOut',
            'adult'
        ],
        components: {
            VueAutosuggest,
            vue_mask
        },
        created: function () {
            if (this.checkIn !== '') {
                this.checkTime.in.date = this.checkIn;
            }
            if (this.checkOut !== '') {
                this.checkTime.out.date = this.checkOut;
            }

            const adultIndex = this.nums.adult.pool.indexOf(parseInt(this.adult));
            if (adultIndex >= 0) {
                this.nums.adult.currentIndex = adultIndex;
            }
        },
        data: function () {
            const defaultDate = this.$parent.createDateRange(10, 13);

            return {
                triggerElementId: 'search_bar-datepicker-target',
                inputProps: {
                    id: "autosuggest__input",
                    onInputChange: this.onInputChange,
                    placeholder: "搜尋飯店、地區、景點",
                    name: '__search_input',
                    initialValue: this.target
                },
                sectionConfigs: {
                    hotel: {
                        limit: 5,
                        label: '飯店',
                        onSelected: this.selectedValue
                    },
                    area: {
                        limit: 5,
                        label: '地區',
                        onSelected: this.selectedValue
                    },
                    attraction: {
                        limit: 5,
                        label: "景點",
                        onSelected: this.selectedValue
                    }
                },
                related: [],
                value: null,
                suggestions: [],
                datePickerConfig: {
                    offset: {
                        x: -95,
                        y: 20
                    },
                    trigger: false
                },
                checkTime: {
                    in: {
                        date: defaultDate[0],
                        str: null
                    },
                    out: {
                        date: defaultDate[1],
                        str: null
                    }
                },
                nums: {
                    adult: {
                        pool: [1, 2, 3, 4, 5, 6, 7, 8],
                        currentIndex: 1
                    },
                    isDrop: false
                },
                isShowMask: false
            }
        },
        computed: {
            beforeMaskStyle: function () {
                return {
                    'z-index': this.isShowMask ? 1003 : 100
                };
            }
        },
        watch: {
            checkTime: {
                handler: function (time) {
                    _.forEach(time, item => {
                        if (item.date !== '') {
                            const tmpDate = new Date(item.date);
                            if (this.$parent.isMobile()) {
                                if (typeof item.date === 'string') {
                                    item.str = item.date.replace(/-/g, '/');
                                }
                            } else {
                                item.str = item.date + "(週" + this.$parent.formatRDayToZhDay(tmpDate.getDay()) + ")";
                            }
                        }
                    })
                },
                immediate: true,
                deep: true
            },
            nums : {
                handler: function (nums) {
                    if (nums.isDrop) {
                        this.toggleMask(true);
                    }
                },
                deep: true
            }
        },
        methods: {
            selectedValue: function (selected) {
                this.value = selected.item;
                this.toggleMask(false);
                this.goSearch();
            },
            hiddenNumsDrop: function () {
                this.nums.isDrop = false;
            },
            openDate: function () {
                this.datePickerConfig.trigger = true;
            },
            toggleMask: function (isOpen) {
                this.isShowMask = isOpen;
            },
            adjustNums: function (isPlus = true) {
                if (isPlus) {
                    if (this.nums.adult.currentIndex + 1 === this.nums.adult.pool.length) return;
                    this.nums.adult.currentIndex++;
                } else {
                    if (this.nums.adult.currentIndex === 0) return;
                    this.nums.adult.currentIndex--;
                }
            },
            goSearch: function () {
                location.href =
                    `${this.action}?target=${this.value}` +
                    `&checkIn=${this.checkTime.in.date}` +
                    `&checkOut=${this.checkTime.out.date}` +
                    `&adult=${this.nums.adult.pool[this.nums.adult.currentIndex]}`;
            },
            closeMask: function () {
                this.isShowMask = false
            },
            onInputChange(text) {
                if (text === '' || text === undefined) {
                    return;
                }

                this.suggestions = [
                    {
                        name: 'hotel',
                        data: [
                            '高雄國賓大飯店',
                            '高雄寒軒',
                            '高雄國賓大飯店',
                            '高雄寒軒',
                            '高雄國賓大飯店',
                            '高雄寒軒',
                            '高雄國賓大飯店',
                            '高雄寒軒',
                            '高雄國賓大飯店',
                            '高雄寒軒',
                        ]
                    },
                    {
                        name: 'area',
                        data: [
                            '台灣, 高雄市',
                            '高雄前鎮區'
                        ]
                    },
                    {
                        name: 'attraction',
                        data: [
                            '高雄蓮池潭',
                            '高雄壽山'
                        ]
                    }
                ];

                this.value = text.trim();
            }
        }
    }
</script>

<style>
    .mx-input {
        display: none;
    }

    .searchBox {
        position: relative;
    }

    .search-input.IconBox {
        position: relative;
    }

    #autosuggest {
        width: 100%;
    }

    div.autosuggest__results-container {
        top: 52px;
        position: absolute;
        left: 0;
        right: 0;
        z-index: 100;
    }

    div.autosuggest__results-container ul {
        background-color: #fafafa;
        box-shadow: 4px 6px 10px rgba(0, 0, 0, .1);
    }

    div.autosuggest__results-container li {
        padding: 15px;
        cursor: pointer;
    }

    div.autosuggest__results {
        overflow: scroll;
        max-height: 500px;
    }

    .autosuggest__results_item-highlighted {
        color: white;
        background-color: #f1b54f;
    }

    .autosuggest__results .autosuggest__results_title {
        cursor: default;
        color: gray;
        font-size: 11px;
        margin-left: 0;
        padding: 15px 13px 5px;
        border-top: 1px solid lightgray;
    }

    .__full_mask {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        opacity: .35;
        background-color: #1b1515;
        z-index: 1001;
    }
</style>