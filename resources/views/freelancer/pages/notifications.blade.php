@extends('freelancer.app', [
    'class' => '',
    'elementActive' => 'notifications'
])

@section('content')
    <style>
        .notification-card {
            padding: 20px;
            margin-bottom: 30px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .notification-card h2{
            color: black;
        }

        .notification-card:hover {
            background-color: #7C638F;
        }

        .notification-card:hover p{
            color: white;
        }

        .notification-card:hover h2{
            color: white;
        }

        .notification-info {
            font-size: 1rem;
            color: #333;
        }
        .card-body.scrollable {
            max-height: 60vh;
            overflow-y: auto;
            padding-right: 10px; /* Add some space for the scrollbar */
        }

        .content{
            width: 70%;
            margin: 5% 0 5% 0;
        }

        .card{
            border-radius: 25px;
            padding: 2% 2% 2% 2%; 
        }
    </style>

    <center>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><STRONG>Notifications</STRONG></h5>
                    </div>
                    <div class="card-body scrollable">
                        <div class="row">
                            <div class="col-md-12">
                                        @foreach($notification as $notification)
                                        <center>
                                            <div class="notification-card">
                                                <p class="notification-info">
                                                    @switch($notification->notification_info)
                                                        @case('Low balance')
                                                            <h2><STRONG>LOW BALANCE</STRONG></h2><br>
                                                            <p>You have a low eWallet balance. Please top up to continue using our services.</p><br>
                                                            <p><b>Amount: {{ $notification->user->ewallet_balance }}</b></p>
                                                            @break

                                                        @case('topup')
                                                            <h2><STRONG>TOP UP EWALLET BALANCE SUCCESSFUL</STRONG></h2><br>
                                                            <p>You have successfully top up your ewallet balance.</p><br>
                                                            <p><b>Amount: {{ $notification->user->ewallet_balance }}</b></p>
                                                            @break

                                                        @case('successfully booked')
                                                            <h2><strong>SUCCESSFUL BOOKING</strong></h2><br>
                                                                @if ($notification->booking->job_request_id != 0)
                                                                    <p><b>{{ $notification->booking->job_request_id->job_name }}</b> was successfully booked.</p>
                                                                @endif 
                                                                @if ($notification->booking->work_profile_id != 0)
                                                                    <p><b>{{ $notification->booking->workDescription->work_description_name }}</b> was successfully booked.</p>
                                                                @endif
                                                            @break

                                                        @case('booking completed')
                                                            <h2><STRONG>BOOKING COMPLETED</STRONG></h2><br>
                                                                @if ($notification->booking->job_request_id != 0)
                                                                    <p><b>Your booking for {{ $notification->booking->job_request_id->job_name }}</b> has been completed. Thank you!</p>
                                                                @endif 
                                                                @if ($notification->booking->work_profile_id != 0)
                                                                    <p>Your booking for <b>{{ $notification->booking->workDescription->work_description_name }}</b> has been completed. Thank you!</p>
                                                                @endif
                                                            @break

                                                        @case('booking cancelled')
                                                            <h2><STRONG>BOOKING CANCELLED</STRONG></h2><br>
                                                                @if ($notification->booking->job_request_id != 0)
                                                                    <p><b>Your booking for {{ $notification->booking->job_request_id->job_name }}</b> was cancelled.</p>
                                                                @endif 
                                                                @if ($notification->booking->work_profile_id != 0)
                                                                    <p>Your booking for <b>{{ $notification->booking->workDescription->work_description_name }}</b> was cancelled.</p>
                                                                @endif
                                                            @break

                                                        @case('work description updated')
                                                            <h2><STRONG>WORK DESCRIPTION UPDATED</STRONG></h2><br>
                                                            <p>The work description <b>{{ $notification->workDescription->work_description_name }}</b> has been updated.</p>
                                                            @break

                                                        @case('work description created')                               
                                                            <h2><STRONG>WORK DESCRIPTION CREATED</STRONG></h2><br>
                                                            <p>A new work description <b>{{ $notification->workDescription->work_description_name }}</b> has been created.</p>
                                                            @break

                                                        @case('job request updated')
                                                            <h2><STRONG>JOB REQUEST UPDATED</STRONG></h2><br>
                                                            <p>The job request for <b>{{ $notification->jobRequest->job_name }}</b> has been updated.</p>
                                                            @break

                                                        @case('job request created')
                                                            <h2><STRONG>JOB REQUEST CREATED</STRONG></h2><br>
                                                            <p>A new job request, <b>{{ $notification->jobRequest->job_name }}</b> has been created.</p>
                                                            @break

                                                        @case('bid created')
                                                            <h2><STRONG>BID PLACED</STRONG></h2><br>
                                                            <p>A new bid <b>{{ $notification->bids->jobRequest->job_name }}</b> has been placed.</p>
                                                            @break

                                                        @case('bid updated')
                                                            <h2><STRONG>UPDATED BID</STRONG></h2><br>
                                                            <p>The bid <b>{{ $notification->bids->jobRequest->job_name }}</b> has been updated.</p>
                                                            @break

                                                        @default
                                                            {{ $notification->notification_info }}
                                                    @endswitch
                                                </p>
                                            </div>
                                        </center>
                                        @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </center>
@endsection
