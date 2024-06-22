@php
    use Illuminate\Support\Str;
@endphp

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
    </style>

    <div class="content">
        <div class="row">
            <h2>SERVICE DETAILS</h2>
            <div class="col-md-12">
                <div class="service-detail-container">
                    <div class="service-card freelancer-profile">
                        <h4>Freelancer Profile</h4>
                        <p><strong>Nickname:</strong> {{ $service->freelancerProfile->nickname }}</p>
                        <p><strong>Name:</strong> {{ $service->freelancerProfile->user->name }}</p>
                        <p><strong>Location:</strong> {{ $service->freelancerProfile->location }}</p>
                        <p><strong>Work Experience:</strong> {{ $service->freelancerProfile->work_experience }}</p>
                        <p><strong>Educational Qualification:</strong> {{ $service->freelancerProfile->edu_quality }}</p>
                        <p><strong>Email:</strong> {{ $service->freelancerProfile->user->email }}</p>
                        <p><strong>Phone Number:</strong> {{ $service->freelancerProfile->user->phone_number }}</p>
                    </div>
                    <div class="service-card service-description">
                        <center>
                            <h4>{{ $service->work_description_name }}</h4>
                            <p>{{ $service->work_description }}</p>
                            <h5><strong>Fee:</strong> RM{{ $service->work_fee }}</h5>
                            <h5><strong>Period:</strong> {{ $service->work_period }} days</h5>
                            <a href="#" class="hire-now-btn">HIRE NOW</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
