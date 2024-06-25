@extends('customer.app', [
    'class' => '',
    'elementActive' => 'booking'
])

@section('content')
    <style>
        .card-header {
            margin-left: 2%;
            margin-top: 2%;
        }

        .booking-card {
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

        .booking-card:hover {
            background-color: #7C638F;
        }

        .booking-card:hover h3,
        .booking-card:hover p {
            color: #fff;
        }

        .booking-card h3 {
            margin-top: 0;
            color: #333;
            font-weight: bolder;
            font-size: 150%;
        }

        .booking-card p {
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

        .my-bookings-section {
            margin-top: 40px;
        }

        .my-booking-card {
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            border-radius: 25px;
            padding: 20px;
            margin-bottom: 20px;
            width: 70%;
        }

        .my-booking-card h3 {
            margin-top: 0;
            color: #333;
        }

        .my-booking-card p {
            color: #666;
        }

        .my-booking-card:hover {
            background-color: #7C638F;
            cursor: pointer;
        }

        .my-booking-card:hover h3,
        .my-booking-card:hover p {
            color: #fff;
        }
    </style>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>My Bookings</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($bookings as $booking)
                                <div class="col-md-3">
                                    <div class="booking-card" onclick="window.location='{{ route('bookings.show', $booking->id) }}'">
                                        <h3>{{ $booking->workDescription->work_description_name }}</h3>
                                        <p>{{ Str::words($booking->workDescription->work_description, 10, '...') }}</p>
                                        <p><strong>Fee:</strong> RM{{ $booking->booking_fee }}</p>
                                        <p><strong>Status:</strong> {{ ucfirst($booking->booking_status) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
