@extends('freelancer.app', [
    'class' => '',
    'elementActive' => 'booking'
])

<style>
    .desc-img {
        border-radius: 10%;
        width: 40%;
    }

    .desc-img-default {
        width: 40%;
        border-radius: 10%;
    }

    .service-description {
        background-color: #7C638F;
        color: white;
        padding: 2%;
        width: 45%;
    }

    .card-body {
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

    h2 {
        margin: 0 0 0 10%;
    }

    .card-title {
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
        position: relative;
    }

    .checklist-item-main{
        margin: 4% 0 4% 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .checklist-description {
        display: flex;
        align-items: center;
        flex-direction: column;
        transition: color 0.1s;
        text-transform: uppercase;
    }

    .checklist-item:last-child {
        border-bottom: none;
    }

    .status-icon {
        width: 20%;
        border-radius: 15px;
        margin-left: 10px;
        position: relative;
        transition: background-color 0.3s;
        text-transform: uppercase;
        color: white;
        padding: 1% 0 1% 0;
    }

    .status-icon.pending {
        background-color: #ffcc00;
    }

    .status-icon.completed {
        background-color: #28a745;
    }

    .status-icon.failed {
        background-color: #dc3545;
    }

    .task-checklist h5 {
        color: purple;
        font-family: Arial Black;
        font-size: 20px;
    }

    .task-checklist p {
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

    .input-form {
        padding: 0.5em;
        margin: 0.5em 0;
        border-radius: 5px;
        border: 1px solid #ced4da;
        width: 50%;
    }

    .form-control:focus {
        border-color: #7C638F;
        box-shadow: none;
    }

    .btn {
        padding: 0.5em 1em;
        margin: 0.5em 0;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    .btn-end {
        background-color: red;
        color: white;
        padding: 0.5em 1em;
        margin: 0.5em 0;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    .btn-end:hover{
        filter: brightness(90%);
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-primary:disabled,
    .btn-success:disabled,
    .btn-danger:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }
    .description-text {
        margin-bottom: 10px;
    }

    .description-form {
        margin-top: 10px;
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
                <!--Status-->
                <span class="status-box 
                    @if($booking->booking_status == 'pending') status-pending 
                    @elseif($booking->booking_status == 'completed') status-completed 
                    @elseif($booking->booking_status == 'cancelled') status-cancelled 
                    @endif">
                    {{ ucfirst($booking->booking_status) }}
                </span><br>

                <!--Image-->
                @if($booking->work_profile_id != 0 && $booking->workDescription->work_description_image)
                    <img src="{{ asset($booking->workDescription->work_description_image) }}" alt="..." class="desc-img">
                @elseif($booking->job_request_id != 0 && $booking->jobRequest->job_image)
                    <img src="{{ asset($booking->jobRequest->job_image) }}" alt="..." class="desc-img">
                @else
                    <img src="{{ asset('images/work_description_pictures/default.png') }}" alt="..." class="desc-img-default">
                @endif

                <!--Title-->
                @if($booking->work_profile_id != 0)
                    <h5 class="card-title">{{ $booking->workDescription->work_description_name }}</h5>
                    <p class="card-text">{{ $booking->workDescription->work_description }}</p>
                @else
                    <h5 class="card-title">{{ $booking->jobRequest->job_name }}</h5>
                    <p class="card-text">{{ $booking->jobRequest->job_description }}</p>
                @endif
                
                <div class="task-checklist">
                    <br>
                    <p class="card-text"><strong>Booking Status:</strong> {{ ucfirst($booking->booking_status) }}</p>
                    <p class="card-text"><strong>Start Date:</strong> {{ $booking->booking_start_date }}</p>
                    <p class="card-text"><strong>End Date:</strong> {{ $booking->booking_end_date }}</p>
                    <p class="card-text"><strong>Fee:</strong> RM{{ $booking->booking_fee }}</p>
                    <p class="card-text"><strong>Customer Name:</strong> {{ $user->name }}</p>
                    <p class="card-text"><strong>Customer Phone:</strong> {{ $user->phone_number }}</p>
                    <a href="https://api.whatsapp.com/send?phone={{ $user->phone_number }}" class="btn btn-primary">Contact via WhatsApp</a>
                    
                    <!--Task Checklist-->
                    <br><br><br><br>
                    <h5>Task Checklist</h5>
                    @foreach($booking->taskChecklists as $checklist)
                    <div class="checklist-item-main">
                        <div class="checklist-item">
                            <span class="status-icon 
                                @if($checklist->status == 'pending') pending 
                                @elseif($checklist->status == 'completed') completed 
                                @elseif($checklist->status == 'failed') failed 
                                @endif" data-status="{{ ucfirst($checklist->status) }}">
                                {{ $checklist->status }}
                            </span>
                            <span class="checklist-description 
                                @if($checklist->status == 'pending') pending 
                                @elseif($checklist->status == 'completed') completed 
                                @elseif($checklist->status == 'failed') failed 
                                @endif">
                                <div class="description-text">
                                    {{ $checklist->checklist_description }}
                                </div>
                                
                            </span>
                            <div>
                               
                                <form action="{{ route('checklist.delete', $checklist->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" @if($booking->booking_status == 'completed') disabled @endif>Delete</button>
                                </form>
                            </div>
                        </div>
                        <div class="description-form">
                                    @if($checklist->status == 'pending' && $booking->booking_status != 'completed')
                                        <form action="{{ route('checklist.update', $checklist->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="input-form">
                                                <option value="completed" @if($checklist->status == 'completed') selected @endif>Completed</option>
                                                <option value="failed" @if($checklist->status == 'failed') selected @endif>Failed</option>
                                            </select>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </form>
                                    @endif
                        </div>
                    </div>
                        
                    @endforeach
                    @if($booking->booking_status != 'completed')
                        <form action="{{ route('checklist.add', $booking->id) }}" method="POST">
                            @csrf
                            <input type="text" name="description" placeholder="Add new checklist item" class="input-form">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                        <form action="{{ route('task.end', $booking->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-end">End Task</button>
                        </form>
                    @endif
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
                for (let i = 0; i <= index; i++) {
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
