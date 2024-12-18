@extends('admin.master')

@section('adminContent')
<div class="wage-create-container">
    <h2 class="wage-create-title">إضافة زكاة جديدة</h2>
    <form class="wage-create-form" action="{{ route('admin.charity.store') }}" method="POST">
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
        <label for="charity-price" style="direction: rtl">مبلغ الزكاة:</label>
        <input type="text" id="charity-price" name="price" placeholder="المبلغ" required>

        <button type="submit">إنشاء</button>
    </form>
</div>
@endsection
