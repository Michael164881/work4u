@extends('freelancer.app', [
    'class' => '',
    'elementActive' => 'map'
])

@section('content')
    <style>
        .job-details-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 15px;
            background-color: #f8f9fa;
        }

        .job-details-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .job-details {
            margin-bottom: 20px;
        }

        .job-details label {
            font-weight: bold;
        }

        .job-details p {
            margin: 5px 0 15px;
        }

        .delete-job-btn {
            display: block;
            width: 40%;
            text-align: center;
            padding: 10px;
            background-color: #D74646;;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .edit-job-btn {
            display: block;
            width: 40%;
            text-align: center;
            padding: 10px;
            background-color: #f1d05c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .edit-job-btn:hover,  .delete-job-btn:hover{
            color: #7C638F;
            text-decoration: none;
            font-weight: bolder;
        }
    </style>

    <div class="content">
        <center>
            <div class="job-details-container">
                <div class="job-details-header">
                    <h2>{{ $workDescription->work_description_name }}</h2>
                </div>
                <div class="job-details">
                    <label>Work Description:</label>
                    <p>{{ $workDescription->work_description }}</p>
                </div>
                <div class="job-details">
                    <label>Work Period:</label>
                    <p>{{ $workDescription->work_period }} days</p>
                </div>
                <div class="job-details">
                    <label>Work Fee:</label>
                    <p>RM{{ $workDescription->work_fee }}</p>
                </div>
                    <a href="{{ route('workDescription.edit', $workDescription->id) }}" class="edit-job-btn">Edit Job Request</a><br>
                    <form action="{{ route('workDescription.destroy', $workDescription->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job request?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-job-btn">Delete Job Request</button>
                    </form>
            </div>
        </center>
        
    </div>
@endsection
