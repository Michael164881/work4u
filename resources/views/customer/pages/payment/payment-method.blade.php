@extends('customer.app', [
'class' => '',
'elementActive' => 'top-up'
])

<style>
.payment-card {
    background-color: #f7f7f7;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
}

.payment-card h4 {
    margin-bottom: 10px;
}

.btn-payment {
    background-color: #7C638F;
    color: white;
    border-radius: 5px;
    padding: 10px 20px;
}
</style>

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Select Payment Method') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="payment_method">{{ __('Payment Method') }}</label>
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option value="">{{ __('Select payment method') }}</option>
                                <option value="debit">{{ __('Debit Card') }}</option>
                                <option value="ewallet">{{ __('eWallet') }}</option>
                                <option value="qr">{{ __('QR Code') }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


