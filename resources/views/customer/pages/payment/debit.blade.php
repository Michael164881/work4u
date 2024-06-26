@extends('customer.app', [
    'class' => '',
    'elementActive' => 'top-up'
])

@section('content')
<style>
    .payment-method {
        background: #ffffff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 20px auto;
    }

    .payment-method h5.title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .payment-method .form-group {
        margin-bottom: 15px;
    }

    .payment-method label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .payment-method input.form-control {
        height: 45px;
        border-radius: 5px;
        padding: 10px;
        border: 1px solid #dcdcdc;
    }

    .payment-method .btn-primary {
        background-color: #ff6b6b;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
    }

    .payment-method .btn-primary:hover {
        background-color: #ff4b4b;
    }

    .card {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }

    .card img {
        max-width: 100%;
        border-radius: 5px;
    }
</style>

<div class="content">
    <div class="payment-method">
        <h5 class="title">{{ __('Credit Card Payment') }}</h5>
        <form action="{{ route('payment.debit.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>{{ __('Card Holder Name') }}</label>
                <input type="text" name="card_holder_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ __('Card Number') }}</label>
                <input type="text" name="card_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ __('Expiry Date') }}</label>
                <input type="text" name="expiry_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ __('CVV') }}</label>
                <input type="text" name="cvv" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
        <div class="card">
        <img src="{{ asset('images/debit.png') }}" alt="Debit Card" style="width: 400px; height: 250px;">
        </div>
    </div>
</div>
@endsection
