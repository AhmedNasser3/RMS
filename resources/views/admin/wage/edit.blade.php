@extends('admin.master')

@section('adminContent')
<div class="wage-create-container">
    <h2 class="wage-create-title">تعديل الأجر</h2>
    <form class="wage-create-form" action="{{ route('admin.wage.update', $wage->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- لضمان أن الطلب هو تحديث -->

        <!-- حقل اختيار البنك -->
        <label for="bank-id" style="direction: rtl">اختر البنك:</label>
        <select id="bank-id" name="bank_id" required>
            <option value="" disabled>اختر البنك</option>
                <option value="{{ $wage->bank->id }}"
                        {{ $wage->bank->id == $wage->bank_id ? 'selected' : '' }}>
                    {{ $wage->bank->name }}
        </select>

        <!-- حقل الاسم -->
        <label for="wage-name" style="direction: rtl">اسم الأجر:</label>
        <input type="text" id="wage-name" name="name" value="{{ $wage->name }}" placeholder="اسم الأجر" required>

        <!-- حقل التاريخ -->
        <label for="wage-date" style="direction: rtl">التاريخ:</label>
        <input type="datetime-local" id="wage-date" name="date" value="{{ date('Y-m-d\TH:i', strtotime($wage->date)) }}" placeholder="التاريخ" required>

        <!-- حقل السعر الأساسي -->
        <label for="wage-bid" style="direction: rtl">السعر الأساسي:</label>
        <input type="text" id="wage-bid" name="bid" value="{{ $wage->bid }}" placeholder="السعر الأساسي" required>

        <!-- حقل سعر الوقت الإضافي -->
        <label for="wage-over-time-bid" style="direction: rtl">سعر الوقت الإضافي:</label>
        <input type="text" id="wage-over-time-bid" name="over_time_bid" value="{{ $wage->over_time_bid }}" placeholder="سعر الوقت الإضافي" required>

        <button type="submit">حفظ التعديلات</button>
    </form>
</div>
@endsection
