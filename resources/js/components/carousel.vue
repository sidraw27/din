<template>
    <VueCarousel :data="data" indicator-trigger="hover" :autoplay="true" :interval="3000"></VueCarousel>
</template>

<script>
    import VueCarousel from '@chenfengyuan/vue-carousel';

    export default {
        props: [
            'imgUrl'
        ],
        components: {
            VueCarousel
        },
        data() {
            let carousel = [];

            const imgUrl = JSON.parse(this.imgUrl);

            _.forEach(imgUrl, (src, index) => {
                carousel[index] = {
                    content(createElement) {
                        return createElement('div', {
                            class: [
                                '__carousel_img',
                                this.$isMobile ? '__carousel_mobile' : ''
                            ],
                        }, [
                            createElement('img', {
                                attrs: {
                                    src: src,
                                }
                            }),
                        ]);
                    }
                }
            });


            return {
                data: carousel
            };
        },
    };
</script>

<style scoped>
    >>> .__carousel_img > img {
        min-width: 550px;
    }
    >>> .__carousel_img {
        height: 420px;
        align-items: center;
        background-color: #646660;
        color: #999;
        display: flex;
        font-size: 1.5rem;
        justify-content: center;
        min-height: 10rem;
    }
    >>> .__carousel_mobile {
        height: 400px;
    }
</style>