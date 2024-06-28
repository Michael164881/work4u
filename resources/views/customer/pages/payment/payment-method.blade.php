@extends('customer.app', [
'class' => '',
'elementActive' => 'profile'
])

    <style>
        .card{
            padding: 10%;
        }

        .card-header h3{
            font-size: 45px;
        }

        .payment-method{
            margin-top: 5%;
            width: 80%;
        }

        .payment-method-card{
            margin-top: 15%;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10% 0 10% 0;
            width: 70%;
        }

        .hire-container {
            display: flex;
            justify-content: space-between;
        }

        .work-description {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .payment-method form {
            display: flex;
            flex-direction: column;
        }

        .payment-method form select{
            width: 70%;
            margin: 5% 0 10% 0;
        }

        .payment-method form input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 25px;
        }

        .payment-method form button {
            padding: 10px;
            background-color: #7C638F;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-method form button:hover {
            background-color: #9472ad;
        }

        .reload-container {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
        }

        .reload-container h5 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .reload-container p {
            font-size: 14px;
            color: #888;
            margin-bottom: 20px;
        }

        .amount-input {
            margin-bottom: 20px;
        }

        .amount-input input {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        .amount-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .amount-options button {
            background: #7C638F;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            flex: 1 1 calc(33.333% - 10px);
        }

        .amount-options button:hover {
            background: #7C638F;
        }

        .other-options {
            text-align: left;
            margin-top: 20px;
        }

        .other-options p {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .other-options a {
            display: flex;
            align-items: center;
            padding: 10px;
            margin: 5px 0;
            text-decoration: none;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .other-options a:hover {
            background: #f1f1f1;
        }

        .other-options img {
            margin-right: 10px;
        }

        .btn-reload {
            background: #dcdcdc;
            border: none;
            border-radius: 25px;
            padding: 15px;
            width: 100%;
            font-size: 18px;
            cursor: not-allowed;
        }

        .title-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .title-section img {
            width: 24px;
            height: 24px;
        }
    </style>

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <center><h3><strong>Your Balance:</strong> RM{{ $user->ewallet_balance }}</h3></center>
                </div>
                <center>
                <div class="payment-method">
                    <form action="{{ route('top-up.process') }}" method="POST">
                        @csrf
                        <div class="title-section">
                            <h5 class="title">{{ __('Disclaimer') }}</h5>
                            <img src="{{ asset('images/lock.png') }}" alt="Lock Icon" style="width: 35px; height: 60px;">
                        </div>
                        <p>{{ __('Don\'t worry, your data is kept in accordance to the law and is protected by us!') }}</p>
                        <div class="amount-input">
                            <input name="amount" type="text" id="amount-input" placeholder="Enter your amount">
                        </div>
                        <div class="amount-options" id="amount-options">
                            <button>RM 100</button>
                            <button>RM 200</button>
                            <button>RM 300</button>
                            <button>RM 500</button>
                            <button>RM 1,000</button>
                            <button>RM 5,000</button>
                        </div>

                        <!--Payment Method-->
                        <center>
                        <div class="payment-method-card">
                            <label for="payment_method">{{ __('Payment Method') }}</label>
                            <center>
                                <select class="form-control" id="payment-method" name="payment_method" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="debit_card">Debit Card</option>
                                    <option value="qr_code">QR Code</option>
                                </select>
                            </center>
                            

                            <div id="debit-card-fields" style="display: none;">
                                <input type="text" name="card_number" placeholder="Card Number" required>
                                <input type="text" name="card_name" placeholder="Card Name" required>
                                <input type="text" name="expiry_date" placeholder="Expiry Date" required>
                                <input type="text" name="cvv" placeholder="CVV" required>
                            </div>

                            <div id="ewallet-fields" style="display: none;">
                                <br><br><br><p>Pay using your eWallet</p>
                                <center><h3><strong>Your Balance:</strong> RM{{ $user->ewallet_balance }}</h3></center>
                            </div>

                            <div id="qr-code-fields" style="display: none;">
                                <p>Scan the QR code to pay:</p>
                                <img src="{{ asset('images/QR_Code.png') }}" alt="QR Code">
                            </div>
                            <button type="submit">Pay Now</button>
                        </div>
                        </center>
                        
                    </form>
                </div>
                </center>
            </div>
        </div>
    </div>
</div>

<!--Amount Selected-->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const amountInput = document.getElementById('amount-input');
    const amountOptions = document.getElementById('amount-options');
    const reloadButton = document.getElementById('btn-reload');

    function enableReloadButton() {
        if (amountInput.value.trim() !== '') {
            reloadButton.disabled = false;
            reloadButton.style.cursor = 'pointer';
            reloadButton.style.background = '#007bff'; // You can change this to your desired active color
        } else {
            reloadButton.disabled = true;
            reloadButton.style.cursor = 'not-allowed';
            reloadButton.style.background = '#dcdcdc';
        }
    }

    amountInput.addEventListener('input', function() {
        // Remove non-numeric characters
        amountInput.value = amountInput.value.replace(/\D/g, '');
        enableReloadButton();
    });

    amountOptions.addEventListener('click', function(event) {
        if (event.target.tagName === 'BUTTON') {
            const amount = event.target.textContent.replace(/\D/g, '');
            amountInput.value = amount;
            enableReloadButton();
        }
    });
});
</script>

<!--Display Payment Method-->
<script>
        document.getElementById('payment-method').addEventListener('change', function () {
            var debitCardFields = document.getElementById('debit-card-fields');
            var qrCodeFields = document.getElementById('qr-code-fields');

            debitCardFields.style.display = 'none';
            qrCodeFields.style.display = 'none';

            if (this.value === 'debit_card') {
                debitCardFields.style.display = 'block';
                document.getElementsByName('card_number')[0].setAttribute('required', 'true');
                document.getElementsByName('card_name')[0].setAttribute('required', 'true');
                document.getElementsByName('expiry_date')[0].setAttribute('required', 'true');
                document.getElementsByName('cvv')[0].setAttribute('required', 'true');
            } else if (this.value === 'qr_code') {
                qrCodeFields.style.display = 'block';
                document.getElementsByName('card_number')[0].removeAttribute('required');
                document.getElementsByName('card_name')[0].removeAttribute('required');
                document.getElementsByName('expiry_date')[0].removeAttribute('required');
                document.getElementsByName('cvv')[0].removeAttribute('required');
            }
        });

        @if(session('success'))
            $('#successModal').modal('show');
        @elseif(session('error'))
            $('#errorModal').modal('show');
        @endif
</script>
@endsection


