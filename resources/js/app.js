
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.Vue = require('vue');
/**
 * 通用 date picker 設定
 */
import AirbnbStyleDatepicker from 'vue-airbnb-style-datepicker';
import 'vue-airbnb-style-datepicker/dist/vue-airbnb-style-datepicker.min.css'
Vue.use(AirbnbStyleDatepicker, {
    sundayFirst: true,
    daysShort: ['一', '二', '三', '四', '五', '六', '日'],
    monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
    colors: {
        selected: '#f9826b',
        inRange: '#f99965',
        selectedText: '#fff',
        text: '#565a5c',
        inRangeBorder: '#f99965',
        disabled: '#fff',
    },
    texts: {
        apply: '確認',
        cancel: '取消'
    }
});

import VueCarousel from '@chenfengyuan/vue-carousel';
Vue.use(VueCarousel);

import vue_search_bar from "./components/search_bar";
import vue_real_time_price from "./components/real_time_hotel_price";
import vue_history_price from "./components/history_price";
import vue_carousel from './components/carousel';

Vue.directive('click-outside', {
    bind: function (el, binding, vnode) {
        el.clickOutsideEvent = function (event) {
            if (!(el === event.target || el.contains(event.target))) {
                vnode.context[binding.expression](event);
            }
        };
        document.body.addEventListener('click', el.clickOutsideEvent)
    },
    unbind: function (el) {
        document.body.removeEventListener('click', el.clickOutsideEvent)
    },
});

new Vue({
    el: "#app",
    components: {
        vue_search_bar,
        vue_real_time_price,
        vue_history_price,
        vue_carousel
    },
    methods: {
        createDateRange: function(beginDiffDay, endDiffDay) {
            const todayDate = new Date();

            let beginDate = new Date(todayDate);
            beginDate.setDate(todayDate.getDate() + beginDiffDay);
            let endDate = new Date(todayDate);
            endDate.setDate(todayDate.getDate() + endDiffDay);

            return [
                beginDate,
                endDate
            ];
        },
        isMobile: function () {
            return window.isMobile();
        },
        formatRDayToZhDay: function (rday) {
            if (rday < 0 || rday > 6) {
                return '';
            }

            const mapping = [
                '日',
                '一',
                '二',
                '三',
                '四',
                '五',
                '六',
            ];

            return mapping[rday];
        }
    }
});