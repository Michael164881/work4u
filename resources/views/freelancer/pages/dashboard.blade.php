@extends('freelancer.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">SEARCH JOBS</h5>
                        <p class="card-category">SELANGOR</p>
                            <label>Area:</label>
                            <select id="citySelect" onchange="updateMap()">
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
                    <div class="card-body ">
                        <div id="map" class="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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
            });
    </script>
@endpush
