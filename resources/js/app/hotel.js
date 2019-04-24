import vue_search_bar from "../components/search_bar";
import vue_real_time_price from "../components/real_time_hotel_price";
import vue_history_price from "../components/history_price";
import vue_carousel from '../components/carousel';
import vue_map from '../components/map';
import vue_star_rated from '../components/star_rated';
import vue_price_trace from '../components/price_trace_button';
import vue_ad_sidebar from '../components/ads/hotel_sidebar';

new Vue({
    el: "#app",
    components: {
        vue_search_bar,
        vue_real_time_price,
        vue_history_price,
        vue_carousel,
        vue_map,
        vue_star_rated,
        vue_price_trace,
        vue_ad_sidebar
    }
});