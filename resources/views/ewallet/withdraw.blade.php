@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header text-center">
                    <h3>{{ __('Withdraw Money') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('ewallet.withdraw') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="amount">{{ __('Amount') }}</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount to withdraw" required>
                        </div>
                        <button type="submit" class="btn btn-info btn-block">{{ __('Withdraw') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
