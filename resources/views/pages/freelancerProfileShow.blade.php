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
                        <h5 class="title">{{ $freelancer->flancer_name }}</h5>
                        <p class="description">{{ $freelancer->flancer_email }}</p>
                        <p class="description">{{ $freelancer->flancer_phone_no }}</p>
                        <p class="description">{{ $freelancer->flancer_work_experience }}</p>
                        <p class="description">{{ $freelancer->flancer_edu_quality }}</p>
                        <p class="description">{{ $freelancer->flancer_nickname }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
