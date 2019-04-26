
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';

/**
 * 通用 date picker 設定
 */
import AirbnbStyleDatepicker from 'vue-airbnb-style-datepicker';
import 'vue-airbnb-style-datepicker/dist/vue-airbnb-style-datepicker.min.css';
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

import Tooltip from 'vue-directive-tooltip';
import 'vue-directive-tooltip/css/index.css';
Vue.use(Tooltip);

import VueCookie from 'vue-cookie';
Vue.use(VueCookie);

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
Vue.prototype.$isMobile = window.isMobile();
Vue.prototype.$scrollLock = isLockScreen => {
    const stopScrollClass = 'stop-scrolling';

    if (isLockScreen) {
        document.body.classList.add(stopScrollClass);
    } else {
        document.body.classList.remove(stopScrollClass);
    }
};
window.Vue = Vue;

// NProgress bar
import nProgress from "nprogress";
import 'nprogress/nprogress.css';

window.NProgress = nProgress;
let npInterval = setInterval(() => {
    if (document.body != null) {
        clearInterval(npInterval);
        window.NProgress.start();
        window.NProgress.done();
        window.addEventListener('beforeunload', function() {
            window.NProgress.start();
        });
    }
}, 100);
