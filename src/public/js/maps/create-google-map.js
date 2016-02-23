/**
 * Script to create a google map for each flyer.
 */


function initAutocomplete() {

    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 13.8688,
            lng: 5.2195
        },
        zoom: 2,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var marker = new google.maps.Marker({
        position: {
            lat: 38.8688,
            lng: -39.2195
        },
        map: map,
        animation: google.maps.Animation.DROP,
        draggable: true
    });


    var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));

    google.maps.event.addListener(searchBox, 'places_changed', function() {
        var places = searchBox.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i, place;

        for (i=0; place=places[i]; i++) {
            bounds.extend(place.geometry.location);
            marker.setPosition(place.geometry.location);
        }

        map.fitBounds(bounds);
        map.setZoom(12);

    });

    google.maps.event.addListener(marker, 'position_changed', function() {
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();

        $('#lat').val(lat);
        $('#lng').val(lng);
    });


}
//# sourceMappingURL=create-google-map.js.map
