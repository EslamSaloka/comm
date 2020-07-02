
<section class="map-section">
    <div class="container">
        <div class="map contact-map">

        </div>
    </div>
</section>
@push('scripts')
<script 
    type="text/javascript" 
    src="https://maps.googleapis.com/maps/api/js?region=SA&callback=initMap&language={{App::getLocale()}}&key=AIzaSyA9UeezZ2xyNjrwck8SLdh9NxsJp6HhLQc&libraries=places">
</script>
<script>
    function initialize() {
    var mapOptions = {
        zoom: 11,
        center: new google.maps.LatLng({{ WebSettingGet('latitude') }}, {{ WebSettingGet('longitude') }})
    };
    var map = new google.maps.Map($('.map')[0], mapOptions);
    var infowindow = new google.maps.InfoWindow({
    content: "{{ WebSettingGet('address_'.App::getLocale()) }}"
    });
    var marker = new google.maps.Marker({
    position: map.getCenter(),
            icon: "{{ asset('assets/front/images/marker.png') }}",
            map: map
    });
    google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map, marker);
    });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endpush