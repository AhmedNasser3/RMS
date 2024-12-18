@extends('admin.master')

@section('adminContent')
<div class="wage-create-container">
    <h2 class="wage-create-title">تعديل الزكاة</h2>
    <form class="wage-create-form" action="{{ route('admin.charity.update', $charity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- حقل اختيار البنك -->
        <label for="bank-id" style="direction: rtl">اختر البنك:</label>
        <select id="bank-id" name="bank_id" required>
            <option value="" disabled>اختر البنك</option>
            @foreach ($banks as $bank)
                <option value="{{ $bank->id }}" {{ $charity->bank_id == $bank->id ? 'selected' : '' }}>
                    {{ $bank->name }}
                </option>
            @endforeach
        </select>

        <!-- حقل السعر -->
        <label for="charity-price" style="direction: rtl">مبلغ الزكاة:</label>
        <input type="text" id="charity-price" name="price" placeholder="المبلغ" value="{{ $charity->price }}" required>

        <button type="submit">تحديث</button>
    </form>
</div>
@endsection
