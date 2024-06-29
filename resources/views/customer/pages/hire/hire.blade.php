@extends('customer.app', [
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

        .work-description, .payment-method {
            width: 48%;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .payment-method form {
            display: flex;
            flex-direction: column;
        }

        .payment-method form input, .payment-method form select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .payment-method form button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-method form button:hover {
            background-color: #218838;
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
                <h4>{{ $service->work_description_name }}</h4><br>
                <p><strong>Description:</strong> {{ $service->work_description }}</p>
                <p><strong>Fee:</strong> RM{{ $service->work_fee }}</p>
                <p><strong>Period:</strong> {{ $service->work_period }} days</p>
                <input name="jobAddress" id="jobAddressInput" type="hidden" value="{{ $address->work_address }}">
                <div id="jobAddressDisplay">{{ $address->work_address }}</div>
                <div id="map"></div>
            </div>

            <div class="payment-method">
                <h4>Payment Method</h4>
                
                <form action="{{ route('hire.process', ['service' => $service->id])}}" method="POST">
                    @csrf
                    <input type="hidden" name="freelancer" value="{{ $freelancer->id }}">
                    <label for="payment-method">Choose Payment Method:</label>
                    <select id="payment-method" name="payment_method" required>
                        <option value="">Select Payment Method</option>
                        <option value="debit_card">Debit Card</option>
                        <option value="ewallet">eWallet</option>
                        <option value="qr_code">QR Code</option>
                    </select>

                    <div id="debit-card-fields" style="display: none;">
                        <input type="text" name="card_number" placeholder="Card Number" required>
                        <input type="text" name="card_name" placeholder="Card Name" required>
                        <input type="text" name="expiry_date" placeholder="Expiry Date" required>
                        <input type="text" name="cvv" placeholder="CVV" required>
                    </div>

                    <div id="ewallet-fields" style="display: none;">
                        <br><br><br><p>Pay using your eWallet</p>
                        <center><h3><strong>Your Balance:</strong> RM{{ $user->ewallet_balance }}</h3></center>
                    </div>

                    <div id="qr-code-fields" style="display: none;">
                        <p>Scan the QR code to pay:</p>
                        <img src="{{ asset('images/QR_Code.png') }}" alt="QR Code">
                    </div>

                    <button type="submit" style="background-color: #7C638F;">Pay Now</button>
                </form>
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
                        Payment successful. Booking created.
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
                    Insufficient balance in eWallet.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('payment-method').addEventListener('change', function () {
            var debitCardFields = document.getElementById('debit-card-fields');
            var ewalletFields = document.getElementById('ewallet-fields');
            var qrCodeFields = document.getElementById('qr-code-fields');

            debitCardFields.style.display = 'none';
            ewalletFields.style.display = 'none';
            qrCodeFields.style.display = 'none';

            if (this.value === 'debit_card') {
                debitCardFields.style.display = 'block';
                document.getElementsByName('card_number')[0].setAttribute('required', 'true');
                document.getElementsByName('card_name')[0].setAttribute('required', 'true');
                document.getElementsByName('expiry_date')[0].setAttribute('required', 'true');
                document.getElementsByName('cvv')[0].setAttribute('required', 'true');
            } else if (this.value === 'ewallet') {
                ewalletFields.style.display = 'block';
                document.getElementsByName('card_number')[0].removeAttribute('required');
                document.getElementsByName('card_name')[0].removeAttribute('required');
                document.getElementsByName('expiry_date')[0].removeAttribute('required');
                document.getElementsByName('cvv')[0].removeAttribute('required');
            } else if (this.value === 'qr_code') {
                qrCodeFields.style.display = 'block';
                document.getElementsByName('card_number')[0].removeAttribute('required');
                document.getElementsByName('card_name')[0].removeAttribute('required');
                document.getElementsByName('expiry_date')[0].removeAttribute('required');
                document.getElementsByName('cvv')[0].removeAttribute('required');
            }
        });

        @if(session('success'))
            $('#successModal').modal('show');
        @elseif(session('error'))
            $('#errorModal').modal('show');
        @endif
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
