@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/contracts-show.css') }}">
@endpush



@section('content')
<div class="contract-show-page">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">تفاصيل العقد</h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <a href="{{ route('contracts') }}">العقود</a>
                <span>/</span>
                <span>تفاصيل</span>
            </nav>
        </div>
        <div class="page-header__right">
            <a href="{{ route('contracts') }}" class="btn btn--outline" id="btnBackToContracts">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
                رجوع
            </a>
            <button class="btn btn--outline" id="btnEditContract" data-action="edit">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                تعديل
            </button>
            <button class="btn btn--outline" id="btnDownloadContractPdf">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                تحميل PDF
            </button>
            <button class="btn btn--outline" id="btnPrintContract">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"/></svg>
                طباعة
            </button>
            <button class="btn btn--outline" id="btnCopyContractLink">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 001.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"/></svg>
                نسخ الرابط
            </button>
            <button class="btn btn--primary" id="btnChangeStatus" data-action="change-status">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                تغيير الحالة
            </button>
            <button class="btn btn--outline btn--warning" id="btnCloseContract" data-action="close-contract">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                إغلاق العقد
            </button>
            <button class="btn btn--danger" id="btnDeleteContract" data-action="delete-contract">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                حذف
            </button>
        </div>
    </div>

    {{-- Contract Summary Card --}}
    <div class="summary-card" id="summaryCard">
        <div class="summary-card__top">
            <div class="summary-card__title-row">
                <div>
                    <h2 class="summary-card__number" id="contractNumber">C-2025-003</h2>
                    <span class="summary-card__customer" id="summaryCustomer">مركز التسوق الكبير</span>
                </div>
                <div class="summary-card__badges">
                    <span class="status-badge status-badge--active" id="statusBadge">ساري</span>
                    <span class="branch-badge" id="summaryBranch">الرياض</span>
                </div>
            </div>
            <div class="summary-card__dates">
                <div class="summary-date">
                    <span class="summary-date__label">البداية</span>
                    <span class="summary-date__value" id="summaryStart">2025-01-20</span>
                </div>
                <div class="summary-date__arrow">←</div>
                <div class="summary-date">
                    <span class="summary-date__label">النهاية</span>
                    <span class="summary-date__value" id="summaryEnd">2026-01-19</span>
                </div>
            </div>
        </div>
        <div class="summary-card__progress">
            <div class="progress-info">
                <span>الأيام المتبقية: <strong id="daysLeftText">272 يوم</strong></span>
                <span id="progressPercent">25%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-bar__fill" id="progressFill" style="width: 25%;"></div>
            </div>
        </div>
        <div class="summary-card__alert" id="expiryAlert" style="display: none;">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            <span>تنبيه: العقد قريب الانتهاء!</span>
        </div>
    </div>

    {{-- KPI Cards --}}
    <div class="kpi-cards">
        <div class="kpi-card">
            <div class="kpi-card__icon kpi-card__icon--blue">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/></svg>
            </div>
            <div class="kpi-card__info">
                <span class="kpi-card__label">قيمة العقد</span>
                <span class="kpi-card__value" id="kpiTotal">680,000 ر.س</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-card__icon kpi-card__icon--green">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
            </div>
            <div class="kpi-card__info">
                <span class="kpi-card__label">المدة المتبقية</span>
                <span class="kpi-card__value" id="kpiDaysLeft">272 يوم</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-card__icon kpi-card__icon--purple">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"/></svg>
            </div>
            <div class="kpi-card__info">
                <span class="kpi-card__label">عدد المرفقات</span>
                <span class="kpi-card__value" id="kpiAttachments">5</span>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="tabs-container">
        <div class="tabs-nav" role="tablist">
            <button class="tab-btn active" data-tab="data" role="tab" aria-selected="true">البيانات</button>
            <button class="tab-btn" data-tab="items" role="tab" aria-selected="false">البنود/النطاق</button>
            <button class="tab-btn" data-tab="attachments" role="tab" aria-selected="false">المرفقات</button>
            <button class="tab-btn" data-tab="statusLog" role="tab" aria-selected="false">سجل الحالة</button>
            <button class="tab-btn" data-tab="auditLog" role="tab" aria-selected="false">سجل التدقيق</button>
        </div>

        {{-- Tab: Data --}}
        <div class="tab-panel active" id="tabData" role="tabpanel">
            <div class="data-card">
                <div class="data-card__header">
                    <h3>معلومات العقد</h3>
                    <button class="btn btn--text btn--sm" id="btnCopyData">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"/><path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"/></svg>
                        نسخ البيانات
                    </button>
                </div>
                <div class="info-grid info-grid--2col" id="dataGrid">
                    <div class="info-item">
                        <span class="info-label">رقم العقد</span>
                        <span class="info-value" id="dataNumber">C-2025-003</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">العميل</span>
                        <span class="info-value" id="dataCustomer">مركز التسوق الكبير</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">الفرع</span>
                        <span class="info-value" id="dataBranch">الرياض</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">العنوان</span>
                        <span class="info-value" id="dataAddress">طريق الملك فهد، حي العليا، الرياض</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">تاريخ البداية</span>
                        <span class="info-value" id="dataStart">2025-01-20</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">تاريخ النهاية</span>
                        <span class="info-value" id="dataEnd">2026-01-19</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">القيمة الإجمالية</span>
                        <span class="info-value" id="dataTotal">680,000 ر.س</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">منشئ العقد</span>
                        <span class="info-value" id="dataOwner">محمد العتيبي</span>
                    </div>
                </div>
                <div class="info-section" id="termsSection">
                    <h4 class="info-section__title">الشروط المختصرة</h4>
                    <p class="info-section__text" id="dataTerms">مدة العقد سنة واحدة قابلة للتجديد. الدفع شهرياً بعد تقديم الفواتير. يشمل العقد توفير الزي الرسمي والمعدات. يحق للعميل إنهاء العقد بإشعار مسبق 30 يوم.</p>
                </div>
                <div class="info-section" id="notesSection">
                    <h4 class="info-section__title">الملاحظات</h4>
                    <p class="info-section__text" id="dataNotes">عقد خدمات حراسة وأمن شامل لمركز التسوق الكبير يتضمن حراسة على مدار الساعة وكاميرات مراقبة وتقارير يومية.</p>
                </div>
            </div>
        </div>

        {{-- Tab: Items --}}
        <div class="tab-panel" id="tabItems" role="tabpanel">
            <div class="data-card">
                <div class="data-card__header">
                    <h3>بنود ونطاق العقد</h3>
                </div>
                <div class="table-scroll">
                    <table class="items-table" id="itemsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الوصف</th>
                                <th>الكمية</th>
                                <th>سعر الوحدة</th>
                                <th>الإجمالي</th>
                            </tr>
                        </thead>
                        <tbody id="itemsBody">
                            {{-- Populated by JS --}}
                        </tbody>
                    </table>
                </div>
                <div class="items-summary" id="itemsSummary">
                    {{-- Populated by JS --}}
                </div>
            </div>
        </div>

        {{-- Tab: Attachments --}}
        <div class="tab-panel" id="tabAttachments" role="tabpanel">
            <div class="data-card">
                <div class="data-card__header">
                    <h3>المرفقات</h3>
                    <div class="attachment-actions">
                        <div class="attachment-filter">
                            <button class="filter-chip active" data-att-filter="all">الكل</button>
                            <button class="filter-chip" data-att-filter="pdf">PDF</button>
                            <button class="filter-chip" data-att-filter="image">صور</button>
                        </div>
                        <button class="btn btn--primary btn--sm" id="btnAddAttachment">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                            إضافة مرفق
                        </button>
                    </div>
                </div>
                <input type="file" id="fileInput" style="display:none" multiple>
                <div class="attachments-list" id="attachmentsList">
                    {{-- Populated by JS --}}
                </div>
            </div>
        </div>

        {{-- Tab: Status Log --}}
        <div class="tab-panel" id="tabStatusLog" role="tabpanel">
            <div class="data-card">
                <div class="data-card__header">
                    <h3>سجل الحالة</h3>
                </div>
                <div class="timeline" id="statusTimeline">
                    {{-- Populated by JS --}}
                </div>
            </div>
        </div>

        {{-- Tab: Audit Log --}}
        <div class="tab-panel" id="tabAuditLog" role="tabpanel">
            <div class="data-card">
                <div class="data-card__header">
                    <h3>سجل التدقيق</h3>
                </div>
                <div class="table-scroll">
                    <table class="audit-table" id="auditTable">
                        <thead>
                            <tr>
                                <th>المستخدم</th>
                                <th>العملية</th>
                                <th>التاريخ</th>
                                <th>ملاحظة</th>
                            </tr>
                        </thead>
                        <tbody id="auditBody">
                            {{-- Populated by JS --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Edit Contract --}}
<div class="modal" id="editContractModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header">
            <h2 class="modal__title">تعديل العقد</h2>
            <button class="modal__close" aria-label="إغلاق">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            </button>
        </div>
        <div class="modal__body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">تاريخ البداية</label>
                    <input type="date" id="editStartDate" class="form-input" value="2025-01-20">
                </div>
                <div class="form-group">
                    <label class="form-label">تاريخ النهاية</label>
                    <input type="date" id="editEndDate" class="form-input" value="2026-01-19">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">الشروط المختصرة</label>
                <textarea id="editTerms" class="form-textarea" rows="3">مدة العقد سنة واحدة قابلة للتجديد. الدفع شهرياً بعد تقديم الفواتير. يشمل العقد توفير الزي الرسمي والمعدات. يحق للعميل إنهاء العقد بإشعار مسبق 30 يوم.</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">ملاحظات</label>
                <textarea id="editNotes" class="form-textarea" rows="3">عقد خدمات حراسة وأمن شامل لمركز التسوق الكبير يتضمن حراسة على مدار الساعة وكاميرات مراقبة وتقارير يومية.</textarea>
            </div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline modal__close">إلغاء</button>
            <button class="btn btn--primary" id="confirmEditBtn">حفظ التعديلات</button>
        </div>
    </div>
</div>

{{-- Modal: Change Status --}}
<div class="modal" id="changeStatusModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header">
            <h2 class="modal__title">تغيير حالة العقد</h2>
            <button class="modal__close" aria-label="إغلاق">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
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
                <textarea id="statusNote" class="form-textarea" rows="3" placeholder="أضف ملاحظة (اختياري)"></textarea>
            </div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline modal__close">إلغاء</button>
            <button class="btn btn--primary" id="confirmStatusBtn">حفظ التغيير</button>
        </div>
    </div>
</div>

{{-- Modal: Confirmation --}}
<div class="modal" id="confirmModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header">
            <h2 class="modal__title" id="confirmTitle">تأكيد</h2>
            <button class="modal__close" aria-label="إغلاق">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            </button>
        </div>
        <div class="modal__body">
            <p id="confirmMessage">هل أنت متأكد؟</p>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline modal__close">إلغاء</button>
            <button class="btn btn--danger" id="confirmActionBtn">تأكيد</button>
        </div>
    </div>
</div>

{{-- Toast --}}
<div class="toast" id="toast" role="status" aria-live="polite">
    <svg class="toast__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
    <span class="toast__message" id="toastMessage">تمت العملية بنجاح</span>
</div>
@endsection

