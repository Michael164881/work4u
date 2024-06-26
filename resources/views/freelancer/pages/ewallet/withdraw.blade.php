@extends('freelancer.app', [
    'class' => '',
    'elementActive' => 'ewallet'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Withdrawal form -->
                <form action="{{ route('ewallet.withdraw') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Withdraw Money') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Amount') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="number" name="amount" class="form-control" placeholder="Enter amount to withdraw" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Withdraw') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
