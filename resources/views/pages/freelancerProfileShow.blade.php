@extends('layouts.app', ['class' => '', 'elementActive' => 'freelancers'])

@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">
                    <img src="{{ asset('paper/img/damir-bosnjak.jpg') }}" alt="...">
                </div>
                <div class="card-body">
                    <div class="author">
                        <img class="avatar border-gray" src="{{ asset('paper/img/mike.jpg') }}" alt="...">
                        <h5 class="title">{{ $freelancer->nickname }}</h5>
                        <p class="description">{{ $freelancer->location }}</p>
                        <p class="description">{{ $freelancer->work_experience }}</p>
                        <p class="description">{{ $freelancer->edu_quality }}</p>
                        <p class="description">Average rating: {{ $freelancer->average_rating }} stars</p>
                        <p class="description">Rating count: {{ $freelancer->rating_count }} stars</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
