@php
    use Illuminate\Support\Str;
@endphp

@extends('freelancer.app', [
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
            overflow: hidden; /* Ensure content doesn't overflow */
        }

        .my-job-card .bid-method {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            border-radius: 5px;
            padding: 10px;
            transform: translateY(100%);
            transition: transform 0.3s ease-in-out;
            z-index: 1; /* Ensure it's above other content */
            opacity: 0; /* Start hidden */
            pointer-events: none; /* Prevent hover on bid method */
        }

        .my-job-card:hover .bid-method {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
            background-color: #ffffff;
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
            cursor: pointer;
            background-color: #7C638F;
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

        .bid-details {
            width: 100%;
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

        .bid-details h4{
            background-color: #7C638F;
            color: white;
            width: 40%;
            padding: 2% 2% 2% 2%;
            border-radius: 25px;
        }

        .bid-method{
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .bid-method form {
            display: flex;
            flex-direction: column;
            margin: 0 25% 0 25%;
            padding: 2% 0 2% 0;
        }

        .bid-method form input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .bid-method form button {
            padding: 10px;
            background-color: #7C638F;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .bid-method form button:hover {
            background-color: #218838;
        }

        .bid-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .bid-options button {
            background: #7C638F;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            flex: 1 1 calc(33.333% - 10px);
        }

        .bid-options button:hover {
            background: #9472ad;
        }

        .main-card{
            display: flex;
            flex-wrap: wrap;
            gap: 5%;
            margin: 10% 0 0 5%;
        }

        .card-bid, .card-work-profile{
            width: 45%;
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
                                @if(strpos("{{$service->job_status}}", 'available') !== false) 
                                    <div class="col-md-3">
                                        <div class="service-card" onclick="window.location='{{ route('serviceFL.index', $service->id) }}'">
                                            <div class="front face">    
                                               <center>  
                                                    <h3>{{ $service->job_name }}</h3>
                                                    <p>{{ Str::words($service->job_description, 4, '...') }}</p>
                                                    <p>Fee: RM{{ $service->initial_price }}</p>
                                                    <p>Period: {{ $service->job_period }} days</p>
                                                    <p>Freelancer: {{ $service->user->name }}</p>
                                                    <p><strong>Location: {{ $service->user->location }}</strong></p>
                                                </center>
                                            </div>
                                            <div class="back face">
                                                <center>
                                                    @if($service->job_image)
                                                        <img  src="{{ asset($service->job_image) }}" alt="..."  class="desc-img">
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
                        <a href="{{ route('pageFLBrowse.index' , 'browse') }}" class="view-more">View More</a>
                    </div>
                </div>

                <div class="main-card">
                    <!--Work Profile-->
                    <div class="card card-work-profile">
                        <div class="card-header">
                            <center><h2>My Work Profile</h2></center>
                        </div>

                        
                        <div class="card-body">
                            @foreach($workDescription as $workDescription)
                                @if(strpos("{{$workDescription->work_status}}", 'available') !== false) 
                                    <div class="my-job-card" onclick="window.location='{{ route('workDescription.show', $workDescription->id) }}'">
                                        <div class="job-details">    
                                            <h3>{{ $workDescription->work_description_name }}</h3>
                                            <p>{{ $workDescription->work_description }}</p>
                                            <p>Period: {{ $workDescription->work_period }}</p>
                                            <p>Initial Price: RM{{ $workDescription->work_fee }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <a href="{{ route('workDescription.create') }}" class="add-job-button">Add New Work Profile</a>
                        </div>
                    </div>

                    <!-- BIDS -->
                    <div class="card card-bid">
                        <div class="card-header">
                            <center><h2>My Bids</h2></center>
                        </div>
                        <div class="card-body">
                            @foreach($userBids as $bid)
                                <div class="my-job-card">
                                    <div class="bid-details"> 
                                        <center>
                                            <h4>Bid Amount: RM{{ $bid->bid_amount }}</h4>
                                            <br>
                                            <h3>{{ $bid->jobRequest->job_name }}</h3>
                                            <p>{{ Str::words($bid->jobRequest->job_description, 4, '...') }}</p>
                                            <p>Service Fee: RM{{ $bid->jobRequest->initial_price }}</p>
                                            <p>Period: {{ $bid->jobRequest->job_period }} days</p>
                                            <p>Freelancer: {{ $bid->jobRequest->user->name }}</p>
                                            <p><strong>Location: {{ $bid->jobRequest->job_address }}</strong></p><br><br>

                                            <div class="bid-method">
                                                <center>
                                                    <form action="{{ route('bid.update', ['id' => $bid->id])}}" method="POST" id="bidForm">
                                                        @csrf
                                                    <p style="font-size:20px;"><strong>Modify Bid Amount:</strong></p>
                                                        <input name="bid_amount" type="text" id="bid-amount-input" placeholder="Enter your bid amount" style="text-align: center;">

                                                        <div class="bid-options">
                                                            <button type="button">RM 100</button>
                                                            <button type="button">RM 200</button>
                                                            <button type="button">RM 300</button>
                                                            <button type="button">RM 500</button>
                                                            <button type="button">RM 1,000</button>
                                                            <button type="button">RM 5,000</button>
                                                        </div>
                                                        
                                                        <br><button type="submit">Submit Bid</button>
                                                    </form>
                                                </center>
                                            </div>
                                        </center>   
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                

                
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bidAmountInput = document.getElementById('bid-amount-input');
            const bidOptions = document.querySelector('.bid-options');

            bidOptions.addEventListener('click', function(event) {
                if (event.target.tagName === 'BUTTON') {
                    const amount = event.target.textContent.replace(/\D/g, '');
                    bidAmountInput.value = amount;
                }
            });

            // Handle form submission
            document.getElementById('bid-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                const formData = new FormData(this);
                const url = this.getAttribute('action');

                axios.post(url, formData)
                    .then(function(response) {
                        $('#successModal').modal('show'); // Show success modal on successful submission
                    })
                    .catch(function(error) {
                        $('#errorModal').modal('show'); // Show error modal on error
                    });
            });
        });
    </script>
@endsection
