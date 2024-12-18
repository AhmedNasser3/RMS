@extends('admin.master')

@section('adminContent')
<div class="wage-create-container">
    <h2 class="wage-create-title">تعديل المهمة</h2>
    <form class="wage-create-form" action="{{ route('admin.mission.update', $mission->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- حقل اختيار البنك -->
        <label for="bank-id" style="direction: rtl">اختر البنك:</label>
        <select id="bank-id" name="bank_id" required>
            <option value="" disabled>اختر البنك</option>
            @foreach ($banks as $bank)
            <option value="{{ $bank->id }}" {{ $mission->bank_id == $bank->id ? 'selected' : '' }}>
                {{ $bank->name }}
            </option>
            @endforeach
        </select>

        <!-- حقل السعر -->
        <label for="mission-price" style="direction: rtl">السعر:</label>
        <input type="text" id="mission-price" name="price" value="{{ $mission->price }}" placeholder="السعر" required>

        <!-- حقل السبب -->
        <label for="mission-reason" style="direction: rtl">السبب:</label>
        <input type="text" id="mission-reason" name="reason" value="{{ $mission->reason }}" placeholder="السبب" required>

        <button type="submit">تحديث</button>
    </form>
</div>
@endsection
