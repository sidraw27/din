<template>
    <carousel :data="data" indicator-trigger="hover" :autoplay="true" :interval="2500"></carousel>
</template>

<script>
    export default {
        props: [
            'imgUrl'
        ],
        data() {
            let carousel = [];

            const imgUrl = JSON.parse(this.imgUrl);

            _.forEach(imgUrl, (src, index) => {
                carousel[index] = {
                    content(createElement) {
                        return createElement('div', {
                            class: '__carousel_img',
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

<style>
    .__carousel_img {
        height: 420px;
        align-items: center;
        background-color: #646660;
        color: #999;
        display: flex;
        font-size: 1.5rem;
        justify-content: center;
        min-height: 10rem;
    }
</style>