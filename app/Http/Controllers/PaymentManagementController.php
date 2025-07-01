<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentManagementController extends Controller
{
    // Show all payments
    public function index()
    {
        $payments = Payment::with('booking')->latest()->get();
        return view('admin.payments', compact('payments'));
    }

    // Show the edit form
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view('admin.edit-payment', compact('payment'));
    }

    // Update a payment
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string',
            'transaction_id' => 'required|string',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update([
            'amount' => $request->amount,
            'method' => $request->method,
            'transaction_id' => $request->transaction_id,
        ]);

        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully!');
    }

    // Delete a payment
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted successfully!');
    }
}