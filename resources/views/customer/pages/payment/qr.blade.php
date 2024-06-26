@extends('customer.app', [
    'class' => '',
    'elementActive' => 'top-up'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('QR Code Payment') }}</h5>
                </div>
                <div class="card-body">
                    <!-- QR Code Payment Instructions -->
                    <p>{{ __('Scan the QR code below to proceed with the payment.') }}</p>
                    <div class="text-center">
                        <img src="{{ asset('images/QR_CODE.PNG') }}" alt="QR Code" style="width: 250px; height: 500px;">
                    </div>
                    <form action="{{ route('payment.qr.process') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Confirm Payment') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
