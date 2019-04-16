<template>
    <div>
        <div class="hotel_follow-btn" :style="btnClass" v-tooltip.bottom.notrigger="tooltip">
            <button class="follow-btn">
                <img src="/images/track-border.svg" alt="track">
                <span>價格追蹤</span>
            </button>
        </div>

        <vue_mask :show="this.isShowMask" :lockScreen="true" @close="closeMask"></vue_mask>
    </div>
</template>

<script>
    import vue_mask from '../components/mask';

    export default {
        components: {
            vue_mask
        },
        computed: {
            btnClass: function () {
                return this.isShowMask ? {
                    'z-index': 1002, 'position': 'relative'
                } : {};
            }
        },
        data () {
            const cookieName = 'is_show_price_tip';
            const isShowTip = this.$cookie.get(cookieName) === null;
            const isShowMask = ( ! this.$isMobile) && isShowTip;

            if (isShowTip) {
                this.$cookie.set(cookieName, true, 30);
            }

            return {
                isShowMask: isShowMask,
                tooltip: {
                    'content': '價格追蹤讓您由被動轉為主動，' +
                        '我們會在您喜愛的飯店或是想要旅遊的地區做價格即時的檢查，' +
                        '若是飯店價格低於平均價格一定程度時，' +
                        '我們會即時的透過您提供的管道通知您，' +
                        '讓您能夠在旅遊前訂到最便宜划算的飯店，' +
                        '詳細資訊請參閱我們的追蹤說明。',
                    visible: isShowMask,
                    class: '__price_trace_tooltip'
                }
            }
        },
        methods: {
            closeMask: function () {
                this.tooltip.visible = this.isShowMask = false;
            }
        }
    }
</script>

<style scoped>
    div.__screen_mask {
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

<style>
    .__price_trace_tooltip {
        z-index: 1002;
    }
</style>