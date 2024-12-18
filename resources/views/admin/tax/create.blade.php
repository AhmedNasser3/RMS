@extends('admin.master')

@section('adminContent')
<div class="wage-create-container">
    <h2 class="wage-create-title">إضافة ضريبة جديدة</h2>
    <form class="wage-create-form" action="{{ route('admin.tax.store') }}" method="POST">
        @csrf

        <!-- حقل اختيار البنك -->
        <label for="bank-id" style="direction: rtl">اختر البنك:</label>
        <select id="bank-id" name="bank_id" required>
            <option value="" disabled selected>اختر البنك</option>
            @foreach ($banks as $bank)
            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
            @endforeach
        </select>

        <!-- حقل السعر -->
        <label for="tax-price" style="direction: rtl">السعر:</label>
        <input type="text" id="tax-price" name="price" placeholder="السعر" required>

        <button type="submit">إنشاء</button>
    </form>
</div>
@endsection
