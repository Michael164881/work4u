@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'bookingM'
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
        border-radius: 10px; /* Adjusted border-radius for rectangular shape */
        padding: 20px;
        margin-bottom: 20px;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s;
        width: 70%; /* Ensures cards take full width of parent */
        margin: 0 auto; /* Centers cards horizontally */
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
        font-size: 18px; /* Adjust font size for better fit */
    }

    .booking-card p {
        color: #666;
        margin-bottom: 10px; /* Adds space between paragraphs */
    }

    .content .card-header h2 {
        font-weight: bolder;
        color: #7C638F;
        font-family: Impact, sans-serif;
        letter-spacing: 3px;
        font-size: 40px;
        font-weight: bold;
        text-align: center; /* Center-aligns heading */
    }

    .my-bookings-section {
        margin-top: 40px;
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

    .status-box {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
        color: #fff;
        text-align: center;
        width: 40%;
        margin: 0 auto;
    }

    .status-pending {
        background-color: #ffcc00;
        animation: pulse 2s infinite;
    }

    .status-completed {
        background-color: #28a745;
    }

    .status-cancelled {
        background-color: #dc3545;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.5;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('adminBooking.export') }}" class="btn btn-success">Export Bookings to Excel</a>
                    <form class="filter-form" method="GET" action="{{ route('adminBooking.index', 'bookingM') }}">
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
                    <div class="card-body">
                        <div class="my-bookings-section">
                            @foreach($bookings as $booking)
                                <div class="booking-card mb-3" onclick="window.location='{{ route('adminBooking.show', $booking->id) }}'">
                                    <h3>{{ $booking->workDescription->work_description_name ?? 'N/A' }}</h3>
                                    <p>{{ $booking->workDescription ? Str::words($booking->workDescription->work_description, 10, '...') : 'N/A' }}</p>
                                    <p><strong>Fee:</strong> RM{{ $booking->booking_fee }}</p>
                                    <p>
                                        <strong>Status:</strong> <br>
                                        <span class="status-box 
                                            @if($booking->booking_status == 'pending') status-pending 
                                            @elseif($booking->booking_status == 'completed') status-completed 
                                            @elseif($booking->booking_status == 'cancelled') status-cancelled 
                                            @endif">
                                            {{ ucfirst($booking->booking_status) }}
                                        </span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
