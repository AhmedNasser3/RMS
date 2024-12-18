<?php

namespace App\Http\Controllers\admin\payment;

use Illuminate\Http\Request;
use App\Models\admin\bank\Bank;
use App\Http\Controllers\Controller;
use App\Models\admin\payment\Payment;

class PaymentController extends Controller
{
        public function index() {
            $payments = Payment::with('bank')->get();
            return view('admin.payment.index', ['payments' => $payments]);
        }

        public function create() {
            $banks = Bank::all();
            return view('admin.payment.create', compact('banks'));
        }

        public function store(Request $request) {
            Payment::create($request->validate([
                'bank_id' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'before_tax' => 'required|string|max:255',
                'after_tax' => 'required|string|max:255',
                'tax_number' => 'required|string|max:255',
            ]));
            return redirect()->route('admin.payment.index');
        }

        public function edit($paymentId) {
            $payment = Payment::findOrFail($paymentId);
            $banks = Bank::all();
            return view('admin.payment.edit', ['payment' => $payment, 'banks' => $banks]);
        }

        public function update(Request $request, $paymentId) {
            Payment::findOrFail($paymentId)->update($request->validate([
                'bank_id' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'before_tax' => 'required|string|max:255',
                'after_tax' => 'required|string|max:255',
                'tax_number' => 'required|string|max:255',
            ]));
            return redirect()->route('admin.payment.index');
        }

        public function delete($paymentId) {
            Payment::findOrFail($paymentId)->delete();
            return redirect()->route('admin.payment.index');
        }
}
