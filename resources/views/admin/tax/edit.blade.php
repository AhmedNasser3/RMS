@extends('admin.master')

@section('adminContent')
<div class="wage-create-container">
    <h2 class="wage-create-title">تعديل الضريبة</h2>
    <form class="wage-create-form" action="{{ route('admin.tax.update', $tax->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- حقل اختيار البنك -->
        <label for="bank-id" style="direction: rtl">اختر البنك:</label>
        <select id="bank-id" name="bank_id" required>
            <option value="" disabled>اختر البنك</option>
            @foreach ($banks as $bank)
            <option value="{{ $bank->id }}" {{ $tax->bank_id == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
            @endforeach
        </select>

        <!-- حقل السعر -->
        <label for="tax-price" style="direction: rtl">السعر:</label>
        <input type="text" id="tax-price" name="price" value="{{ $tax->price }}" placeholder="السعر" required>

        <button type="submit">تحديث</button>
    </form>
</div>
@endsection
