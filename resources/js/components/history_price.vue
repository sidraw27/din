<template>
    <div class="intro_chart inrto_min">
        <div class="chart_tit">
            <h3 class="title">歷史價格</h3>
            <!--<span>(以每晚價格統計)</span>-->
        </div>
        <ve-histogram :data="chartData" :settings="chartSettings"></ve-histogram>
    </div>
</template>

<script>
    import VeHistogram from 'v-charts/lib/histogram.common'

    export default {
        components: {
            VeHistogram
        },
        data: function () {
            this.chartSettings = {
                axisSite: {
                    right: [
                        '價格比率'
                    ]
                },
                yAxisType: ['normal', 'percent'],
            };

            return {
                chartData: {
                    columns: ['日期', '歷史均價', '地區飯店房間平均價格', '價格比率'],
                    rows: [
                        {'日期': '2018/11', '歷史均價': 0, '地區飯店房間平均價格': 0, '價格比率': 0},
                        {'日期': '2018/12', '歷史均價': 0, '地區飯店房間平均價格': 0, '價格比率': 0},
                        {'日期': '2019/01', '歷史均價': 0, '地區飯店房間平均價格': 0, '價格比率': 0},
                        {'日期': '2019/02', '歷史均價': 0, '地區飯店房間平均價格': 0, '價格比率': 0},
                        {'日期': '2019/03', '歷史均價': 0, '地區飯店房間平均價格': 0, '價格比率': 0},
                        {'日期': '2019/04', '歷史均價': 0, '地區飯店房間平均價格': 0, '價格比率': 0}
                    ]
                }
            }
        }
    }
</script>