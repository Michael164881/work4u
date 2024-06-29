@extends('freelancer.app', [
    'class' => '',
    'elementActive' => 'map'
])

@section('content')
    <style>
        .hire-container {
            display: flex;
            justify-content: space-between;
            margin: 5%;
        }

        .work-description, .bid-method {
            width: 48%;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .bid-method{
            padding: 10% 5% 10% 5%;
        }

        .bid-method form {
            display: flex;
            flex-direction: column;
        }

        .bid-method form input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .bid-method form button {
            padding: 10px;
            background-color: #7C638F;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .bid-method form button:hover {
            background-color: #218838;
        }

        .bid-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 15%;
        }

        .bid-options button {
            background: #7C638F;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            flex: 1 1 calc(33.333% - 10px);
        }

        .bid-options button:hover {
            background: #9472ad;
        }
        
        #map {
            height: 500px;
            width: 99%;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
    </style>

    <div class="container">
        <div class="hire-container">
            <div class="work-description">
                <h4>{{ $service->job_name }}</h4><br>
                <p><strong>Description:</strong> {{ $service->job_description }}</p>
                <p><strong>Fee:</strong> RM{{ $service->initial_price }}</p>
                <p><strong>Period:</strong> {{ $service->job_period }} days</p>
                <div id="map"></div>
            </div>

            <div class="bid-method">
                <center>
                    <h4>Bid for the Job</h4>
                    <form action="{{ route('bid.process', ['service' => $service->id]) }}" method="POST">
                        @csrf
                        <label for="bid-amount">Enter Your Bid Amount:</label><br><br>
                        <input name="bid_amount" type="text" id="bid-amount-input" placeholder="Enter your bid amount" style="text-align: center;">

                        <div class="bid-options">
                            <button type="button">RM 100</button>
                            <button type="button">RM 200</button>
                            <button type="button">RM 300</button>
                            <button type="button">RM 500</button>
                            <button type="button">RM 1,000</button>
                            <button type="button">RM 5,000</button>
                        </div>
                        
                        <br><button type="submit">Submit Bid</button>
                    </form>
                </center>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your bid has been successfully placed.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    An error occurred while placing your bid. Please try again.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bidAmountInput = document.getElementById('bid-amount-input');
            const bidOptions = document.querySelector('.bid-options');

            bidOptions.addEventListener('click', function(event) {
                if (event.target.tagName === 'BUTTON') {
                    const amount = event.target.textContent.replace(/\D/g, '');
                    bidAmountInput.value = amount;
                }
            });
        });
    </script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe7wj_DF_0i-sP8vkZG-S2NxbuTqH63dI&callback=initMap" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let map, marker, geocoder;

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
                zoom: 15,
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

            // Initialize geocoder
            geocoder = new google.maps.Geocoder();

            // Geocode the old address and place the marker
            const oldAddress = document.getElementById('jobAddressInput').value;
            if (oldAddress) {
                geocodeAddress(oldAddress);
            } else {
                console.error('No old address provided.');
            }
        }

        function disablePOIInfoWindow() {
            var fnSet = google.maps.InfoWindow.prototype.set;
            google.maps.InfoWindow.prototype.set = function () {
                if (this.get('isCustomInfoWindow'))
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
            geocoder.geocode({ 'address': address }, function (results, status) {
                if (status === 'OK') {
                    placeMarker(results[0].geometry.location);
                    displayAddress(results[0].formatted_address);
                } else {
                    console.error('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

        // Function to display address in address box
        function displayAddress(address) {
            document.getElementById('jobAddressDisplay').innerText = address;
            document.getElementById('jobAddressInput').value = address;
        }

        function handleLocationError(browserHasGeolocation, pos) {
            console.error(browserHasGeolocation
                ? "Error: The Geolocation service failed."
                : "Error: Your browser doesn't support geolocation.");
        }

        $(document).ready(function () {
            initMap();
        });
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
