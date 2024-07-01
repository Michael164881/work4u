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
            margin-bottom: 20px;
            display: block;
            text-align: center;
            cursor: pointer;
            height: 35vh;
            transition: background-color 0.3s;
            transform-style: preserve-3d;
            transition: all .8s linear;
        }

        .face {
            position: absolute;
            width: 30vh;
            height: 30vh;
            backface-visibility: hidden;
            padding: 10% 0 10% 15%;
        }
        .back {
            display: block;
            transform: rotateY(180deg);
            box-sizing: border-box;
            text-align: center;
            opacity: .9;
            padding: 10% 15% 10% 0;
        }

        .back img{
            width: 70vw;
            height: 25vh;
            border-radius: 25px;
        }

        .service-card:hover {
            background-color: #7C638F;
            transform: rotateY(180deg);
            box-shadow: 0px 0px 15px rgba(0,0,0, .3);
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

        .card-body {
            padding: 20px;
        }

        .my-job-card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: background-color 0.3s;
            cursor: pointer;
            position: relative;
            display: flex;
            justify-content: space-between;
        }

        .my-job-card h3 {
            margin-top: 0;
            color: #333;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .my-job-card p {
            color: #666;
            margin-bottom: 10px;
        }

        .my-job-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .my-job-card ul li {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s;
        }

        .my-job-card ul li:hover {
            background-color: #f1f1f1;
        }

        .my-job-card ul li .btn {
            margin-left: 10px;
        }

        .bids-container {
            max-height: 12vh;
            overflow-y: hidden;
            padding: 10px;
            margin-top: 10px;
            width: 20%;
            transition: max-height 0.3s;
            transition: 1s;
        }

        .bids-container h4 {
            margin-top: 0;
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
        }

        .bids-container ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .bids-container ul li {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s;
            text-transform: uppercase;
        }

        .bids-container ul li:hover {
            background-color: #f1d05c;
        }

        .bids-container ul li .btn {
            font-size: 1rem;
            padding: 5px 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            
        }

        .bids-container ul li .btn:hover {
            background-color: #0056b3;
        }

        .add-job-button {
            display: block;
            margin: 20px auto;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            text-decoration: none;
            color: white;
            background-color: #28a745;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .add-job-button:hover {
            background-color: #218838;
            text-decoration: none;
        }

        .my-job-card:hover{
            background-color: #7C638F;
            cursor: pointer;
        }

        
        .my-job-card:hover p, .my-job-card:hover h3{
            color: white;
        }

        .my-job-card:hover .bids-container {
            max-height: 200px; 
            overflow-y: auto;
            width: 30%;
            transition: 1s;
        }

        .my-job-card:hover h4 {
            color: white;
        }

        .my-job-card:hover li{
            text-transform: uppercase;
        }

        .my-job-card:hover .btn-primary{
            width: 30%;
        }

        .my-job-card h3 {
            margin-top: 0;
            color: #333;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .my-job-card p {
            color: #666;
            margin-bottom: 10px;
        }

        .job-details {
            width: 60%;
        }

        .add-job-button {
            display: block;
            margin: 20px auto;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            text-decoration: none;
            color: white;
            background-color: #28a745;
            width: 40%;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .add-job-button:hover {
            background-color: #218838;
            text-decoration: none;
            color: white;
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
                            @foreach($services as $service)
                                @if(strpos("{{$service->work_status}}", 'available') == true)
                                    <div class="col-md-3">
                                        <div class="service-card" onclick="window.location='{{ route('service.index', $service->id) }}'">
                                            <div class="front face">
                                                <center>
                                                    <h3>{{ $service->work_description_name }}</h3>
                                                    <p>{{ Str::words($service->work_description, 4, '...') }}</p>
                                                    <p>Fee: RM{{ $service->work_fee }}</p>
                                                    <p>Period: {{ $service->work_period }} days</p>
                                                    <p>Freelancer: {{ $service->freelancerProfile->nickname }}</p>
                                                    <p><strong>Location: {{ $service->freelancerProfile->location }}</strong></p>
                                                </center>
                                            </div>
                                            <div class="back face">
                                                <center>
                                                    @if($service->work_description_image)
                                                        <img  src="{{ asset($service->work_description_image) }}" alt="..."  class="desc-img">
                                                    @else
                                                        <img  src="{{ asset('images/work_description_pictures/default.png') }}" alt="..." class="desc-img">
                                                    @endif
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                            @if($jobRequest->job_status === 'available')
                                <div class="my-job-card" onclick="window.location='{{ route('jobRequest.show', $jobRequest->id) }}'">
                                    <div class="job-details">
                                        <h3>{{ $jobRequest->job_name }}</h3>
                                        <p>{{ $jobRequest->job_description }}</p>
                                        <p>Period: {{ $jobRequest->job_period }}</p>
                                        <p>Initial Price: RM{{ $jobRequest->initial_price }}</p>
                                    </div>
                                    <div class="bids-container">
                                        <h4>Bids</h4>
                                        <ul>
                                            @foreach($bids->where('job_request_id', $jobRequest->id) as $bid)
                                                @if($bid->freelancerProfile)
                                                    <li>
                                                        <span>{{ $bid->freelancerProfile->nickname }}: RM{{ $bid->bid_amount }}</span>
                                                        <a href="{{ route('hireBid.index', $bid->id) }}" class="btn btn-primary">Hire</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <br><br><a href="{{ route('jobRequest.create') }}" class="add-job-button">Add New Job Request</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
