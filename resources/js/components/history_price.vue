<template>
    <div class="intro_chart inrto_min">
        <div class="chart_tit">
            <h3 class="title">歷史價格</h3>
            <span>(以每晚價格統計)</span>
        </div>
        <div id="chart"  style="margin-top: 50px"></div>
    </div>
</template>

<script>
    import c3 from 'c3';
    import 'c3/c3.min.css'

    export default {
        mounted() {
            c3.generate({
                data: {
                    columns: [
                        ['均價', 0, 0, 0, 0, 0],
                    ]
                },
                color: {
                    pattern: ['#ee451a']
                }
            });
        }
    }
</script>