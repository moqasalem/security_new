@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/attendance-index.css') }}">
@endpush



@section('title', 'الحضور والانصراف')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-header__right">
        <h1 class="page-title">
            <svg width="28" height="28" viewBox="0 0 20 20" fill="currentColor" style="color:var(--brand)">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
            </svg>
            الحضور والانصراف
        </h1>
        <span class="page-subtitle" id="attDate"></span>
    </div>
    <div class="page-header__left">
        <div class="att-date-nav">
            <button class="att-date-nav__btn" id="prevDay" title="اليوم السابق">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
            </button>
            <input type="date" id="attDatePicker" class="att-date-picker">
            <button class="att-date-nav__btn" id="nextDay" title="اليوم التالي">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
            </button>
            <button class="btn btn--ghost" id="btnToday">اليوم</button>
        </div>
    </div>
</div>

<!-- KPI Cards -->
<div class="att-kpi-row" id="kpiRow">
    <div class="att-kpi" data-filter="all">
        <div class="att-kpi__icon att-kpi__icon--brand">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
        </div>
        <div class="att-kpi__data">
            <div class="att-kpi__value" id="kpiTotal">0</div>
            <div class="att-kpi__label">إجمالي الموظفين</div>
        </div>
    </div>
    <div class="att-kpi" data-filter="present">
        <div class="att-kpi__icon att-kpi__icon--green">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        </div>
        <div class="att-kpi__data">
            <div class="att-kpi__value" id="kpiPresent">0</div>
            <div class="att-kpi__label">حاضرون</div>
        </div>
    </div>
    <div class="att-kpi" data-filter="absent">
        <div class="att-kpi__icon att-kpi__icon--red">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
        </div>
        <div class="att-kpi__data">
            <div class="att-kpi__value" id="kpiAbsent">0</div>
            <div class="att-kpi__label">غائبون</div>
        </div>
    </div>
    <div class="att-kpi" data-filter="leave">
        <div class="att-kpi__icon att-kpi__icon--amber">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
        </div>
        <div class="att-kpi__data">
            <div class="att-kpi__value" id="kpiLeave">0</div>
            <div class="att-kpi__label">في إجازة</div>
        </div>
    </div>
    <div class="att-kpi" data-filter="late">
        <div class="att-kpi__icon att-kpi__icon--orange">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
        </div>
        <div class="att-kpi__data">
            <div class="att-kpi__value" id="kpiLate">0</div>
            <div class="att-kpi__label">متأخرون</div>
        </div>
    </div>
</div>

<!-- Toolbar -->
<div class="toolbar">
    <div class="toolbar__right">
        <div class="toolbar__search">
            <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
            <input type="text" id="searchInput" placeholder="بحث عن موظف..." class="toolbar__search-input">
        </div>
    </div>
    <div class="toolbar__left">
        <select id="filterSite" class="toolbar__select">
            <option value="">كل المواقع</option>
        </select>
        <div class="toolbar__view-toggle">
            <button class="toolbar__view-btn active" id="viewTable" title="عرض جدول">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z" clip-rule="evenodd"/></svg>
            </button>
            <button class="toolbar__view-btn" id="viewCards" title="عرض بطاقات">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            </button>
        </div>
    </div>
</div>

<!-- Attendance Table -->
<div class="att-table-wrap" id="tableWrap">
    <table class="att-table">
        <thead>
            <tr>
                <th>#</th>
                <th>الموظف</th>
                <th>الموقع</th>
                <th>وقت الحضور</th>
                <th>وقت الانصراف</th>
                <th>الحالة</th>
                <th>ملاحظات</th>
            </tr>
        </thead>
        <tbody id="attTableBody"></tbody>
    </table>
</div>

<!-- Attendance Cards -->
<div class="att-cards-grid" id="cardsGrid" style="display:none"></div>

<!-- Empty State -->
<div class="empty-state" id="emptyState" style="display:none">
    <svg width="64" height="64" viewBox="0 0 20 20" fill="currentColor" style="color:#cbd5e1">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
    </svg>
    <h3>لا توجد سجلات</h3>
    <p>لم يتم العثور على سجلات حضور تطابق البحث</p>
</div>

@endsection

