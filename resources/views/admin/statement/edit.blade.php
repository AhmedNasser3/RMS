@extends('admin.master')

@section('adminContent')
<div class="wage-create-container">
    <h2 class="wage-create-title">تعديل البيان</h2>
    <form class="wage-create-form" action="{{ route('admin.statement.update', $statement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- حقل اختيار البنك -->
        <label for="bank-id" style="direction: rtl">اختر البنك:</label>
        <select id="bank-id" name="bank_id" required>
            <option value="" disabled>اختر البنك</option>
            @foreach ($banks as $bank)
                <option value="{{ $bank->id }}" {{ $bank->id == $statement->bank_id ? 'selected' : '' }}>{{ $bank->name }}</option>
            @endforeach
        </select>

        <!-- حقل التاريخ -->
        <label for="date" style="direction: rtl">التاريخ:</label>
        <input type="datetime-local" id="date" name="date" value="{{ $statement->date->format('Y-m-d\TH:i') }}" required>

        <!-- حقل التفاصيل -->
        <label for="detail" style="direction: rtl">التفاصيل:</label>
        <input type="text" id="detail" name="detail" placeholder="التفاصيل" value="{{ $statement->detail }}" required>

        <!-- حقل المدين -->
        <label for="debtor" style="direction: rtl">المدين:</label>
        <input type="text" id="debtor" name="debtor" placeholder="المدين" value="{{ $statement->debtor }}" required>

        <!-- حقل الدائن -->
        <label for="creditor" style="direction: rtl">الدائن:</label>
        <input type="text" id="creditor" name="creditor" placeholder="الدائن" value="{{ $statement->creditor }}" required>

        <!-- حقل السبب -->
        <label for="reason" style="direction: rtl">السبب:</label>
        <select id="reason" name="reason" required>
            <option value="" disabled>اختر السبب</option>
            <option value="استرجاعات" {{ $statement->reason == 'استرجاعات' ? 'selected' : '' }}>استرجاعات</option>
            <option value="تمارة" {{ $statement->reason == 'تمارة' ? 'selected' : '' }}>تمارة</option>
            <option value="تحويل" {{ $statement->reason == 'تحويل' ? 'selected' : '' }}>تحويل</option>
            <option value="رواتب" {{ $statement->reason == 'رواتب' ? 'selected' : '' }}>رواتب</option>
        </select>

        <!-- حقل إضافة سبب يدوي (إن لم يتم اختيار سبب من القائمة) -->
        <label for="custom-reason" style="direction: rtl">أضف سببًا يدويًا (اختياري):</label>
        <input type="text" id="custom-reason" name="custom_reason" placeholder="سبب جديد" value="{{ old('custom_reason') }}">

        <button type="submit">تعديل</button>
    </form>
</div>

<script>
    // إضافة منطق لإظهار/إخفاء خانة إضافة السبب اليدوي بناءً على اختيار السبب
    const reasonSelect = document.getElementById('reason');
    const customReasonInput = document.getElementById('custom-reason');

    reasonSelect.addEventListener('change', () => {
        if (reasonSelect.value === '') {
            customReasonInput.style.display = 'block';
        } else {
            customReasonInput.style.display = 'none';
        }
    });

    // إخفاء خانة إضافة السبب اليدوي عند تحميل الصفحة إذا كان السبب محددًا
    if (reasonSelect.value !== '') {
        customReasonInput.style.display = 'none';
    }
</script>
@endsection
