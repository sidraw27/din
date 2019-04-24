<template>
    <div id="adgshp-1925779977"></div>
</template>

<script>
    export default {
        mounted() {
            const agodaScript = document.createElement('script');
            agodaScript.setAttribute('src', '//cdn0.agoda.net/images/sherpa/js/init-dynamic_v8.min.js');
            document.head.appendChild(agodaScript);

            const stg = {
                crt: "95818713297218",
                version: "1.05",
                id: "adgshp-1925779977",
                name: "adgshp-1925779977",
                Width: "300px",
                Height: "600px",
                RefKey: "ADyTs+9LyZMUZuHTThyUgA==",
                AutoScrollSpeed: 3000,
                AutoScrollToggle: true,
                SearchboxShow: false,
                DiscountedOnly: false,
                Layout: "talldynamic",
                Language: "zh-tw",
                ApiKey: "f2ddf155-1f30-476b-a82b-6af9df87f79a",
                Cid: "1818998",
                City: "5085",
                Currency: "TWD",
                OverideConf: false
            };

            const interval = setInterval(() => {
                if (typeof AgdDynamic === 'function') {
                    new AgdDynamic('adgshp-1925779977').initialize(stg);
                    clearInterval(interval);
                }
            }, 500);
        }
    }
</script>