@extends('customer.app', [
    'class' => '',
    'elementActive' => 'booking'
])

@section('content')
    <div class="container">
        <h2>Booking Details</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $booking->workDescription->work_description_name }}</h5>
                <p class="card-text">{{ $booking->workDescription->work_description }}</p>
                <p class="card-text"><strong>Booking Status:</strong> {{ ucfirst($booking->booking_status) }}</p>
                <p class="card-text"><strong>Start Date:</strong> {{ $booking->booking_start_date }}</p>
                <p class="card-text"><strong>End Date:</strong> {{ $booking->booking_end_date }}</p>
                <p class="card-text"><strong>Fee:</strong> RM{{ $booking->booking_fee }}</p>
                <p class="card-text"><strong>Freelancer Phone:</strong> {{ $booking->workDescription->freelancerProfile->user->phone_number }}</p>
                <a href="https://api.whatsapp.com/send?phone={{ $booking->workDescription->freelancerProfile->user->phone_number }}" class="btn btn-primary">Contact via WhatsApp</a>
                @if($booking->booking_status == 'pending')
                    <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cancel Booking</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
