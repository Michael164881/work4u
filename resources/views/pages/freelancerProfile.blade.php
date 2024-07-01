@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'freelancers'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Freelancer Management</h5>
                    <form method="GET" action="{{ route('freelancers.index') }}" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search by name" aria-label="Search" name="search" value="{{ request('search') }}">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nickname</th>
                                <th>Location</th>
                                <th>Work Experience</th>
                                <th>Education Quality</th>
                                <th>Average Rating</th>
                                <th>Rating Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($freelancers as $freelancer)
                                <tr>
                                    <td>{{ $freelancer->nickname }}</td>
                                    <td>{{ $freelancer->location }}</td>
                                    <td>{{ $freelancer->work_experience }}</td>
                                    <td>{{ $freelancer->edu_quality }}</td>
                                    <td>{{ $freelancer->average_rating }}</td>
                                    <td>{{ $freelancer->rating_count }}</td>
                                    <td>
                                        <a href="{{ route('freelancers.show', $freelancer->id) }}" class="btn btn-info btn-sm">Show</a>
                                        <a href="{{ route('freelancers.edit', $freelancer->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('freelancers.destroy', $freelancer->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
