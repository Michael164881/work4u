@php
    use Illuminate\Support\Str;
@endphp

@extends('freelancer.app', [
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
        }

        .service-description p{
            color: white;
        }

        .service-description h4{
            color: white;
        }

        .service-description h5{
            font-size: 30px;
            font-weight: bold;
            color: white;
        }

        .map-container {
            width: 100%;
            height: 500px;
            margin-bottom: 20px;
        }

        .map {
            height: 100%; /* Make map fill its container */
            width: 100%; /* Ensure map fills its container */
        }
    </style>

    <div class="content">
        <div class="row">
            <h2>SERVICE DETAILS</h2>
            <div class="col-md-12">
                <div class="service-detail-container">
                    <div class="service-card freelancer-profile">
                        <h4>Freelancer Profile</h4>
                        <p><strong>Name:</strong> {{ $service->user->name }}</p>
                        <p><strong>Location:</strong> {{ $service->user->location }}</p>
                        <p><strong>Email:</strong> {{ $service->user->email }}</p>
                        <p><strong>Phone Number:</strong> {{ $service->user->phone_number }}</p>
                    </div>
                    <div class="service-card service-description">
                        <center>
                            <h4>{{ $service->job_name }}</h4>
                            <p>{{ $service->job_description }}</p>
                            <h5><strong>Fee:</strong> RM{{ $service->initial_price }}</h5>
                            <h5><strong>Period:</strong> {{ $service->job_period }} days</h5>
                            <a href="#" class="hire-now-btn">HIRE NOW</a>
                        </center>
                    </div>
                </div>
                <div class="map-container">
                    <div id="map" class="map" style="height: 100%;></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        .marker-label {
            color: white !important;
            background-color: #7C638F;
            padding: 1px 1px;
            border-radius: 5px;
            font-size: 8px;
            white-space: nowrap;
            position: absolute;
            transform: translate(10px, -50%);
        }
    </style>

    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script> <!-- Replace YOUR_API_KEY -->

    <script>

        function geocode(location, title, description, fee, period, id) {
            axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
                params: {
                    address: location,
                    key: 'YOUR_API_KEY', // Replace with your Google Maps API key
                }
            })
            .then(function(response) {
                var latitude = response.data.results[0].geometry.location.lat;
                var longitude = response.data.results[0].geometry.location.lng;

                var marker = new google.maps.Marker({
                    position: { lat: latitude, lng: longitude },
                    map: map,
                    title: title,
                    label: {
                        text: title,
                        className: 'marker-label'
                    }
                });

                var contentString = '<div class="info-window" onclick="window.location=\'/serviceFL/' + id + '\'">' +
                                '<h2><strong>Job Request</strong></h2>' +
                                '<p>' + title + '</p>' +
                                '<p>' + description + '</p>' +
                                '<p>RM' + fee + '</p>' +
                                '<p>' + period + ' Days</p>' +
                                '</div>';

                var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });
            })
            .catch(function(error) {
                console.log(error);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            initMap();
            var address = "{{ $service->job_address }}";
            var title = "{{ $service->job_name }}";
            var description = "{{ Str::limit($service->job_description, 50) }}";
            var fee = "{{ $service->initial_price }}";
            var period = "{{ $service->job_period }}";
            var id = "{{ $service->id }}";
            geocode(address, title, description, fee, period, id);
        });
    </script>
@endpush
