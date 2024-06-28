@extends('customer.app', [
    'class' => '',
    'elementActive' => 'booking'
])

<style>
    .desc-img{
        border-radius: 10%;
        width: 40%;
    }

    .desc-img-default{
        width: 40%;
        border-radius: 10%;
    }

    .service-description{
        background-color: #7C638F;
        color: white;
        padding: 2%;
        width: 45%;
    }

    .card-body{
        gap: 100px;
        width: 100%;
        margin: 0 2% 0 2%;
        padding: 0 0 0 5%;
    }

    .service-card {
        border-radius: 15px;
        margin-bottom: 20px;
        box-sizing: border-box;
    }

    h2{
        margin: 0 0 0 10%;
    }

    .card-title{
        font-size: 40px;
        font-family: Arial Black;
    }

    .status-box {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 30px;
        color: #fff;
        text-align: center;
        width: 50%;
        margin: 0 auto;
        margin-bottom: 5%;
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

    .task-checklist {
        width: 85%;
        background-color: #f8f9fa;
        padding: 2%;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        color: black;
    }

    .checklist-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #e0e0e0;
        position: relative;
    }

    .status-icon::after {
        content: attr(data-status);
        position: absolute;
        bottom: 25px;
        left: -50%;
        transform: translate(-100%,90%);
        color: #fff;
        padding: 5px;
        border-radius: 3px;
        font-size: 20px;
    }

    .checklist-description {
        display: flex;
        align-items: center;
        transition: color 0.1s;
    }

    .status-icon:hover::after {
        display: block;
    }

    .checklist-item:last-child {
        border-bottom: none;
    }

    .status-icon {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-left: 10px;
        position: relative;
        transition: background-color 0.3s;
    }

    .checklist-description.pending:hover {
        color: #ffcc00;
    }

    .checklist-description.completed:hover {
        color: #28a745;
    }

    .checklist-description.failed:hover {
        color: #dc3545;
    }

    .status-icon.pending:hover::after {
        color: #ffcc00;
    }

    .status-icon.completed:hover::after {
        color: #28a745;
    }

    .status-icon.failed:hover::after {
        color: #dc3545;
    }

    .status-icon.pending {
        background-color: #ffcc00;
        border-radius: 50%;
    }

    .status-icon.completed {
        background-color: #28a745;
        border-radius: 50%;
    }

    .status-icon.failed {
        background-color: #dc3545;
        border-radius: 50%;
    }

    .task-checklist h5{
        color: purple;
        font-family: Arial Black;
        font-size: 20px;
    }

    .task-checklist p{
        color: #68577d;
    }

    .rating {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .rating input {
        display: none;
    }

    .rating label {
        font-size: 30px;
        color: gray;
        padding: 0 5px;
        cursor: pointer;
    }

    .rating input:checked ~ label {
        color: gold;
    }

    .rating label:hover ~ label,
    .rating label:hover {
        color: gold;
    }
    

</style>

@section('content')
    <div class="content">
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
        <center>
            <div class="card-body">
                
                <div class="service-card service-description">
                    <span class="status-box 
                        @if($booking->booking_status == 'pending') status-pending 
                        @elseif($booking->booking_status == 'completed') status-completed 
                        @elseif($booking->booking_status == 'cancelled') status-cancelled 
                        @endif">
                        {{ ucfirst($booking->booking_status) }}
                    </span><br>
                    @if($booking->workDescription->work_description_image)
                        <img  src="{{ asset($booking->workDescription->work_description_image) }}" alt="..."  class="desc-img">
                    @else
                        <img  src="{{ asset('images/work_description_pictures/default.png') }}" alt="..." class="desc-img-default">
                    @endif
                    <br><br>
                    <h5 class="card-title">{{ $booking->workDescription->work_description_name }}</h5>

                    <div class="task-checklist">
                        <br>
                        <p class="card-text">{{ $booking->workDescription->work_description }}</p><br>
                        <p class="card-text"><strong>Start Date:</strong><br> {{ $booking->booking_start_date }}</p>
                        <p class="card-text"><strong>End Date:</strong><br> {{ $booking->booking_end_date }}</p>
                        <p class="card-text"><strong>Fee:</strong><br> RM{{ $booking->booking_fee }}</p>
                        <p class="card-text"><strong>Freelancer Name:</strong><br> {{ $booking->workDescription->freelancerProfile->user->name }}</p>
                        <p class="card-text"><strong>Freelancer Phone:</strong><br> {{ $booking->workDescription->freelancerProfile->user->phone_number }}</p>
                        <a href="https://api.whatsapp.com/send?phone={{ $booking->workDescription->freelancerProfile->user->phone_number }}" class="btn btn-primary">Contact via WhatsApp</a>
                        @if($booking->booking_status == 'pending')
                            <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-danger">Cancel Booking</button>
                            </form>
                        @endif
                        @if($booking->booking_status != 'pending')
                            <div class="rating">
                                <form action="{{ route('bookings.rate', $booking->id) }}" method="POST">
                                    @csrf
                                    <br><br><p class="card-text"><strong>Freelancer Rating </strong></p>
                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">★</label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">★</label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">★</label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">★</label>
                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">★</label>

                                    <button type="submit" class="btn btn-primary mt-2">Submit Rating</button>
                                </form>
                            </div>
                        @endif

                        <br>
                        <h5>Task Checklist</h5>
                        @foreach($booking->taskChecklists as $checklist)
                            <div class="checklist-item">
                                <span class="checklist-description 
                                    @if($checklist->status == 'pending') pending 
                                    @elseif($checklist->status == 'completed') completed 
                                    @elseif($checklist->status == 'failed') failed 
                                    @endif">
                                    {{ $checklist->checklist_description }}
                                </span>
                                <span class="status-icon 
                                    @if($checklist->status == 'pending') pending 
                                    @elseif($checklist->status == 'completed') completed 
                                    @elseif($checklist->status == 'failed') failed 
                                    @endif" data-status="{{ ucfirst($checklist->status) }}">
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </center>
        
    </div>
@endsection

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const ratingLabels = document.querySelectorAll('.rating label');
            const ratingInputs = document.querySelectorAll('.rating input');

            function updateStars() {
                ratingLabels.forEach(label => label.style.color = 'gray');
                const checkedInput = document.querySelector('.rating input:checked');
                if (checkedInput) {
                    const index = Array.from(ratingInputs).indexOf(checkedInput);
                    for (let i = 0; i <= index-1; i++) {
                        ratingLabels[i].style.color = 'gold';
                    }
                }
            }

            ratingLabels.forEach(label => {
                label.addEventListener('mouseenter', function() {
                    const index = Array.from(ratingLabels).indexOf(label);
                    for (let i = 0; i <= index; i++) {
                        ratingLabels[i].style.color = 'gold';
                    }
                });

                label.addEventListener('mouseleave', updateStars);
            });

            ratingInputs.forEach(input => {
                input.addEventListener('change', updateStars);
            });

            // Initial call to set the correct state on page load
            updateStars();
        });
    </script>
