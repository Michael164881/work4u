@extends('freelancer.app', [
    'class' => '',
    'elementActive' => 'map'
])

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe7wj_DF_0i-sP8vkZG-S2NxbuTqH63dI&libraries=places&callback=initMap" async defer></script>
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 15px;
            background-color: #f8f9fa;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: vertical;
            height: 150px;
        }

        .form-group button {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
        #map {
            height: 500px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        #addressInput {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #jobAddress {
            margin-top: 10px;
            padding: 10px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
        }
    </style>

    <div class="content">
        <div class="form-container">
            <div class="form-header">
                <h2>Create New Work Description</h2>
            </div>
            <form action="{{ route('workDescription.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="job_name">Work Name</label>
                    <input type="text" id="job_name" name="job_name" value="{{ old('job_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="job_description">Work Description</label>
                    <textarea id="job_description" name="job_description" required>{{ old('job_description') }}</textarea>
                </div>

                <div class="form-group">
                <label class="col-md-3 col-form-label">{{ __('Job Image') }}</label>
                    <div class="custom-file">
                        <input type="file" name="job_image" class="custom-file-input" id="jobImage" accept="image/*">
                        <label class="custom-file-label" for="jobImage">{{ __('Choose file') }}</label>
                    </div>
                </div>
                @if ($errors->has('job_image'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('job_image') }}</strong>
                    </span>
                @endif

                <div class="form-group">
                    <!-- Hidden input field for job address -->
                    <input name="jobAddress" id="jobAddressInput" type="hidden" value="{{ old('jobAddress') }}" required>
                    <!-- Visible div to display job address -->
                    <div id="jobAddressDisplay">Address will appear here</div>
                    <!-- Map container -->
                    <div id="map"></div>
                </div>
                <div class="form-group">
                    <label for="job_period">Work Period (days)</label>
                    <input type="number" id="job_period" name="job_period" value="{{ old('job_period') }}" required>
                </div>
                <div class="form-group">
                    <label for="initial_price">Work Fee (RM)</label>
                    <input type="number" id="initial_price" name="initial_price" step="0.01" value="{{ old('initial_price') }}" required>
                </div>
                <div class="form-group">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
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
                zoom: 10,
                center: centerSelangor,
                disableDefaultUI: true,
                scrollwheel: false,
                disableDoubleClickZoom: true,
                zoomControl: true,
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
                timeout: 50000,

                // Center and zoom the map on the user's location
                map.setCenter(pos);
                map.setZoom(13); // Adjust the zoom level as desired
                },
                () => {
                handleLocationError(true, map.getCenter());
                }
            );
            } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, map.getCenter());
            }

            // Initialize geocoder
            geocoder = new google.maps.Geocoder();

            // Initialize autocomplete for address input
            autocomplete = new google.maps.places.Autocomplete(document.getElementById('addressInput'));
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

            // Map click event to place marker
            map.addListener('click', function(event) {
                placeMarker(event.latLng);
                geocodeLatLng(event.latLng);
            });
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
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
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
    </script>


@endsection
