<template>
    <div class="map-localtion">
        <div id="g_map" class="information-mapimg">
        </div>
    </div>
</template>

<script>
    import 'leaflet/dist/leaflet.css';
    import 'leaflet/dist/leaflet.js';

    export default {
        props: [
            'longitude', 'latitude'
        ],
        mounted: function () {
            this.initMap();
        },
        methods: {
            initMap: function () {
                const geo = {
                    lat: this.latitude,
                    lng: this.longitude
                };

                const map = L.map('g_map').setView([geo.lat, geo.lng], 15);

                new L.TileLayer(
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    {
                        minZoom: 6,
                        maxZoom: 17,
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }
                ).addTo(map);

                L.marker([geo.lat, geo.lng]).addTo(map);
            }
        }
    }
</script>

<style scoped>
    .map-localtion {
        z-index: 1;
    }
    #g_map {
        height: 100%;
    }
</style>