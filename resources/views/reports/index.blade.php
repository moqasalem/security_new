@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/reports-index.css') }}">
@endpush



@section('content')
@php
$branches = ['الرياض','جدة','الدمام','مكة'];
$customersLists = ['شركة الراشد التجارية','مؤسسة النخبة','مجموعة الفهد','شركة البناء الحديث','مستشفى الرعاية','فندق القصر','جامعة المعرفة','مصنع الخليج'];
$savedViews = [
    ['name'=>'تقرير شهري - عروض الرياض','type'=>'quotations','updated'=>'2025-02-10'],
    ['name'=>'عقود ساريه - جدة','type'=>'contracts','updated'=>'2025-02-08'],
    ['name'=>'موظفين موقعين','type'=>'employee_contracts','updated'=>'2025-02-05'],
];

$reportQuotations = [
    ['id'=>'QT-001','customer'=>'شركة الراشد التجارية','branch'=>'الرياض','status'=>'معتمد','total'=>'125,000','date'=>'2025-02-10'],
    ['id'=>'QT-002','customer'=>'مؤسسة النخبة','branch'=>'جدة','status'=>'مسودة','total'=>'87,500','date'=>'2025-02-09'],
    ['id'=>'QT-003','customer'=>'مجموعة الفهد','branch'=>'الرياض','status'=>'بانتظار اعتماد','total'=>'210,000','date'=>'2025-02-08'],
    ['id'=>'QT-004','customer'=>'شركة البناء الحديث','branch'=>'الدمام','status'=>'معتمد','total'=>'95,000','date'=>'2025-02-07'],
    ['id'=>'QT-005','customer'=>'مستشفى الرعاية','branch'=>'مكة','status'=>'مرفوض','total'=>'340,000','date'=>'2025-02-06'],
    ['id'=>'QT-006','customer'=>'فندق القصر','branch'=>'الرياض','status'=>'معتمد','total'=>'178,000','date'=>'2025-02-05'],
    ['id'=>'QT-007','customer'=>'جامعة المعرفة','branch'=>'جدة','status'=>'منتهي','total'=>'65,000','date'=>'2025-02-04'],
    ['id'=>'QT-008','customer'=>'مصنع الخليج','branch'=>'الدمام','status'=>'بانتظار اعتماد','total'=>'420,000','date'=>'2025-02-03'],
    ['id'=>'QT-009','customer'=>'شركة الراشد التجارية','branch'=>'الرياض','status'=>'معتمد','total'=>'55,000','date'=>'2025-02-02'],
    ['id'=>'QT-010','customer'=>'مؤسسة النخبة','branch'=>'جدة','status'=>'مسودة','total'=>'112,000','date'=>'2025-02-01'],
    ['id'=>'QT-011','customer'=>'مجموعة الفهد','branch'=>'الرياض','status'=>'معتمد','total'=>'88,000','date'=>'2025-01-30'],
    ['id'=>'QT-012','customer'=>'شركة البناء الحديث','branch'=>'الدمام','status'=>'بانتظار اعتماد','total'=>'195,000','date'=>'2025-01-28'],
];
$reportContracts = [
    ['id'=>'CT-001','customer'=>'شركة الراشد التجارية','branch'=>'الرياض','status'=>'ساري','start'=>'2025-01-01','end'=>'2025-12-31','value'=>'1,200,000'],
    ['id'=>'CT-002','customer'=>'مؤسسة النخبة','branch'=>'جدة','status'=>'جاري التوقيع','start'=>'2025-02-01','end'=>'2026-01-31','value'=>'850,000'],
    ['id'=>'CT-003','customer'=>'مجموعة الفهد','branch'=>'الرياض','status'=>'ساري','start'=>'2024-06-01','end'=>'2025-05-31','value'=>'2,100,000'],
    ['id'=>'CT-004','customer'=>'شركة البناء الحديث','branch'=>'الدمام','status'=>'منتهي','start'=>'2024-01-01','end'=>'2024-12-31','value'=>'760,000'],
    ['id'=>'CT-005','customer'=>'مستشفى الرعاية','branch'=>'مكة','status'=>'ساري','start'=>'2025-01-15','end'=>'2026-01-14','value'=>'3,400,000'],
    ['id'=>'CT-006','customer'=>'فندق القصر','branch'=>'الرياض','status'=>'جديد','start'=>'2025-03-01','end'=>'2026-02-28','value'=>'1,780,000'],
    ['id'=>'CT-007','customer'=>'جامعة المعرفة','branch'=>'جدة','status'=>'ساري','start'=>'2024-09-01','end'=>'2025-08-31','value'=>'650,000'],
    ['id'=>'CT-008','customer'=>'مصنع الخليج','branch'=>'الدمام','status'=>'جاري التوقيع','start'=>'2025-02-15','end'=>'2026-02-14','value'=>'920,000'],
];
$reportEmployeeContracts = [
    ['id'=>'EC-001','employee'=>'عبدالله الحربي','idnum'=>'1098765432','site'=>'مجمع الراشد','status'=>'تم التوقيع','action'=>'توقيع 2025-02-10'],
    ['id'=>'EC-002','employee'=>'محمد العتيبي','idnum'=>'1087654321','site'=>'برج المملكة','status'=>'تم الإرسال','action'=>'إرسال 2025-02-09'],
    ['id'=>'EC-003','employee'=>'فهد القحطاني','idnum'=>'1076543210','site'=>'مركز التسوق','status'=>'تم الإنشاء','action'=>'إنشاء 2025-02-08'],
    ['id'=>'EC-004','employee'=>'خالد الشمري','idnum'=>'1065432109','site'=>'فندق الفخامة','status'=>'تم التوقيع','action'=>'توقيع 2025-02-07'],
    ['id'=>'EC-005','employee'=>'سعد المطيري','idnum'=>'1054321098','site'=>'مستشفى العناية','status'=>'مؤرشف','action'=>'أرشفة 2025-02-06'],
    ['id'=>'EC-006','employee'=>'يوسف الدوسري','idnum'=>'1043210987','site'=>'جامعة المستقبل','status'=>'تم الإرسال','action'=>'إرسال 2025-02-05'],
    ['id'=>'EC-007','employee'=>'عمر الزهراني','idnum'=>'1032109876','site'=>'مجمع الراشد','status'=>'تم التوقيع','action'=>'توقيع 2025-02-04'],
    ['id'=>'EC-008','employee'=>'أحمد السبيعي','idnum'=>'1021098765','site'=>'برج المملكة','status'=>'تم الإنشاء','action'=>'إنشاء 2025-02-03'],
    ['id'=>'EC-009','employee'=>'بندر العنزي','idnum'=>'1010987654','site'=>'مركز المعارض','status'=>'تم التوقيع','action'=>'توقيع 2025-02-02'],
    ['id'=>'EC-010','employee'=>'ناصر الغامدي','idnum'=>'1009876543','site'=>'شركة الطاقة','status'=>'تم الإرسال','action'=>'إرسال 2025-02-01'],
];
$reportCustomers = [
    ['code'=>'CU-001','name'=>'شركة الراشد التجارية','sector'=>'تجاري','status'=>'نشط','quotes'=>12,'contracts'=>3],
    ['code'=>'CU-002','name'=>'مؤسسة النخبة','sector'=>'مقاولات','status'=>'نشط','quotes'=>8,'contracts'=>2],
    ['code'=>'CU-003','name'=>'مجموعة الفهد','sector'=>'عقاري','status'=>'نشط','quotes'=>15,'contracts'=>4],
    ['code'=>'CU-004','name'=>'شركة البناء الحديث','sector'=>'صناعي','status'=>'نشط','quotes'=>6,'contracts'=>1],
    ['code'=>'CU-005','name'=>'مستشفى الرعاية','sector'=>'صحي','status'=>'نشط','quotes'=>3,'contracts'=>1],
    ['code'=>'CU-006','name'=>'فندق القصر','sector'=>'ضيافة','status'=>'مؤرشف','quotes'=>9,'contracts'=>2],
    ['code'=>'CU-007','name'=>'جامعة المعرفة','sector'=>'تعليمي','status'=>'نشط','quotes'=>4,'contracts'=>1],
    ['code'=>'CU-008','name'=>'مصنع الخليج','sector'=>'صناعي','status'=>'نشط','quotes'=>7,'contracts'=>2],
];
@endphp

<div class="reports-page report-print-area">

    {{-- Header --}}
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">التقارير</h1>
            <nav class="breadcrumb" aria-label="breadcrumb"><a href="{{ route('dashboard') }}">الرئيسية</a><span>/</span><span>التقارير</span></nav>
        </div>
        <div class="page-header__right no-print">
            <button class="btn btn--outline" id="btnRefreshReport" aria-label="تحديث"><svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg> تحديث</button>
            <button class="btn btn--outline" id="btnSaveReportView" aria-label="حفظ العرض"><svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z"/></svg> حفظ العرض</button>
            <button class="btn btn--outline" id="btnOpenSavedReports" aria-label="العروض المحفوظة"><svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/></svg> المحفوظة</button>
            <div class="dropdown-wrap" id="exportDropdown">
                <button class="btn btn--outline" id="btnExportReport" aria-label="تصدير" aria-expanded="false"><svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/></svg> تصدير</button>
                <div class="dropdown-menu" id="exportMenu">
                    <button class="dropdown-item" data-export="pdf"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg> تصدير PDF</button>
                    <button class="dropdown-item" data-export="excel"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm1 8a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg> تصدير Excel</button>
                </div>
            </div>
            <button class="btn btn--outline" id="btnPrintReport" aria-label="طباعة"><svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"/></svg> طباعة</button>
        </div>
    </div>

    {{-- Report Switcher --}}
    <div class="report-switcher no-print" id="reportSwitcher">
        <button class="report-tab active" data-report="quotations"><svg width="22" height="22" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg><span>عروض الأسعار</span><small id="countQuotations">{{ count($reportQuotations) }}</small></button>
        <button class="report-tab" data-report="contracts"><svg width="22" height="22" viewBox="0 0 20 20" fill="currentColor"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg><span>العقود</span><small id="countContracts">{{ count($reportContracts) }}</small></button>
        <button class="report-tab" data-report="employee_contracts"><svg width="22" height="22" viewBox="0 0 20 20" fill="currentColor"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/></svg><span>عقود الموظفين</span><small id="countEmpContracts">{{ count($reportEmployeeContracts) }}</small></button>
        <button class="report-tab" data-report="customers"><svg width="22" height="22" viewBox="0 0 20 20" fill="currentColor"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg><span>العملاء</span><small id="countCustomers">{{ count($reportCustomers) }}</small></button>
    </div>

    {{-- Filters --}}
    <div class="filter-card no-print" id="filterPanel">
        <div class="filter-grid">
            <div class="filter-group">
                <label class="filter-label">الفترة</label>
                <select class="filter-select" id="filterPeriod"><option value="today">اليوم</option><option value="week">هذا الأسبوع</option><option value="month" selected>هذا الشهر</option><option value="custom">مخصص</option></select>
            </div>
            <div class="filter-group" id="customDateGroup" style="display:none;">
                <label class="filter-label">من</label>
                <input type="date" class="filter-input" id="filterDateFrom">
            </div>
            <div class="filter-group" id="customDateGroupTo" style="display:none;">
                <label class="filter-label">إلى</label>
                <input type="date" class="filter-input" id="filterDateTo">
            </div>
            <div class="filter-group">
                <label class="filter-label">الفرع</label>
                <select class="filter-select" id="filterBranch"><option value="">الكل</option>@foreach($branches as $b)<option value="{{ $b }}">{{ $b }}</option>@endforeach</select>
            </div>
            <div class="filter-group" id="filterCustomerGroup">
                <label class="filter-label">العميل</label>
                <select class="filter-select" id="filterCustomer"><option value="">الكل</option>@foreach($customersLists as $c)<option value="{{ $c }}">{{ $c }}</option>@endforeach</select>
            </div>
            <div class="filter-group">
                <label class="filter-label">الحالة</label>
                <select class="filter-select" id="filterStatus"><option value="">الكل</option></select>
            </div>
        </div>
        <div class="filter-actions">
            <label class="toggle-label"><input type="checkbox" id="btnToggleCompare"><span class="toggle-slider"></span> مقارنة بالفترة السابقة</label>
            <div class="filter-btns">
                <button class="btn btn--primary btn--sm" id="btnApplyFilters"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/></svg> تطبيق</button>
                <button class="btn btn--outline btn--sm" id="btnResetFilters">مسح</button>
            </div>
        </div>
    </div>

    {{-- KPI Cards --}}
    <div class="kpi-grid" id="kpiGrid">
        <div class="kpi-card" id="kpi1"><div class="kpi-card__value" id="kpiVal1">12</div><div class="kpi-card__label" id="kpiLabel1">إجمالي العروض</div><div class="kpi-card__change kpi-up" id="kpiChange1">▲ 18%</div></div>
        <div class="kpi-card" id="kpi2"><div class="kpi-card__value" id="kpiVal2">3</div><div class="kpi-card__label" id="kpiLabel2">بانتظار اعتماد</div><div class="kpi-card__change kpi-down" id="kpiChange2">▼ 5%</div></div>
        <div class="kpi-card" id="kpi3"><div class="kpi-card__value" id="kpiVal3">2,420,500</div><div class="kpi-card__label" id="kpiLabel3">قيمة العروض (ر.س)</div><div class="kpi-card__change kpi-up" id="kpiChange3">▲ 12%</div></div>
        <div class="kpi-card" id="kpi4"><div class="kpi-card__value" id="kpiVal4">42%</div><div class="kpi-card__label" id="kpiLabel4">معدل التحويل</div><div class="kpi-card__change kpi-up" id="kpiChange4">▲ 3%</div></div>
    </div>

    {{-- Charts --}}
    <div class="charts-grid">
        <div class="chart-card">
            <h3 class="chart-card__title">الاتجاه خلال الفترة</h3>
            <div class="chart-placeholder" id="chartTrend">
                <svg viewBox="0 0 400 120" class="sparkline"><polyline fill="none" stroke="#2563eb" stroke-width="2.5" points="0,80 30,65 60,70 90,45 120,55 150,30 180,40 210,25 240,35 270,20 300,30 330,15 360,22 390,10"/><polyline fill="url(#grad)" stroke="none" points="0,80 30,65 60,70 90,45 120,55 150,30 180,40 210,25 240,35 270,20 300,30 330,15 360,22 390,10 390,120 0,120"/><defs><linearGradient id="grad" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#2563eb" stop-opacity="0.2"/><stop offset="100%" stop-color="#2563eb" stop-opacity="0"/></linearGradient></defs></svg>
            </div>
        </div>
        <div class="chart-card">
            <h3 class="chart-card__title">توزيع الحالات</h3>
            <div class="chart-placeholder" id="chartDonut">
                <svg viewBox="0 0 160 160" class="donut-chart"><circle cx="80" cy="80" r="60" fill="none" stroke="#e2e8f0" stroke-width="20"/><circle cx="80" cy="80" r="60" fill="none" stroke="#2563eb" stroke-width="20" stroke-dasharray="140 377" stroke-dashoffset="0" transform="rotate(-90 80 80)"/><circle cx="80" cy="80" r="60" fill="none" stroke="#16a34a" stroke-width="20" stroke-dasharray="95 377" stroke-dashoffset="-140" transform="rotate(-90 80 80)"/><circle cx="80" cy="80" r="60" fill="none" stroke="#f59e0b" stroke-width="20" stroke-dasharray="75 377" stroke-dashoffset="-235" transform="rotate(-90 80 80)"/><circle cx="80" cy="80" r="60" fill="none" stroke="#94a3b8" stroke-width="20" stroke-dasharray="67 377" stroke-dashoffset="-310" transform="rotate(-90 80 80)"/><text x="80" y="76" text-anchor="middle" font-size="20" font-weight="700" fill="#0f172a">12</text><text x="80" y="94" text-anchor="middle" font-size="10" fill="#94a3b8">إجمالي</text></svg>
                <div class="donut-legend"><span class="legend-dot" style="background:#2563eb"></span>معتمد<span class="legend-dot" style="background:#16a34a"></span>ساري<span class="legend-dot" style="background:#f59e0b"></span>انتظار<span class="legend-dot" style="background:#94a3b8"></span>أخرى</div>
            </div>
        </div>
    </div>

    {{-- Compare Bar (hidden by default) --}}
    <div class="compare-card" id="compareSection" style="display:none;">
        <h3 class="chart-card__title">مقارنة بالفترة السابقة</h3>
        <div class="compare-bars">
            <div class="compare-row"><span class="compare-label">الفترة الحالية</span><div class="compare-bar"><div class="compare-fill compare-fill--current" style="width:72%"></div></div><span class="compare-val">72%</span></div>
            <div class="compare-row"><span class="compare-label">الفترة السابقة</span><div class="compare-bar"><div class="compare-fill compare-fill--prev" style="width:58%"></div></div><span class="compare-val">58%</span></div>
        </div>
    </div>

    {{-- Results Table --}}
    <div class="table-card">
        <div class="table-card__header">
            <h3 class="table-card__title">النتائج</h3>
            <div class="table-card__meta"><span id="resultCount">12</span> نتيجة</div>
        </div>
        <div class="table-scroll">
            <table class="data-table" id="resultsTable">
                <thead id="tableHead"></thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
        <div class="empty-state" id="emptyState" style="display:none;">
            <svg width="48" height="48" viewBox="0 0 20 20" fill="#cbd5e1"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
            <p>لا توجد نتائج مطابقة للفلاتر المحددة</p>
            <button class="btn btn--outline btn--sm" id="btnClearEmpty">مسح الفلاتر</button>
        </div>
        <div class="table-pagination no-print" id="paginationWrap">
            <div class="page-size"><label>عرض:</label><select id="pageSize"><option value="10" selected>10</option><option value="25">25</option><option value="50">50</option></select></div>
            <div class="page-nav" id="pageNav"></div>
        </div>
    </div>
</div>

{{-- Drawer: Saved Reports --}}
<div class="drawer" id="savedDrawer">
    <div class="drawer__overlay"></div>
    <div class="drawer__panel">
        <div class="drawer__header"><h2>العروض المحفوظة</h2><button class="drawer__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button></div>
        <div class="drawer__body" id="savedList">
            @foreach($savedViews as $sv)
            <div class="saved-item" data-view='@json($sv)'>
                <div class="saved-item__info"><strong>{{ $sv['name'] }}</strong><small>{{ $sv['type'] }} · {{ $sv['updated'] }}</small></div>
                <div class="saved-item__actions"><button class="btn btn--primary btn--xs" data-action="apply-view">تطبيق</button><button class="btn btn--text btn--xs" data-action="delete-view" aria-label="حذف">✕</button></div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Modal: Save View --}}
<div class="modal" id="saveModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header"><h2 class="modal__title">حفظ العرض الحالي</h2><button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button></div>
        <div class="modal__body">
            <div class="form-group"><label class="form-label">اسم العرض <span class="req">*</span></label><input type="text" id="saveViewName" class="form-input" placeholder="مثال: تقرير شهري - الرياض" required></div>
            <div class="form-group"><label class="form-label">ملاحظة</label><textarea id="saveViewNote" class="form-textarea" rows="2" placeholder="ملاحظة اختيارية..."></textarea></div>
            <div class="form-group"><label class="checkbox-label"><input type="checkbox" id="saveViewDefault"> تثبيت كافتراضي</label></div>
        </div>
        <div class="modal__footer"><button class="btn btn--outline modal__close">إلغاء</button><button class="btn btn--primary" id="confirmSaveView">حفظ</button></div>
    </div>
</div>

{{-- Toast --}}
<div class="toast" id="toast" role="status" aria-live="polite"><svg class="toast__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg><span class="toast__message" id="toastMessage"></span></div>
<script>
    window.__REPORT_TABLE_DATA = {
        quotations: @json($reportQuotations),
        contracts: @json($reportContracts),
        employee_contracts: @json($reportEmployeeContracts),
        customers: @json($reportCustomers)
    };
</script>
@endsection

