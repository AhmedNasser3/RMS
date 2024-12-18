@extends('admin.master')

@section('adminContent')
<div class="wage-create-container">
    <h2 class="wage-create-title">إضافة مهمة جديدة</h2>
    <form class="wage-create-form" action="{{ route('admin.mission.store') }}" method="POST">
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
        <label for="mission-price" style="direction: rtl">السعر:</label>
        <input type="text" id="mission-price" name="price" placeholder="السعر" required>

        <!-- حقل السبب -->
        <label for="mission-reason" style="direction: rtl">السبب:</label>
        <input type="text" id="mission-reason" name="reason" placeholder="السبب" required>

        <button type="submit">إنشاء</button>
    </form>
</div>
@endsection
