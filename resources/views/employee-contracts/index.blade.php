@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/employee-contracts-index.css') }}">
@endpush



@section('content')
<div class="emp-contracts-page">

    {{-- Header --}}
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">عقود الموظفين</h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <span>عقود الموظفين</span>
            </nav>
        </div>
        <div class="page-header__right">
            <button class="btn btn--primary" id="btnCreateEmployeeContract"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg> إنشاء عقد موظف</button>
            <div class="dropdown" id="exportDropdown">
                <button class="btn btn--outline dropdown-toggle" id="btnExportEmployeeContracts"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/></svg> تصدير</button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item" data-export="pdf"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg> تصدير PDF</a>
                    <a href="#" class="dropdown-item" data-export="excel"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm1 4h12v8a1 1 0 01-1 1H5a1 1 0 01-1-1V8z" clip-rule="evenodd"/></svg> تصدير Excel</a>
                </div>
            </div>
            <button class="btn btn--outline" id="btnRefreshEmployeeContracts"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg> تحديث</button>
            <button class="btn btn--text" id="btnResetFilters"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg> مسح الفلاتر</button>
            <button class="btn btn--outline" id="btnToggleView" title="تبديل العرض"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/></svg></button>
        </div>
    </div>

    {{-- Bulk Bar --}}
    <div class="bulk-bar" id="bulkBar" style="display:none;">
        <span id="bulkCount">تم تحديد 0</span>
        <button class="btn btn--primary btn--sm" id="btnBulkSend"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg> إرسال المحدد</button>
        <button class="btn btn--outline btn--sm" id="btnBulkArchive">أرشفة المحدد</button>
        <button class="btn btn--text btn--sm" id="btnClearSelection">إلغاء التحديد</button>
    </div>

    {{-- Summary Chips --}}
    <div class="summary-chips">
        <button class="chip-btn active" data-filter="all"><span>الكل</span><span class="chip-count" id="countAll">18</span></button>
        <button class="chip-btn" data-filter="draft"><span>جديد</span><span class="chip-count" id="countDraft">3</span></button>
        <button class="chip-btn" data-filter="generated"><span>تم الإنشاء</span><span class="chip-count" id="countGenerated">3</span></button>
        <button class="chip-btn" data-filter="sent"><span>تم الإرسال</span><span class="chip-count" id="countSent">4</span></button>
        <button class="chip-btn" data-filter="viewed"><span>تمت المشاهدة</span><span class="chip-count" id="countViewed">2</span></button>
        <button class="chip-btn" data-filter="signed"><span>تم التوقيع</span><span class="chip-count" id="countSigned">4</span></button>
        <button class="chip-btn" data-filter="archived"><span>مؤرشف</span><span class="chip-count" id="countArchived">2</span></button>
    </div>

    {{-- Toolbar --}}
    <div class="toolbar">
        <div class="toolbar__search">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
            <input type="text" id="searchInput" class="toolbar__input" placeholder="ابحث بالاسم أو الهوية/الإقامة أو رقم الجوال...">
        </div>
        <div class="toolbar__filters">
            <select id="filterBranch" class="filter-select"><option value="">جميع الفروع</option><option value="الرياض">الرياض</option><option value="جدة">جدة</option><option value="الدمام">الدمام</option><option value="مكة">مكة</option></select>
            <select id="filterSite" class="filter-select"><option value="">جميع المواقع</option><option value="مجمع الراشد">مجمع الراشد</option><option value="برج المملكة">برج المملكة</option><option value="مركز التسوق الكبير">مركز التسوق الكبير</option><option value="فندق الفخامة">فندق الفخامة</option><option value="مستشفى العناية">مستشفى العناية</option></select>
            <select id="filterStatus" class="filter-select"><option value="">جميع الحالات</option><option value="draft">جديد</option><option value="generated">تم الإنشاء</option><option value="sent">تم الإرسال</option><option value="viewed">تمت المشاهدة</option><option value="signed">تم التوقيع</option><option value="archived">مؤرشف</option></select>
            <div class="dropdown" id="columnPickerDropdown">
                <button class="btn btn--outline btn--sm dropdown-toggle" id="btnColumnPicker"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/></svg> الأعمدة</button>
                <div class="dropdown-menu column-picker-menu">
                    <label class="column-option"><input type="checkbox" value="number" checked><span>رقم العقد</span></label>
                    <label class="column-option"><input type="checkbox" value="employee_name" checked><span>اسم الموظف</span></label>
                    <label class="column-option"><input type="checkbox" value="id_number" checked><span>الهوية/الإقامة</span></label>
                    <label class="column-option"><input type="checkbox" value="phone" checked><span>الجوال</span></label>
                    <label class="column-option"><input type="checkbox" value="title" checked><span>المسمى</span></label>
                    <label class="column-option"><input type="checkbox" value="salary" checked><span>الراتب</span></label>
                    <label class="column-option"><input type="checkbox" value="site" checked><span>موقع العمل</span></label>
                    <label class="column-option"><input type="checkbox" value="start_date" checked><span>تاريخ البداية</span></label>
                    <label class="column-option"><input type="checkbox" value="duration_months" checked><span>مدة العقد</span></label>
                    <label class="column-option"><input type="checkbox" value="status" checked><span>الحالة</span></label>
                    <label class="column-option"><input type="checkbox" value="last_action_text" checked><span>آخر إجراء</span></label>
                </div>
            </div>
        </div>
    </div>

    {{-- Table View --}}
    <div class="view-container" id="tableView">
        <div class="table-card">
            <div class="loading-skeleton" id="loadingSkeleton" style="display:none;">
                <div class="skeleton-row" style="--delay:0s"></div><div class="skeleton-row" style="--delay:.1s"></div><div class="skeleton-row" style="--delay:.2s"></div><div class="skeleton-row" style="--delay:.3s"></div><div class="skeleton-row" style="--delay:.4s"></div>
            </div>
            <div class="table-scroll">
                <table class="data-table" id="dataTable">
                    <thead><tr id="tableHead"></tr></thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>
            <div class="empty-state" id="emptyState" style="display:none;">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="currentColor" style="color:#cbd5e1"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                <h3>لا توجد نتائج</h3>
                <p>لم يتم العثور على عقود مطابقة للفلاتر</p>
                <button class="btn btn--outline" onclick="document.getElementById('btnResetFilters').click()">مسح الفلاتر</button>
            </div>
        </div>
    </div>

    {{-- Cards View --}}
    <div class="view-container" id="cardsView" style="display:none;">
        <div class="cards-grid" id="cardsGrid"></div>
        <div class="empty-state" id="emptyStateCards" style="display:none;">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="currentColor" style="color:#cbd5e1"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
            <h3>لا توجد نتائج</h3>
            <button class="btn btn--outline" onclick="document.getElementById('btnResetFilters').click()">مسح الفلاتر</button>
        </div>
    </div>
</div>

{{-- Drawer --}}
<div class="drawer" id="detailsDrawer">
    <div class="drawer__overlay"></div>
    <div class="drawer__content">
        <div class="drawer__header">
            <h2 class="drawer__title" id="drawerTitle">تفاصيل عقد الموظف</h2>
            <button class="drawer__close" aria-label="إغلاق"><svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
        </div>
        <div class="drawer__tabs">
            <button class="drawer__tab active" data-dtab="info">البيانات</button>
            <button class="drawer__tab" data-dtab="link">الرابط والتوقيع</button>
            <button class="drawer__tab" data-dtab="files">المرفقات</button>
            <button class="drawer__tab" data-dtab="log">السجل</button>
        </div>
        <div class="drawer__body" id="drawerBody"></div>
        <div class="drawer__footer">
            <button class="btn btn--primary btn--sm" data-action="download-drawer"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/></svg> تحميل PDF</button>
            <button class="btn btn--outline btn--sm" data-action="status-drawer">تغيير الحالة</button>
            <button class="btn btn--outline btn--sm" data-action="archive-drawer">أرشفة</button>
        </div>
    </div>
</div>

{{-- Employee Drawer --}}
<div class="emp-drawer" id="employeeDrawer">
    <div class="emp-drawer__overlay"></div>
    <div class="emp-drawer__content">
        <div class="emp-drawer__header">
            <button class="emp-drawer__close" aria-label="إغلاق"><svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
            <div class="emp-drawer__profile">
                <div class="emp-drawer__avatar" id="empDrawerAvatar"></div>
                <h2 class="emp-drawer__name" id="empDrawerName"></h2>
                <span class="emp-drawer__title" id="empDrawerTitle"></span>
            </div>
        </div>
        <div class="emp-drawer__tabs">
            <button class="emp-drawer__tab active" data-emptab="overview">نظرة عامة</button>
            <button class="emp-drawer__tab" data-emptab="tasks">المهام</button>
            <button class="emp-drawer__tab" data-emptab="reports">التقارير</button>
            <div class="emp-drawer__tab-indicator"></div>
        </div>
        <div class="emp-drawer__body" id="empDrawerBody"></div>
    </div>
</div>

{{-- Modal: Create / Edit --}}
<div class="modal" id="createModal">
    <div class="modal__overlay"></div>
    <div class="modal__content modal__content--lg">
        <div class="modal__header">
            <h2 class="modal__title" id="createModalTitle">إنشاء عقد موظف</h2>
            <button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
        </div>
        <div class="modal__body">
            <div class="form-row"><div class="form-group"><label class="form-label">اسم الموظف <span class="req">*</span></label><input id="fName" class="form-input" placeholder="الاسم الكامل"></div><div class="form-group"><label class="form-label">الهوية/الإقامة <span class="req">*</span></label><input id="fIdNumber" class="form-input" placeholder="رقم الهوية"></div></div>
            <div class="form-row"><div class="form-group"><label class="form-label">الجوال <span class="req">*</span></label><input id="fPhone" class="form-input" placeholder="05XXXXXXXX"></div><div class="form-group"><label class="form-label">المسمى الوظيفي</label><select id="fTitle" class="form-select"><option value="حارس أمن">حارس أمن</option><option value="مشرف أمني">مشرف أمني</option></select></div></div>
            <div class="form-row"><div class="form-group"><label class="form-label">الراتب <span class="req">*</span></label><input id="fSalary" class="form-input" type="number" value="4500"></div><div class="form-group"><label class="form-label">موقع العمل</label><input id="fSite" class="form-input" placeholder="اسم الموقع"></div></div>
            <div class="form-row"><div class="form-group"><label class="form-label">تاريخ البداية</label><input id="fStartDate" class="form-input" type="date"></div><div class="form-group"><label class="form-label">مدة العقد (أشهر)</label><select id="fDuration" class="form-select"><option value="12">12 شهر</option><option value="24">24 شهر</option><option value="6">6 أشهر</option></select></div></div>
            <div class="form-group"><label class="form-label">الفرع</label><select id="fBranch" class="form-select"><option value="الرياض">الرياض</option><option value="جدة">جدة</option><option value="الدمام">الدمام</option><option value="مكة">مكة</option></select></div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline modal__close">إلغاء</button>
            <button class="btn btn--primary" id="confirmCreateBtn">إنشاء</button>
        </div>
    </div>
</div>

{{-- Modal: Send --}}
<div class="modal" id="sendModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header">
            <h2 class="modal__title">إرسال العقد</h2>
            <button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
        </div>
        <div class="modal__body">
            <div class="form-group"><label class="form-label">قناة الإرسال</label>
                <div class="channel-options">
                    <label class="channel-opt active"><input type="radio" name="channel" value="whatsapp" checked><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> واتساب</label>
                    <label class="channel-opt"><input type="radio" name="channel" value="email"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg> بريد إلكتروني</label>
                </div>
            </div>
            <div class="form-group"><label class="form-label" id="contactLabel">رقم الجوال</label><input id="sendContact" class="form-input" placeholder="05XXXXXXXX"></div>
            <div class="form-group"><label class="form-label">رسالة مخصصة</label><textarea id="sendMessage" class="form-textarea" rows="3" placeholder="السلام عليكم، مرفق رابط عقد العمل الخاص بكم..."></textarea></div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline modal__close">إلغاء</button>
            <button class="btn btn--primary" id="confirmSendBtn"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg> إرسال</button>
        </div>
    </div>
</div>

{{-- Modal: Change Status --}}
<div class="modal" id="statusModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header"><h2 class="modal__title">تغيير الحالة</h2><button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button></div>
        <div class="modal__body">
            <div class="form-group"><label class="form-label">الحالة الجديدة <span class="req">*</span></label><select id="newStatusSelect" class="form-select"><option value="">اختر</option><option value="generated">تم الإنشاء</option><option value="sent">تم الإرسال</option><option value="viewed">تمت المشاهدة</option><option value="signed">تم التوقيع</option><option value="archived">مؤرشف</option></select></div>
            <div class="form-group"><label class="form-label">ملاحظة</label><textarea id="statusNote" class="form-textarea" rows="2" placeholder="اختياري"></textarea></div>
        </div>
        <div class="modal__footer"><button class="btn btn--outline modal__close">إلغاء</button><button class="btn btn--primary" id="confirmStatusBtn">حفظ</button></div>
    </div>
</div>

{{-- Confirmation Modal --}}
<div class="modal" id="confirmModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header"><h2 class="modal__title" id="confirmTitle">تأكيد</h2><button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button></div>
        <div class="modal__body"><p id="confirmMessage">هل أنت متأكد؟</p></div>
        <div class="modal__footer"><button class="btn btn--outline modal__close">إلغاء</button><button class="btn btn--danger" id="confirmActionBtn">تأكيد</button></div>
    </div>
</div>

{{-- Toast --}}
<div class="toast" id="toast" role="status" aria-live="polite">
    <svg class="toast__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
    <span class="toast__message" id="toastMessage"></span>
</div>
@endsection

