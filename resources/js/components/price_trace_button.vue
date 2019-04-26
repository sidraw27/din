<template>
    <div>
        <div class="hotel_follow-btn" >
            <button class="follow-btn">
                <img src="/images/track-border.svg" alt="track">
                <span>價格追蹤</span>
            </button>
        </div>
    </div>
</template>

<script>
    import Driver from 'driver.js';
    import 'driver.js/dist/driver.min.css';

    export default {
        mounted () {
            const cookieName = 'is_show_price_track_tutorial';
            const isShowTip = this.$cookie.get(cookieName) === null;

            if (isShowTip) {
                const driver = new Driver({
                    doneBtnText: '結束教學',
                    closeBtnText: '關閉',
                    opacity: 0.55,
                    nextBtnText: '下一步',
                    prevBtnText: '上一步',
                    onHighlightStarted: () => {
                        this.$scrollLock(true);
                    },
                    onDeselected: () => {
                        this.$scrollLock(false);
                    }
                });
                driver.defineSteps([
                    {
                        element: '.follow-btn',
                        popover: {
                            title: '接收價格警示',
                            description: '價格追蹤讓您由 "主動轉為被動"，<br>' +
                              '我們會在您喜愛的飯店或是想要旅遊的地區做價格 "即時的檢查"，<br>' +
                              '若是飯店價格低於平均價格時，' +
                              '我們會即時的透過您提供的管道通知您，' +
                              '讓您能夠在旅遊前訂到最便宜划算的飯店，' +
                              '搶先登入並讓我們提供您最優先的通知。',
                            position: 'left',
                            offset: 25
                        }
                    },
                    {
                        element: '.signin-btn',
                        popover: {
                            title: '登入',
                            description: '由第三方認證的登入，' +
                              '保證您個人資料的安全性及便利性，' +
                              '登入後便可選擇可通知您的通知管道，' +
                              '並且管理您的訂閱，<br>' +
                              '優先加入享受更多會員功能！',
                            position: 'left',
                            offset: 25
                        }
                    }
                ]);
                driver.start();

                this.$cookie.set(cookieName, true, 30);
            }
        }
    }
</script>

<style>
    .__price_trace_tooltip {
        z-index: 1002;
    }
</style>
