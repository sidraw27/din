<template>
    <div class="__screen_mask" v-show="isShowMask" @click="close"></div>
</template>

<script>
    export default {
        props: {
            show: {
                type: Boolean,
                default: false
            },
            lockScreen: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                isShowMask: null
            }
        },
        mounted() {
            this.isShowMask = this.show;
        },
        watch: {
            show: function (value) {
                this.isShowMask = value;
            },
            isShowMask: function (value) {
                const stopScrollClass = 'stop-scrolling';

                if (this.lockScreen) {
                    if (value) {
                        document.body.classList.add(stopScrollClass);
                    } else {
                        document.body.classList.remove(stopScrollClass);
                    }
                }
            }
        },
        methods: {
            close: function () {
                this.isShowMask = false;
                this.$emit('close');
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
    .stop-scrolling {
        height: 100%;
        overflow: hidden;
    }
</style>