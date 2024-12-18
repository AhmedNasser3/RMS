@extends('admin.master')

@section('adminContent')
<div class="wage-create-container">
    <h2 class="wage-create-title">تعديل الفاتورة</h2>
    <form class="wage-create-form" action="{{ route('admin.payment.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- حقل اختيار البنك -->
        <label for="bank-id" style="direction: rtl">اختر البنك:</label>
        <select id="bank-id" name="bank_id" required>
            <option value="" disabled>اختر البنك</option>
            @foreach ($banks as $bank)
            <option value="{{ $bank->id }}" {{ $bank->id == $payment->bank_id ? 'selected' : '' }}>{{ $bank->name }}</option>
            @endforeach
        </select>

        <!-- حقل اسم الفاتورة -->
        <label for="payment-name" style="direction: rtl">اسم الفاتورة:</label>
        <input type="text" id="payment-name" name="name" value="{{ $payment->name }}" placeholder="اسم الفاتورة" required>

        <!-- حقل قبل الضريبة -->
        <label for="before-tax" style="direction: rtl">قبل الضريبة:</label>
        <input type="text" id="before-tax" name="before_tax" value="{{ $payment->before_tax }}" placeholder="المبلغ قبل الضريبة" required>

        <!-- حقل بعد الضريبة -->
        <label for="after-tax" style="direction: rtl">بعد الضريبة:</label>
        <input type="text" id="after-tax" name="after_tax" value="{{ $payment->after_tax }}" placeholder="المبلغ بعد الضريبة" required>

        <!-- حقل رقم الضريبة -->
        <label for="tax-number" style="direction: rtl">رقم الضريبة:</label>
        <input type="text" id="tax-number" name="tax_number" value="{{ $payment->tax_number }}" placeholder="رقم الضريبة" required>

        <button type="submit">تحديث</button>
    </form>
</div>
@endsection
