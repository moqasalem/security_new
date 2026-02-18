@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/contracts-index.css') }}">
@endpush



@section('content')
<div class="contracts-page">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">العقود</h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <span>العقود</span>
            </nav>
        </div>
        <div class="page-header__right">
            <button class="btn btn--primary" id="btnCreateContract">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                إنشاء عقد
            </button>
            <button class="btn btn--outline" id="btnConvertFromQuotation">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"/>
                    <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"/>
                </svg>
                تحويل من عرض معتمد
            </button>
            <div class="dropdown" id="exportDropdown">
                <button class="btn btn--outline dropdown-toggle" id="btnExportContracts">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    تصدير
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item" data-export="pdf">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                        </svg>
                        تصدير PDF
                    </a>
                    <a href="#" class="dropdown-item" data-export="excel">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm1 4h12v8a1 1 0 01-1 1H5a1 1 0 01-1-1V8z" clip-rule="evenodd"/>
                        </svg>
                        تصدير Excel
                    </a>
                </div>
            </div>
            <button class="btn btn--outline" id="btnRefreshContracts">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                </svg>
                تحديث
            </button>
            <button class="btn btn--text" id="btnResetFilters">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                مسح الفلاتر
            </button>
            <button class="btn btn--outline" id="btnToggleView" title="تبديل العرض">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" data-view-icon="table">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Summary Chips --}}
    <div class="summary-chips">
        <button class="chip-btn active" data-filter="all">
            <span>الكل</span>
            <span class="chip-count" id="countAll">15</span>
        </button>
        <button class="chip-btn" data-filter="new">
            <span>جديد</span>
            <span class="chip-count" id="countNew">3</span>
        </button>
        <button class="chip-btn" data-filter="signing">
            <span>جاري التوقيع</span>
            <span class="chip-count" id="countSigning">3</span>
        </button>
        <button class="chip-btn" data-filter="active">
            <span>ساري</span>
            <span class="chip-count" id="countActive">6</span>
        </button>
        <button class="chip-btn" data-filter="closed">
            <span>منتهي/مغلق</span>
            <span class="chip-count" id="countClosed">3</span>
        </button>
    </div>

    {{-- Toolbar --}}
    <div class="toolbar">
        <div class="toolbar__search">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
            </svg>
            <input type="text" id="searchInput" class="toolbar__input" placeholder="ابحث برقم العقد أو العميل أو الفرع...">
        </div>
        <div class="toolbar__filters">
            <select id="filterBranch" class="filter-select">
                <option value="">جميع الفروع</option>
                <option value="الرياض">الرياض</option>
                <option value="جدة">جدة</option>
                <option value="الدمام">الدمام</option>
                <option value="مكة">مكة</option>
            </select>
            <select id="filterStatus" class="filter-select">
                <option value="">جميع الحالات</option>
                <option value="new">جديد</option>
                <option value="signing">جاري التوقيع</option>
                <option value="active">ساري</option>
                <option value="closed">منتهي/مغلق</option>
            </select>
            <label class="toggle-filter">
                <input type="checkbox" id="filterExpiringSoon">
                <span>قريب الانتهاء</span>
            </label>
            <div class="dropdown" id="columnPickerDropdown">
                <button class="btn btn--outline dropdown-toggle" id="btnColumnPicker">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                    </svg>
                    الأعمدة
                </button>
                <div class="dropdown-menu column-picker-menu">
                    <label class="column-option">
                        <input type="checkbox" value="number" checked>
                        <span>رقم العقد</span>
                    </label>
                    <label class="column-option">
                        <input type="checkbox" value="customer" checked>
                        <span>العميل</span>
                    </label>
                    <label class="column-option">
                        <input type="checkbox" value="branch" checked>
                        <span>الفرع</span>
                    </label>
                    <label class="column-option">
                        <input type="checkbox" value="status" checked>
                        <span>الحالة</span>
                    </label>
                    <label class="column-option">
                        <input type="checkbox" value="start_date" checked>
                        <span>تاريخ البداية</span>
                    </label>
                    <label class="column-option">
                        <input type="checkbox" value="end_date" checked>
                        <span>تاريخ النهاية</span>
                    </label>
                    <label class="column-option">
                        <input type="checkbox" value="days_left" checked>
                        <span>الأيام المتبقية</span>
                    </label>
                    <label class="column-option">
                        <input type="checkbox" value="total" checked>
                        <span>القيمة الإجمالية</span>
                    </label>
                    <label class="column-option">
                        <input type="checkbox" value="updated_at" checked>
                        <span>آخر تحديث</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- Table View --}}
    <div class="table-view active" id="tableView">
        <div class="table-card">
            <div class="table-wrapper" id="tableWrapper">
                {{-- Loading Skeleton --}}
                <div class="loading-skeleton" id="loadingSkeleton" style="display: none;">
                    <div class="skeleton-row" style="--delay: 0s;"></div>
                    <div class="skeleton-row" style="--delay: 0.1s;"></div>
                    <div class="skeleton-row" style="--delay: 0.2s;"></div>
                    <div class="skeleton-row" style="--delay: 0.3s;"></div>
                    <div class="skeleton-row" style="--delay: 0.4s;"></div>
                </div>

                <table class="contracts-table" id="contractsTable">
                    <thead>
                        <tr>
                            <th data-column="number">رقم العقد</th>
                            <th data-column="customer">العميل</th>
                            <th data-column="branch">الفرع</th>
                            <th data-column="status">الحالة</th>
                            <th data-column="start_date">تاريخ البداية</th>
                            <th data-column="end_date">تاريخ النهاية</th>
                            <th data-column="days_left">الأيام المتبقية</th>
                            <th data-column="total">القيمة الإجمالية</th>
                            <th data-column="updated_at">آخر تحديث</th>
                            <th>إجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        {{-- Will be populated by JS --}}
                    </tbody>
                </table>

                {{-- Empty State --}}
                <div class="empty-state" id="emptyState" style="display: none;">
                    <svg width="120" height="120" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                    <h3>لا توجد عقود</h3>
                    <p>لم يتم العثور على عقود مطابقة للفلاتر المحددة</p>
                    <button class="btn btn--outline" id="emptyStateClear">مسح الفلاتر</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Cards View --}}
    <div class="cards-view" id="cardsView" style="display: none;">
        <div class="contracts-grid" id="contractsGrid">
            {{-- Will be populated by JS --}}
        </div>
        
        {{-- Empty State for Cards --}}
        <div class="empty-state" id="emptyStateCards" style="display: none;">
            <svg width="120" height="120" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
            </svg>
            <h3>لا توجد عقود</h3>
            <p>لم يتم العثور على عقود مطابقة للفلاتر المحددة</p>
            <button class="btn btn--outline" onclick="document.getElementById('btnResetFilters').click()">مسح الفلاتر</button>
        </div>
    </div>
</div>

{{-- Details Drawer --}}
<div class="drawer" id="detailsDrawer">
    <div class="drawer__overlay"></div>
    <div class="drawer__content">
        <div class="drawer__header">
            <h2 class="drawer__title" id="drawerTitle">تفاصيل العقد</h2>
            <button class="drawer__close" aria-label="إغلاق">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="drawer__tabs">
            <button class="drawer__tab active" data-tab="data">البيانات</button>
            <button class="drawer__tab" data-tab="attachments">المرفقات</button>
            <button class="drawer__tab" data-tab="statusLog">سجل الحالة</button>
        </div>
        <div class="drawer__body" id="drawerBody">
            {{-- Tab content will be populated by JS --}}
        </div>
        <div class="drawer__footer">
            <button class="btn btn--primary" data-action="download-drawer">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                تحميل PDF
            </button>
            <button class="btn btn--outline" data-action="print-drawer">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"/>
                </svg>
                طباعة
            </button>
            <button class="btn btn--outline" data-action="status-drawer">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                تغيير الحالة
            </button>
        </div>
    </div>
</div>

{{-- Modal: Create Contract --}}
<div class="modal" id="createContractModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header">
            <h2 class="modal__title">إنشاء عقد جديد</h2>
            <button class="modal__close" aria-label="إغلاق">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="modal__body">
            <div class="form-group">
                <label class="form-label">العميل <span class="required">*</span></label>
                <select id="createCustomer" class="form-select">
                    <option value="">اختر العميل</option>
                    <option value="شركة الأمن المتطور">شركة الأمن المتطور</option>
                    <option value="مؤسسة الحماية الذكية">مؤسسة الحماية الذكية</option>
                    <option value="شركة الخدمات المتكاملة">شركة الخدمات المتكاملة</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">الفرع <span class="required">*</span></label>
                <select id="createBranch" class="form-select">
                    <option value="">اختر الفرع</option>
                    <option value="الرياض">الرياض</option>
                    <option value="جدة">جدة</option>
                    <option value="الدمام">الدمام</option>
                    <option value="مكة">مكة</option>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">تاريخ البداية <span class="required">*</span></label>
                    <input type="date" id="createStartDate" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">تاريخ النهاية <span class="required">*</span></label>
                    <input type="date" id="createEndDate" class="form-input">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">ملاحظات</label>
                <textarea id="createNotes" class="form-textarea" rows="3"></textarea>
            </div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline modal__close">إلغاء</button>
            <button class="btn btn--primary" id="confirmCreateBtn">إنشاء العقد</button>
        </div>
    </div>
</div>

{{-- Modal: Convert from Quotation --}}
<div class="modal" id="convertQuotationModal">
    <div class="modal__overlay"></div>
    <div class="modal__content modal__content--lg">
        <div class="modal__header">
            <h2 class="modal__title">تحويل من عرض معتمد</h2>
            <button class="modal__close">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="modal__body">
            <p>اختر عرض سعر معتمد لتحويله إلى عقد:</p>
            <div class="quotations-list" id="quotationsList">
                {{-- Will be populated by JS --}}
            </div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline modal__close">إلغاء</button>
            <button class="btn btn--primary" id="confirmConvertBtn" disabled>تحويل إلى عقد</button>
        </div>
    </div>
</div>

{{-- Modal: Change Status --}}
<div class="modal" id="changeStatusModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header">
            <h2 class="modal__title">تغيير حالة العقد</h2>
            <button class="modal__close">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="modal__body">
            <div class="form-group">
                <label class="form-label">الحالة الجديدة <span class="required">*</span></label>
                <select id="newStatus" class="form-select">
                    <option value="">اختر الحالة</option>
                    <option value="new">جديد</option>
                    <option value="signing">جاري التوقيع</option>
                    <option value="active">ساري</option>
                    <option value="closed">منتهي/مغلق</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">ملاحظة</label>
                <textarea id="statusNotes" class="form-textarea" rows="3" placeholder="أضف ملاحظة عن سبب التغيير (اختياري)"></textarea>
            </div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline modal__close">إلغاء</button>
            <button class="btn btn--primary" id="confirmStatusBtn">حفظ التغيير</button>
        </div>
    </div>
</div>

{{-- Modal: Confirmation (Delete/Close) --}}
<div class="modal" id="confirmationModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header">
            <h2 class="modal__title" id="confirmTitle">تأكيد الإجراء</h2>
            <button class="modal__close">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="modal__body">
            <p id="confirmMessage">هل أنت متأكد من هذا الإجراء؟</p>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline modal__close">إلغاء</button>
            <button class="btn btn--danger" id="confirmActionBtn">تأكيد</button>
        </div>
    </div>
</div>

{{-- Toast Notification --}}
<div class="toast" id="toast" role="status" aria-live="polite">
    <svg class="toast__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
    </svg>
    <span class="toast__message" id="toastMessage">تمت العملية بنجاح</span>
</div>
@endsection

