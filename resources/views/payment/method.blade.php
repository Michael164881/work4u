@extends('customer.app', [
    'class' => '',
    'elementActive' => 'payment.method'
])

@section('styles')
<style>
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        border-radius: 10px;
    }

    .payment-method {
        text-align: left;
    }

    .payment-method h5 {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .btn-submit {
        background-color: #FF6F61;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #e65b4f;
    }
</style>
@endsection

@section('content')
    <div class="modal-content">
        <div class="payment-method">
            <h5>{{ __('Payment Method') }}</h5>
            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="cardholderName">{{ __('Card Holder Name') }}</label>
                    <input type="text" id="cardholderName" name="cardholder_name" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label for="cardNumber">{{ __('Card Number') }}</label>
                    <input type="text" id="cardNumber" name="card_number" placeholder="4123 4567 8910 1234" required>
                </div>
                <div class="form-group">
                    <label for="expiryDate">{{ __('Expiry Date') }}</label>
                    <input type="text" id="expiryDate" name="expiry_date" placeholder="07/23" required>
                </div>
                <div class="form-group">
                    <label for="cvv">{{ __('CVV Code') }}</label>
                    <input type="text" id="cvv" name="cvv" placeholder="123" required>
                </div>
                <button type="submit" class="btn-submit">{{ __('Submit') }}</button>
            </form>
        </div>
    </div>
@endsection
