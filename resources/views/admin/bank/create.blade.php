@extends('admin.master')
@section('adminContent')
<div class="bank-create-container">
    <h2 class="bank-create-title">معلومات البنك</h2>
    <form class="bank-create-form" action="{{ route('admin.bank.store') }}" method="POST">
        @csrf
        <label for="bank-name" style="direction: rtl">اسم البنك:</label>
        <input type="text" id="bank-name" name="name" placeholder="اسم البنك" required>
        <button type="submit">انشيئ</button>
    </form>
</div>
@endsection
