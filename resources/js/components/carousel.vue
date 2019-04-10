<template>
    <carousel :data="data" indicator-trigger="hover" :autoplay="true" :interval="2500"></carousel>
</template>

<script>
    export default {
        data() {
            const imgUrl = [
                'https://pix2.agoda.net/hotelimages/agoda-homes/6584501/fa5afcc98691249611041402b4c32665.jpg?s=600x',
                'https://pix6.agoda.net/hotelImages/603/60395/60395_16042612080041805392.jpg?s=600x',
                'https://pix2.agoda.net/hotelimages/agoda-homes/6584501/fa5afcc98691249611041402b4c32665.jpg?s=600x',
                'https://pix1.agoda.net/hotelimages/agoda-homes/6584501/37fcd432676ed4c465c8fdd77f3ef03b.jpg?s=600x',
                'https://pix2.agoda.net/hotelimages/agoda-homes/6578885/0d99bb07d799cf1a1a1e87836be305f5.jpg?s=600x',
                'https://pix2.agoda.net/hotelimages/agoda-homes/6578885/46a6dd9f6ea3929d781935d9ea072643.jpg?s=600x'
            ];

            let carousel = [];

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