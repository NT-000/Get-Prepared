@props(['job', 'coordinates'])

<link href="https://api.mapbox.com/mapbox-gl-js/v3.5.1/mapbox-gl.css" rel="stylesheet">

<div id="map" class="w-56 h-80 p-4 mt-4 rounded"></div>

<script src="https://api.mapbox.com/mapbox-gl-js/v3.5.1/mapbox-gl.js"></script>

<script>
    mapboxgl.accessToken = '{{ env('MAPBOX_API_KEY') }}';

    const city = '{{ $job->city }}';
    const country = '{{ $job->country }}';
    const coordinates = @json($coordinates); // from controller

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: coordinates,
        zoom: 12
    });

    map.addControl(new mapboxgl.NavigationControl());

    new mapboxgl.Marker()
        .setLngLat(coordinates)
        .setPopup(new mapboxgl.Popup().setHTML(`<h3>${city}, ${country}</h3>`))
        .addTo(map);
</script>
