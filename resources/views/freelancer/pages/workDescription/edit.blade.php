@extends('freelancer.app', [
    'class' => '',
    'elementActive' => 'map'
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
                <h2>Edit Job Request</h2>
            </div>
            <form action="{{ route('workDescription.update', $workDescription->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="job_name">Work Name</label>
                    <input type="text" id="job_name" name="job_name" value="{{ $workDescription->work_description_name }}" required>
                </div>
                <div class="form-group">
                    <label for="job_description">Work Description</label>
                    <textarea id="job_description" name="job_description" required>{{ $workDescription->work_description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="job_period">Work Period (days)</label>
                    <input type="number" id="job_period" name="job_period" value="{{ $workDescription->work_period }}" required>
                </div>
                <div class="form-group">
                    <label for="initial_price">Work Fee (RM)</label>
                    <input type="number" id="initial_price" name="initial_price" step="0.01" value="{{ $workDescription->work_fee }}" required>
                </div>
                <div class="form-group">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
