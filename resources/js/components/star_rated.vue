<template>
    <span class="star" v-tooltip.right="introduction">
        <img src='/images/star.svg' alt='starRated' v-for="rate in total">
    </span>
</template>

<script>
    export default {
        props: [
            'starRated'
        ],
        data() {
            return {
                total: parseInt(this.starRated),
                introduction: '飯店星級由夥伴資料取得，可供您作為飯店建築、裝飾、設施設備及管理、服務水準等參考。'
            }
        }
    }
</script>

<style scoped>
    span.star {
        line-height: 30px;
    }
    .star > img {
        width: 20px !important;
    }
</style>