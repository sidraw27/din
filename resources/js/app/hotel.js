import vue_search_bar from "../components/search_bar";
import vue_real_time_price from "../components/real_time_hotel_price";
import vue_history_price from "../components/history_price";
import vue_carousel from '../components/carousel';
import vue_map from '../components/map';
import vue_star_rated from '../components/star_rated'

new Vue({
    el: "#app",
    components: {
        vue_search_bar,
        vue_real_time_price,
        vue_history_price,
        vue_carousel,
        vue_map,
        vue_star_rated
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