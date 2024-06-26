<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('customer.pages.payment.method');
    }

    public function showPaymentMethod()
    {
        return view('payment.method');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(payment $payment)
    {
        //
    }

    public function process(Request $request)
    {
        // Handle payment processing here
        // Validate and process the payment details
        // Redirect or respond accordingly
    }

    public function debit()
{
    return view('customer.pages.payment.debit');
}

public function ewallet()
{
    return view('customer.pages.payment.ewallet');
}

public function qr()
{
    return view('customer.pages.payment.qr');
}

}
