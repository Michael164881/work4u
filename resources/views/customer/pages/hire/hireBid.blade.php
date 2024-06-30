@extends('customer.app', [
    'class' => '',
    'elementActive' => 'map'
])

@section('content')
<style>
        h2{
            font-size: 30px;
            font-weight: bold;
            margin-left: 2%;
        }

        .service-detail-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 0 0 0 5%;
        }

        .service-card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            width: 48%;
            box-sizing: border-box;
        }

        .freelancer-profile{
            width: 30%;
            padding-top: 5%;
        }

        .service-card h4 {
            margin-top: 0;
            color: #333;
        }

        .service-card p {
            color: #666;
        }

        .hire-now-btn {
            display: block;
            margin: 20px auto;
            margin-top: 5%;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            width: 40%;
            color: white;
            background-color: #f1d05c;
            padding: 5px;
            border-radius: 15px;
        }

        .hire-now-btn:hover {
            color: #7C638F; 
            text-decoration: none;
        }

        .service-description{
            background-color: #7C638F;
            color: white;
            width: 65%;
        }

        .desc-img{
            width: 40%;
            height: 40%;
            margin-bottom: 5%;
            border-radius: 25px;
        }

        .service-description p{
            color: white;
        }

        .service-description h4{
            color: white;
            font-size: 50px;
        }

        .service-description h5{
            font-size: 30px;
            font-weight: bold;
            color: white;
        }

        #map {
            height: 500px;
            width: 99%;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .avatar{
            margin: 5% 0 5% 0;
            width: 30%;
            height: 5%;
            border-radius: 25px;
        }

        .ratings {
            margin-top: 20px;
            text-align: center;
        }

        .star {
            color: #FFD700; /* gold color for stars */
            font-size: 20px;
        }
    </style>

<div class="content">
    <div class="row">
        <div class="col-md-12">
                <div class="service-detail-container">
                    <div class="service-card freelancer-profile">
                        <center>
                            <h4>Freelancer Profile</h4>
                                @if($bid->freelancerProfile->user->profile_picture)
                                    <img class="avatar border-gray" src="{{ asset($bid->freelancerProfile->user->profile_picture) }}" alt="...">
                                @else
                                    <img class="avatar border-gray" src="{{ asset('paper/img/mike.jpg') }}" alt="...">
                                @endif
                            <p><strong>Nickname:</strong> {{ $bid->freelancerProfile->nickname }}</p>
                            <p><strong>Name:</strong> {{ $bid->freelancerProfile->user->name }}</p>
                            <p><strong>Location:</strong> {{ $bid->freelancerProfile->location }}</p>
                            <p><strong>Work Experience:</strong> {{ $bid->freelancerProfile->work_experience }}</p>
                            <p><strong>Educational Qualification:</strong> {{ $bid->freelancerProfile->edu_quality }}</p>
                            <p><strong>Email:</strong> {{ $bid->freelancerProfile->user->email }}</p>
                            <p><strong>Phone Number:</strong> {{ $bid->freelancerProfile->user->phone_number }}</p>
                            <div class="ratings"><br><br>
                                <h5>Ratings:</h5>
                                @php
                                    $averageRating =  $bid->freelancerProfile->average_rating;
                                    $ratingCount =  $bid->freelancerProfile->rating_count;
                                @endphp
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $averageRating)
                                            <span class="star">&#9733;</span>
                                        @else
                                            <span class="star">&#9734;</span>
                                        @endif
                                    @endfor
                                </div>
                                <p>{{ $averageRating }} out of 5 stars ({{ $ratingCount }} reviews)</p>
                            </div>
                        </center>
                    </div>
                    <div class="service-card service-description">
                        <center>
                            @if($bid->jobRequest->job_image)
                                <img  src="{{ asset($bid->jobRequest->job_image) }}" alt="..."  class="desc-img">
                            @else
                                <img class="avatar border-gray" src="{{ asset('images/work_description_pictures/default.png') }}" alt="...">
                            @endif
                            <h4><strong>{{ $bid->jobRequest->job_name }}</strong></h4>
                            <p>{{ $bid->jobRequest->job_description }}</p>
                            <h5><strong>Fee:</strong> RM{{ $bid->bid_amount }}</h5>
                            <h5><strong>Period:</strong> {{ $bid->jobRequest->job_period }} days</h5>
                            <a href="{{ route('hireBid.show', ['bid' => $bid->id]) }}" class="hire-now-btn">HIRE NOW</a>
                        </center>
                    </div>
                </div>
                <input name="jobAddress" id="jobAddressInput" type="hidden" value="{{ $jobRequest->work_address }}">
                <div id="jobAddressDisplay">{{ $jobRequest->work_address }}</div>
                <div id="map"></div>
        </div>
    </div>
</div>

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
