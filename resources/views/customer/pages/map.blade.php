@php
    use Illuminate\Support\Str;
@endphp

@extends('customer.app', [
    'class' => '',
    'elementActive' => 'map'
])

@section('content')
    <style>
        .card-header {
            margin-left: 2%;
            margin-top: 2%;
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
            font-weight: bolder;
            color: #7C638F;
            font-family: Impact, sans-serif;
            letter-spacing: 3px;
            font-size: 40px;
            font-weight: bold;
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

        .view-more {
            display: block;
            margin: 20px auto;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            width: 10%;
            color: white;
            background-color: #f1d05c;
            padding: 5px;
            border-radius: 15px;
        }

        .view-more:hover {
            color: #7C638F;
            text-decoration: none;
        }

        .my-jobs-section {
            margin-top: 40px;
        }

        .my-jobs-section h2 {
            font-size: 24px;
            font-weight: bolder;
        }

        .my-job-card {
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            border-radius: 25px;
            padding: 20px;
            margin-bottom: 20px;
            width: 70%;
        }

        .my-job-card h3 {
            margin-top: 0;
            color: #333;
        }

        .my-job-card p {
            color: #666;
        }

        .my-job-card:hover{
            background-color: #7C638F;
            cursor: pointer;
        }

        .my-job-card:hover h3,
        .my-job-card:hover p {
            color: #fff;
        }

        .add-job-button {

            display: block;
            margin: 40px auto;
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            width: 30%;
            color: white;
            background-color: #f1d05c;
            padding: 10px;
            border-radius: 15px;
        }

        .add-job-button:hover {
            color: #7C638F;
            text-decoration: none;
        }
    </style>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Browse Services</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($services->take(4) as $service)
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
                            @endforeach
                        </div>
                        <a href="{{ route('pageCustBrowse.index' , 'browse') }}" class="view-more">View More</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2>My Job Requests</h2>
                    </div>

                    <div class="card-body">
                        @foreach($jobRequests as $jobRequest)
                            <div class="my-job-card" onclick="window.location='{{ route('jobRequest.show', $jobRequest->id) }}'">
                                <h3>{{ $jobRequest->job_name }}</h3>
                                <p>{{ $jobRequest->job_description }}</p>
                                <p>Period: {{ $jobRequest->job_period }}</p>
                                <p>Initial Price: RM{{ $jobRequest->initial_price }}</p>
                            </div>
                        @endforeach
                        <a href="{{ route('jobRequest.create') }}" class="add-job-button">Add New Job Request</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
