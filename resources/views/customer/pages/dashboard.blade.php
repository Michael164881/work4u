@extends('customer.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

<style>
    h2{
        font-weight: bolder;
        font-size: 10px;
    }
    .info-window {
        cursor: pointer;
        transition: .5s;
    }
    .info-window:hover {
        font-size:15px;
        transition: .5s;
        color: #7C638F;
        font-weight: bolder;
    }
    .map {
        height: 100%; /* Make map fill its container */
        width: 100%; /* Ensure map fills its container */
    }

    .card-body {
        height: 70vh; /* Adjust height as needed */
        padding: 0; /* Remove padding to maximize available space */
    }
</style>

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">HIRE FREELANCER</h5>
                        <p class="card-category">SELANGOR</p>
                            <div class="d-flex justify-content-center align-items-center">
                                <strong><label class="mr-2 mb-0" style="font-size:25px;color: #7C638F;">Area:</label></strong>
                                <select id="citySelect" onchange="updateMap()" class="form-control mr-2">
                                    <option value="">Select Area</option>
                                    <option value="shahalam">Shah Alam</option>
                                    <option value="subangjava">Subang Jaya</option>
                                    <option value="klang">Klang</option>
                                    <option value="petalingjaya">Petaling Jaya</option>
                                    <option value="ampangjava">Ampang Jaya</option>
                                    <option value="batucaves">Batu Caves</option>
                                    <option value="puchong">Puchong</option>
                                    <option value="serikembangan">Seri Kembangan</option>
                                    <option value="kualalumpur">Kuala Lumpur</option>
                                </select>
                            </div>
                    </div>
                    <div class="card-body ">
                        <div id="map" class="map" style="height: 100%;"></div>
                    </div>
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
            padding: 15px ;
            border-radius: 5px;
            font-size: 25px;
            white-space: nowrap;
            position: absolute;
            transform: translate(-50%, 50%);
            transition: .5s;
        }

        
    </style>

    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>

    <script>

        function geocode(location, title, description, fee, period, id, role){
            axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
                params:{
                    address: location,
                    key:'AIzaSyAvktvZMwSDAGbmqg4hIIMug8ApH-L4bzU',
                }
            })
            .then(function(response){
                //Log full response
                console.log(response);

                //Geomerty
                var latitude = response.data.results[0].geometry.location.lat;
                var longitude = response.data.results[0].geometry.location.lng;

                var marker = new google.maps.Marker({
                    position: {lat: latitude, lng: longitude},
                    map: map,
                    title: title,
                    animation: google.maps.Animation.DROP,
                    label: {
                        text: title,
                        className: 'marker-label'
                    }
                    
                });

                //To be used inside infoWindow
                if(role == "freelancer"){
                    var contentString = '<div class="info-window" onclick="window.location=\'/service/' + id + '\'">' +
                        '<h2><strong>' + title + '</strong></h2>' +
                        '<p>' + description + '</p>' +
                        '<p>RM' + fee + '</p>' +
                        '<p>' + period + ' Days</p>' +
                        '</div>';

                    // Create a pop up box
                    var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    // Add click event listener to the marker
                    marker.addListener('click', function() {
                        infoWindow.open(map, marker);
                    });
                }

                // Add custom label
                var labelDiv = document.createElement('div');
                labelDiv.className = 'marker-label';

                // Position the label
                var overlay = new google.maps.OverlayView();
                overlay.onAdd = function() {
                    var layer = this.getPanes().overlayLayer;
                    layer.appendChild(labelDiv);
                };

                // Update label position on marker position change
                marker.addListener('position_changed', function() {
                    var position = overlay.getProjection().fromLatLngToDivPixel(marker.getPosition());
                    labelDiv.style.left = (position.x + 10) + 'px'; // Offset to the right
                    labelDiv.style.top = (position.y - labelDiv.offsetHeight / 2) + 'px'; // Center vertically
                });
                
            })
            .catch(function(error){
                console.log(error);
            })
        }

        //FORBIDDEN ICON
        // function createMarkerIcon(text) {
        //     // Create an HTML canvas element
        //     var canvas = document.createElement('canvas');
        //     canvas.width = 200;
        //     canvas.height = 50;
        //     var context = canvas.getContext('2d');

        //     // Draw background rectangle
        //     context.fillStyle = 'white';
        //     context.fillRect(0, 0, canvas.width, canvas.height);

        //     // Draw border
        //     context.strokeStyle = 'black';
        //     context.lineWidth = 2;
        //     context.strokeRect(0, 0, canvas.width, canvas.height);

        //     // Set text properties
        //     context.fillStyle = 'black';
        //     context.font = 'bold 14px Arial';
        //     context.textAlign = 'center';
        //     context.textBaseline = 'middle';

        //     // Draw text
        //     context.fillText(text, canvas.width / 2, canvas.height / 2);

        //     // Create an image from the canvas
        //     var image = new Image();
        //     image.src = canvas.toDataURL();

        //     return {
        //         url: image.src,
        //         size: new google.maps.Size(canvas.width, canvas.height),
        //         origin: new google.maps.Point(0, 0),
        //         anchor: new google.maps.Point(canvas.width / 2, canvas.height)
        //     };
        // }
    </script>

    <script>
        function updateMap() {
            const selectedCity = document.getElementById('citySelect').value;
            const coordinates = cityBoundaries[selectedCity];
            const center = new google.maps.LatLng(coordinates.lat, coordinates.lng);
            map.setCenter(center);
            map.setZoom(14); // Optionally adjust the zoom level
        }
    </script>

    <script>
            $(document).ready(function() {
                demo.initGoogleMaps();
                demo.initChartsPages();
                updateMap();
            });
    </script>

    @foreach($workAddress as $workAddress)
        @if(strpos("{{$workAddress->work_status}}", 'available') !== false)
            <script>
                var role = "freelancer";
                var address = "{{$workAddress->work_address}}";
                var title = "{{$workAddress->work_description_name}}";
                var description = "{{ Str::words($workAddress->work_description, 4, '...') }}";
                var fee = "{{$workAddress->work_fee}}";
                var period = "{{$workAddress->work_period}}";
                var id = "{{$workAddress->id}}";
                          
                geocode(address, title, description, fee, period, id, role);
            </script>
        @endif
    @endforeach

@endpush
