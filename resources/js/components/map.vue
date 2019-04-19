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

                const map = new L.map('g_map', {
                    center: [geo.lat, geo.lng],
                    zoom: 15
                });

                const layer = new L.TileLayer(
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    {
                        minZoom: 6,
                        maxZoom: 17,
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }
                );

                map.addLayer(layer);


                const Icon = L.icon({
                    iconUrl: '../images/vendor/leaflet/dist/marker-icon.png',
                });
                const marker = new L.marker([geo.lat, geo.lng], {
                    icon: Icon
                });

                marker.addTo(map);
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