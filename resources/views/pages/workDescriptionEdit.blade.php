{{-- resources/views/admin/edit_work_description.blade.php --}}

@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'work-job-management'
])

@section('content')
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 15px;
            background-color: #f8f9fa;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: vertical;
            height: 150px;
        }

        .form-group button {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>

    <div class="content">
        <div class="form-container">
            <div class="form-header">
                <h2>Edit Work Description</h2>
            </div>
            <form action="{{ route('job.updateWorkDescription', $workDescription->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="work_description_name">Work Description Name</label>
                    <input type="text" id="work_description_name" name="work_description_name" value="{{ $workDescription->work_description_name }}" required>
                </div>
                <div class="form-group">
                    <label for="work_description">Work Description</label>
                    <textarea id="work_description" name="work_description" required>{{ $workDescription->work_description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="work_fee">Work Fee (RM)</label>
                    <input type="number" id="work_fee" name="work_fee" step="0.01" value="{{ $workDescription->work_fee }}" required>
                </div>
                <div class="form-group">
                    <label for="work_period">Work Period (days)</label>
                    <input type="number" id="work_period" name="work_period" value="{{ $workDescription->work_period }}" required>
                </div>
                <div class="form-group">
                    <label for="freelancer_profile_id">Freelancer</label>
                    <input type="text" id="freelancer_profile_id" name="freelancer_profile_id" value="{{ $workDescription->freelancerProfile->nickname }}" readonly>
                </div>
                <div class="form-group">
                    <button type="submit" style="background-color: #7C638F;">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
