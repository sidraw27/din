<template>
    <span class="star">
        <img src='images/star.svg' alt='starRated' v-for="rate in total">
    </span>
</template>

<script>
    export default {
        props: [
            'starRated'
        ],
        data() {
            return {
                total: parseInt(this.starRated)
            }
        }
    }
</script>