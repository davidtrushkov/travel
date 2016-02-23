@extends('app')


@section('content')

    <div class="container-fluid" id="Home-Container">

        <div class="col-md-12" id="Home-Icon-col-md-12">
            <div class="col-xs-12 col-md-4" id="Home-Icon-4">
                <div id="Home-Icon-Div">
                    <i class="huge blue circular marker icon"></i><br><br>
                    <p>Share Your Travel Experiences</p>
                </div>
            </div>
            <div class="col-xs-12 col-md-4" id="Home-Icon-4">
                <div id="Home-Icon-Div">
                    <i class="huge green circular users icon"></i><br><br>
                    <p>Connect with other users</p>
                </div>
            </div>
            <div class="col-xs-12 col-md-4" id="Home-Icon-4">
                <div id="Home-Icon-Div">
                    <i class="huge blue circular world icon"></i><br><br>
                    <p>Discover new places</p>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid" id="Home-Container">

        <div class="col-md-12" style="padding: 0;">
            <div id="map_home"></div>
            <br><br>
        </div>

    </div>


@stop

@section('scripts.footer')
    <script>

            jQuery(function($) {
                // Asynchronously Load the map API
                var script = document.createElement('script');
                script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyBaB_9hgeARViVKIT6O1pFKXRCSuYaol2A&libraries=places&callback=initAutocomplete";
                document.body.appendChild(script);
            });

            function initAutocomplete() {

                var map;
                var bounds = new google.maps.LatLngBounds();
                var mapOptions = {
                    mapTypeId:google.maps.MapTypeId.TERRAIN,
                    scrollwheel: false,
                    styles: [{
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    }, {
                        "featureType": "administrative.country",
                        "elementType": "geometry.stroke",
                        "stylers": [{
                            "visibility": "on"
                        }]
                    }, {
                        "featureType": "administrative.province",
                        "elementType": "geometry.stroke",
                        "stylers": [{
                            "visibility": "on"
                        }]
                    }, {
                        "featureType": "administrative.locality",
                        "elementType": "geometry.stroke",
                        "stylers": [{
                            "visibility": "on"
                        }]
                    }, {
                        "featureType": "administrative.neighborhood",
                        "elementType": "geometry.stroke",
                        "stylers": [{
                            "visibility": "on"
                        }]
                    }, {
                        "featureType": "administrative.land_parcel",
                        "elementType": "geometry.stroke",
                        "stylers": [{
                            "visibility": "on"
                        }]
                    }]
                };

                // Display a map on the page
                map = new google.maps.Map(document.getElementById("map_home"), mapOptions);
                map.setTilt(45);

                // Multiple Markers
                var markers = [
                    @foreach($flyer as $flyers)
                        ['', {{ $flyers->lat }}, {{ $flyers->lng }} ],
                    @endforeach

                ];

                var infoWindowContent = [
                    @foreach($flyer as $flyers)
                    [
                        '<div class="info_content">' +
                            '<a href="{{ $flyers->title }}">' +
                                '<img class="ui top aligned small image" src="/travel/{{ $flyers->thumbnail_path }}" alt="Test">' +
                                '<h5 id="GoogleMaps-Content-Title">{{ $flyers->title }}</h5>' +
                            '</a>' +
                        '</div>'
                    ],
                    @endforeach
                ];

                            // Display multiple markers on a map
                var infoWindow = new google.maps.InfoWindow(), marker, i;

                var image = '/travel/src/public/css/icon.png';

                // Loop through our array of markers & place each one on the map
                for( i = 0; i < markers.length; i++ ) {
                    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                    bounds.extend(position);
                    marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: markers[i][0],
                        animation: google.maps.Animation.DROP,
                        icon: image
                    });

                    // Allow each marker to have an info window
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infoWindow.setContent(infoWindowContent[i][0]);
                            infoWindow.open(map, marker);
                        }
                    })(marker, i));

                    // Automatically center the map fitting all markers on the screen
                    map.fitBounds(bounds);
                }

                // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
                var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                    this.setZoom(3);
                    google.maps.event.removeListener(boundsListener);
                });

            }
    </script>

@stop
