@php
    use Illuminate\Support\Str;
@endphp

@extends('customer.app', [
    'class' => '',
    'elementActive' => 'map'
])

@section('content')
    <style>
        .card-header{
            margin-left: 2%;
        }

        .service-card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 25px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            height: 100%;
            cursor: pointer; 
            transition: background-color 0.3s; 
        }

        .service-card:hover {
            background-color: #7C638F; 
        }

        .service-card:hover h3,
        .service-card:hover p {
            color: #fff; 
        }

        .service-card h3 {
            margin-top: 0;
            color: #333;
            font-weight: bolder;
            font-size: 150%;
        }

        .service-card p {
            color: #666;
        }

        .content .card-header h2 {
            font-size: 24px;
            font-weight: bolder;
        }

        .card-body .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .col-md-3 {
            flex: 0 0 22%;
            max-width: 22%;
            margin: 1%;
        }

        @media (max-width: 768px) {
            .col-md-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .filter-form {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            margin-bottom: 10px;
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .filter-form div {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .filter-form input[type="text"],
        .filter-form select {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            flex: 1;
        }

        .filter-form select {
            max-width: 200px;
        }

        .filter-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .filter-form button:hover {
            background-color: #0056b3;
        }

        /* Optional: Adjust styles for placeholder text */
        .filter-form input[type="text"]::placeholder {
            color: #aaa;
        }

        .back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #7C638F;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back:hover {
            background-color: #7C638F;
            text-decoration: none;
        }
    </style>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Browse Services</h2>
                        <a href="{{ route('pageCustMap.index' , 'map') }}" class="back">Back</a>
                    </div>
                    <div class="card-body">
                        <form class="filter-form" method="GET" action="{{ route('pageCustBrowse.index', 'browse')}}">
                            <div>
                                <input type="text" name="search" placeholder="Search by description name" value="{{ request('search') }}">
                                <select name="location">
                                    <option value="">Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>{{ $location }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" style="background-color: #7C638F;">Filter</button>
                            </div>
                        </form>
                        <div class="row">
                            @foreach($services as $service)
                                @if(str_contain($services->work_status, 'available'))
                                    <div class="col-md-3">
                                        <div class="service-card" onclick="window.location='{{ route('service.index', $service->id) }}'">
                                            <h3>{{ $service->work_description_name }}</h3>
                                            <p>{{ Str::words($service->work_description, 4, '...') }}</p>
                                            <p>Fee: RM{{ $service->work_fee }}</p>
                                            <p>Period: {{ $service->work_period }} days</p>
                                            <p>Freelancer: {{ $service->freelancerProfile->nickname }}</p>
                                            <p><strong>Location: {{ $service->freelancerProfile->location }}</strong></p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
