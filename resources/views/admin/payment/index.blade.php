@extends('admin.master')

@section('adminContent')
<div class="payment">
    <div class="payment_container">
        <div class="payment_content">
            <div class="payment_data">
                <div class="datatable-container">
                    <h2 class="title">قائمة المدفوعات</h2>
                    <div class="payment_box">
                        <button style="background: #6b8f96; padding:10px 20px; border:none; border-radius:10px; margin:0 0 10px 0;">
                            <a style="color: #ffff" href="{{ route('admin.payment.create') }}">إضافة دفعة جديدة</a>
                        </button>
                    </div>
                    <div class="controls">
                        <input type="text" id="searchInput" placeholder="Search by keyword..." class="search-input">
                        <select id="dateFilter" class="filter-select">
                            <option value="all">جميع الوقت</option>
                            <option value="day">اليوم</option>
                            <option value="week">هذا الأسبوع</option>
                            <option value="month">هذا الشهر</option>
                            <option value="year">هذه السنة</option>
                        </select>
                    </div>
                    <div class="table-container">
                        <table id="dataTable" class="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>البنك</th>
                                    <th>اسم الفاتورة</th>
                                    <th>التاريخ</th>
                                    <th>قبل الضريبة</th>
                                    <th>بعد الضريبة</th>
                                    <th>رقم الضريبة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->bank->name }}</td>
                                        <td>{{ $payment->name }}</td>
                                        <td>{{ $payment->created_at }}</td>
                                        <td>{{ $payment->before_tax }}</td>
                                        <td>{{ $payment->after_tax }}</td>
                                        <td>{{ $payment->tax_number }}</td>
                                        <td>
                                            <a href="{{ route('admin.payment.edit', $payment->id) }}" class="btn btn-warning">تعديل</a>
                                            <form action="{{ route('admin.payment.delete', $payment->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.getElementById('table-body');
    const searchInput = document.getElementById('searchInput');
    const dateFilter = document.getElementById('dateFilter');
    const now = new Date();

    // التصفية بناءً على المدخلات
    const filterData = () => {
        const keyword = searchInput.value.toLowerCase();
        const dateOption = dateFilter.value;
        const rows = tableBody.getElementsByTagName('tr');

        Array.from(rows).forEach(row => {
            const name = row.children[2].textContent.toLowerCase();
            const date = new Date(row.children[3].textContent);
            const matchesKeyword = name.includes(keyword);
            let matchesDate = true;

            if (dateOption === 'day') matchesDate = date.toDateString() === now.toDateString();
            if (dateOption === 'week') matchesDate = (now - date) <= 7 * 24 * 60 * 60 * 1000;
            if (dateOption === 'month') matchesDate = date.getMonth() === now.getMonth() && date.getFullYear() === now.getFullYear();
            if (dateOption === 'year') matchesDate = date.getFullYear() === now.getFullYear();

            if (matchesKeyword && matchesDate) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    };

    searchInput.addEventListener('input', filterData);
    dateFilter.addEventListener('change', filterData);
});
</script>
@endpush
