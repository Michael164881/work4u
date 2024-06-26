@extends('customer.app', [
    'class' => '',
    'elementActive' => 'top-up'
])

@section('content')
<style>
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
        background: #f1f1f1;
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
        background: #ddd;
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

<div class="content">
    <div class="reload-container">
        <div class="title-section">
            <h5 class="title">{{ __('Reload') }}</h5>
            <img src="{{ asset('images/lock.png') }}" alt="Lock Icon" style="width: 35px; height: 60px;">
        </div>
        <p>{{ __('Don\'t worry, your data is kept in accordance to the law and is protected by us!') }}</p>
        <div class="amount-input">
            <input type="text" id="amount-input" placeholder="Enter your amount">
        </div>
        <div class="amount-options" id="amount-options">
            <button>RM 100</button>
            <button>RM 200</button>
            <button>RM 300</button>
            <button>RM 500</button>
            <button>RM 1,000</button>
            <button>Other</button>
        </div>
        <button class="btn-reload" id="btn-reload" disabled>{{ __('Reload eWallet') }}</button>
    </div>
</div>

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

        amountInput.addEventListener('input', enableReloadButton);

        amountOptions.addEventListener('click', function(event) {
            if (event.target.tagName === 'BUTTON') {
                const amount = event.target.textContent.replace('RM ', '');
                amountInput.value = amount;
                enableReloadButton();
            }
        });
    });
</script>
@endsection
