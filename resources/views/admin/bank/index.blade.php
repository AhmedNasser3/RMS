@extends('admin.master')
@section('adminContent')
<div class="bank">
    <div class="bank_container">
        <div class="bank_content">
            <div class="bank_data">
                <div class="datatable-container">
                    <h2 class="title">بنوك جهاد اكاديمي</h2>
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
                            <th>Name</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data dynamically inserted via JavaScript -->
                        </tbody>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
<!-- Hidden input for passing data to JS -->
<input type="hidden" id="bank-data" value='@json($banks)'>
@endsection
@push('scripts')
<script src="{{ asset('js/pages/bank.js') }}"></script>
@endpush
