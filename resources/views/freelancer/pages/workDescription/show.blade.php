@extends('freelancer.app', [
    'class' => '',
    'elementActive' => 'map'
])

@section('content')
<script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe7wj_DF_0i-sP8vkZG-S2NxbuTqH63dI&libraries=places&callback=initMap" async defer></script>
    <style>
        .job-details-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 15px;
            background-color: #f8f9fa;
        }

        .job-details-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .job-details {
            margin-bottom: 20px;
        }

        .job-details label {
            font-weight: bold;
        }

        .form-group label {
            font-weight: bold;
        }

        .for label {
            font-weight: bold;
        }

        .job-details p {
            margin: 5px 0 15px;
        }

        .delete-job-btn {
            display: block;
            width: 40%;
            text-align: center;
            padding: 10px;
            background-color: #D74646;;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .edit-job-btn {
            display: block;
            width: 40%;
            text-align: center;
            padding: 10px;
            background-color: #f1d05c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .edit-job-btn:hover,  .delete-job-btn:hover{
            color: #7C638F;
            text-decoration: none;
            font-weight: bolder;
        }

        #map {
            height: 500px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
    </style>

    <div class="content">
        <center>
            <div class="job-details-container">
                <div class="job-details-header">
                    <h2>{{ $workDescription->work_description_name }}</h2>
                </div>
                @if($workDescription->work_description_image)
                    <img class="avatar border-gray" src="{{ asset($workDescription->work_description_image) }}" alt="...">
                @else
                    <img class="avatar border-gray" src="{{ asset('images/work_description_pictures/default.png') }}" alt="...">
                @endif
                <div class="job-details">
                    <label>Work Description:</label>
                    <p>{{ $workDescription->work_description }}</p>
                </div>
                <div class="form-group">
                    <label>Job Address:</label>
                    <!-- Hidden input field for job address -->
                    <input name="jobAddress" id="jobAddressInput" type="hidden" value="{{ $workDescription->work_address }}">
                    <!-- Visible div to display job address -->
                    <div id="jobAddressDisplay">{{ $workDescription->work_address }}</div>
                    <!-- Map container -->
                    <div id="map"></div>
                </div>
                <div class="job-details">
                    <label>Work Period:</label>
                    <p>{{ $workDescription->work_period }} days</p>
                </div>
                <div class="job-details">
                    <label>Work Fee:</label>
                    <p>RM{{ $workDescription->work_fee }}</p>
                </div>
                    <a href="{{ route('workDescription.edit', $workDescription->id) }}" class="edit-job-btn">Edit Job Request</a><br>
                    <form action="{{ route('workDescription.destroy', $workDescription->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job request?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-job-btn">Delete Job Request</button>
                    </form>
            </div>
        </center>
        
    </div>
    <script>
        let map, marker, geocoder, autocomplete;

        function initMap() {
            // Define bounds for Selangor
            const selangorBounds = {
                north: 3.2750,
                south: 2.9500,
                west: 101.3750,
                east: 101.8003,
            };
            
            // Calculate the center of Selangor
            const centerSelangor = {
                lat: (selangorBounds.north + selangorBounds.south) / 2,
                lng: (selangorBounds.east + selangorBounds.west) / 2,
            };

            // Initialize the map
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 20,
                center: centerSelangor,
                disableDefaultUI: true,
                scrollwheel: false,
                disableDoubleClickZoom: true,
                zoomControl: true,
                draggable: false,
                // Apply custom styles
                styles: [
                    {
                        "featureType": "poi",
                        "elementType": "labels",
                        "stylers": [
                            { "visibility": "on" }
                        ]
                    },
                ],

                restriction: {
                    latLngBounds: selangorBounds,
                    strictBounds: true,
                }
            });

            disablePOIInfoWindow();

            // Try HTML5 geolocation to get the user's location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        // Center and zoom the map on the user's location
                        map.setCenter(pos);
                        map.setZoom(15); // Adjust the zoom level as desired
                    },
                    () => {
                        handleLocationError(true, map.getCenter());
                    },
                    { timeout: 50000 }
                );
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, map.getCenter());
            }

            // Initialize geocoder
            geocoder = new google.maps.Geocoder();

            // Initialize autocomplete for address input
            autocomplete = new google.maps.places.Autocomplete(document.getElementById('jobAddressDisplay'));
            autocomplete.bindTo('bounds', map);

            // Autocomplete place changed event
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }

                placeMarker(place.geometry.location);
                displayAddress(place.formatted_address);
            });

            // Geocode the old address and place the marker
            const oldAddress = document.getElementById('jobAddressInput').value;
            if (oldAddress) {
                geocodeAddress(oldAddress);
            }
        }

        function disablePOIInfoWindow(){
            var fnSet = google.maps.InfoWindow.prototype.set;
            google.maps.InfoWindow.prototype.set = function () {
                if(this.get('isCustomInfoWindow'))
                fnSet.apply(this, arguments);
            };
        }

        // Function to place or move marker
        function placeMarker(location) {
            if (!marker) {
                marker = new google.maps.Marker({
                    position: location,
                    map: map,
                });
            } else {
                marker.setPosition(location);
            }
            map.setCenter(location);
        }

        // Function to geocode address
        function geocodeAddress(address) {
            geocoder.geocode({ 'address': address }, function(results, status) {
                if (status === 'OK') {
                    placeMarker(results[0].geometry.location);
                    displayAddress(results[0].formatted_address);
                } else {
                    console.log('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

        // Function to geocode latitude and longitude to address
        function geocodeLatLng(latlng) {
            geocoder.geocode({ location: latlng }, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        displayAddress(results[0].formatted_address);
                    } else {
                        displayAddress('No results found');
                    }
                } else {
                    displayAddress('Geocoder failed due to: ' + status);
                }
            });
        }

        // Function to display address in address box
        function displayAddress(address) {
            document.getElementById('jobAddressDisplay').innerText = address;
            document.getElementById('jobAddressInput').value = address;
        }

        function handleLocationError(browserHasGeolocation, pos) {
            console.log(browserHasGeolocation
                ? "Error: The Geolocation service failed."
                : "Error: Your browser doesn't support geolocation.");
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
        });
    </script>
@endsection
