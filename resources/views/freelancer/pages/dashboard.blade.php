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

                        <form action="" method="post">
                            <label>Choose area:</label>
                            <select id="cities" name="cities">
                                <option value="shahalam">Shah Alam</option>
                                <option value="subangjava">Subang Jaya</option>
                                <option value="klang">Klang</option>
                                <option value="petalingjava">Petaling Jaya</option>
                                <option value="ampangjava">Ampang Jaya</option>
                                <option value="batucaves">Batu Caves</option>
                                <option value="puchong">Puchong</option>
                                <option value="serikembangan">Seri Kembangan</option>
                                <option value="kualalumpur">Kuala Lumpur</option>
                            </select>
                        </form>

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
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>

    <script>
            $(document).ready(function() {
                demo.initGoogleMaps();
            });
    </script>
@endpush
