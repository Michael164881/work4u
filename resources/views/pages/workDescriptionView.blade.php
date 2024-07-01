{{-- resources/views/admin/show_work_description.blade.php --}}

@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'job'
])

@section('content')
    <style>
        .work-details-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 15px;
            background-color: #f8f9fa;
        }

        .work-details-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .work-details {
            margin-bottom: 20px;
        }

        .work-details label {
            font-weight: bold;
        }

        .work-details p {
            margin: 5px 0 15px;
        }

        .edit-work-btn, .delete-work-btn {
            display: block;
            width: 40%;
            text-align: center;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            margin: 10px auto;
        }

        .edit-work-btn {
            background-color: #f1d05c;
            color: white;
        }

        .delete-work-btn {
            background-color: #D74646;
            color: white;
        }

        .edit-work-btn:hover, .delete-work-btn:hover {
            color: #7C638F;
            text-decoration: none;
            font-weight: bolder;
        }
    </style>

    <div class="content">
        <div class="work-details-container">
            <div class="work-details-header">
                <h2>{{ $workDescription->work_description_name }}</h2>
            </div>
            <div class="work-details">
                <label>Work Description:</label>
                <p>{{ $workDescription->work_description }}</p>
            </div>
            <div class="work-details">
                <label>Work Fee:</label>
                <p>RM{{ $workDescription->work_fee }}</p>
            </div>
            <div class="work-details">
                <label>Work Period:</label>
                <p>{{ $workDescription->work_period }} days</p>
            </div>
            <div class="work-details">
                <label>Freelancer:</label>
                <p>{{ $workDescription->freelancerProfile->nickname }}</p>
            </div>
            <a href="{{ route('job.editWorkDescription', $workDescription->id) }}" class="edit-work-btn">Edit Work Description</a><br>
            <form action="{{ route('job.destroyWorkDescription', $workDescription->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this work description?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-work-btn">Delete Work Description</button>
            </form>
        </div>
    </div>
@endsection
