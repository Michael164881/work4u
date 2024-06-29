@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'job'
])

@section('content')
    <style>
        .card-header {
            margin-left: 2%;
            margin-top: 2%;
        }

        .work-job-card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 25px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .work-job-card h3 {
            margin-top: 0;
            color: #333;
        }

        .work-job-card p {
            color: #666;
        }

        .view-details-button {
            display: block;
            margin: 20px auto;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            width: 10%;
            color: white;
            background-color: #7C638F;
            padding: 5px;
            border-radius: 15px;
        }

        .view-details-button:hover {
            color: white;
            text-decoration: none;
        }
    </style>

    <div class="content">
        <div class="row">
            <form action="{{ route('export.work_descriptions') }}" method="GET">
                <button type="submit">Export Work Descriptions</button>
            </form>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Work Descriptions</h2>
                    </div>
                    <div class="card-body">
                        @foreach($workDescriptions as $workDescription)
                            <div class="work-job-card">
                                <h3>{{ $workDescription->work_description_name }}</h3>
                                <p>{{ $workDescription->work_description }}</p>
                                <p>Fee: RM{{ $workDescription->work_fee }}</p>
                                <p>Period: {{ $workDescription->work_period }} days</p>
                                <p>Freelancer: {{ $workDescription->freelancerProfile->nickname }}</p>
                                <p><strong>Location: {{ $workDescription->freelancerProfile->location }}</strong></p>
                                <a href="{{ route('job.showWorkDescription', $workDescription->id) }}" class="view-details-button">View Details</a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Job Requests Export Button -->
                <form action="{{ route('export.job_requests') }}" method="GET">
                    <button type="submit">Export Job Requests</button>
                </form>
                <div class="card">
                    <div class="card-header">
                        <h2>Job Requests</h2>
                    </div>
                    <div class="card-body">
                        @foreach($jobRequests as $jobRequest)
                            <div class="work-job-card">
                                <h3>{{ $jobRequest->job_name }}</h3>
                                <p>{{ $jobRequest->job_description }}</p>
                                <p>Period: {{ $jobRequest->job_period }}</p>
                                <p>Initial Price: RM{{ $jobRequest->initial_price }}</p>
                                <p>User: {{ $jobRequest->user->name }}</p>
                                <p>Status: {{ $jobRequest->job_status }}</p>
                                <a href="{{ route('job.showJobRequest', $jobRequest->id) }}" class="view-details-button">View Details</a>
                                
                                <h4>Bids</h4>
                                <ul>
                                    @foreach($jobRequest->bids as $bid)
                                        <li>
                                            {{ $bid->freelancerProfile->nickname }}: RM{{ $bid->bid_amount }}
                                            <!-- Remove bid route because it's not done yet! -->
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
