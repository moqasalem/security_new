@extends('layouts.app')

@section('title', 'تعديل عرض السعر')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/quotations-edit.css') }}">
@endpush

@section('content')
    @php
    // Dummy quotation data
    $quotation = [
        'id' => 1,
        'number' => 'Q-2024-001',
        'status' => 'draft', // draft, pending, approved, rejected, expired
        'rejection_reason' => null,
        'customer_id' => 1,
        'customer' => 'شركة النور للأمن',
        'project' => 'حراسات أمنية',
        'branch_id' => 1,
        'branch' => 'الفرع الرئيسي',
        'date' => '2024-01-15',
        'validity_days' => 28,
        'contact_person' => 'أحمد محمد',
        'internal_notes' => 'عميل مميز - تقديم أفضل عرض',
        'terms' => "1. يسري هذا العرض لمدة 28 يوم من تاريخه.\n2. الأسعار شاملة ضريبة القيمة المضافة.\n3. تخضع الأسعار للتغيير دون إشعار مسبق.",
        'subtotal' => 45000,
        'discount' => 2000,
        'tax' => 6450,
        'total' => 49450
    ];

    // Dummy items
    $items = [
        ['id' => 1, 'type' => 'security', 'description' => 'حراسة أمنية - 8 ساعات', 'quantity' => 30, 'price' => 150, 'discount' => 0, 'tax' => 15],
        ['id' => 2, 'type' => 'security', 'description' => 'حراسة أمنية - 12 ساعة', 'quantity' => 20, 'price' => 200, 'discount' => 0, 'tax' => 15],
        ['id' => 3, 'type' => 'allowance', 'description' => 'بدل مواصلات', 'quantity' => 50, 'price' => 300, 'discount' => 2000, 'tax' => 15],
    ];

    // Dummy templates
    $templates = [
        ['id' => 1, 'type' => 'security', 'name' => 'حراسة أمنية - 8 ساعات', 'price' => 150],
        ['id' => 2, 'type' => 'security', 'name' => 'حراسة أمنية - 12 ساعة', 'price' => 200],
        ['id' => 3, 'type' => 'cleaning', 'name' => 'خدمات نظافة يومية', 'price' => 180],
        ['id' => 4, 'type' => 'allowance', 'name' => 'بدل مواصلات', 'price' => 300],
    ];

    // Dummy approval log
    $approvalLog = [
        ['action' => 'تم إنشاء العرض', 'user' => 'محمد أحمد', 'time' => '2024-01-15 10:30'],
    ];

    // Dummy attachments
    $attachments = [
        ['id' => 1, 'name' => 'مواصفات_المشروع.pdf', 'size' => '2.3 MB'],
    ];

    // Can edit check
    $canEdit = in_array($quotation['status'], ['draft', 'rejected']);
    @endphp

    <!-- Dirty Form Indicator -->
    <div class="dirty-indicator" id="dirtyIndicator" style="display: none;">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
        </svg>
        لديك تغييرات غير محفوظة
    </div>

    <!-- Page Header -->
    <div class="page-header no-print">
        <div class="page-header__left">
            <h1 class="page-title">تعديل عرض السعر</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <a href="{{ route('quotations') }}">عروض الأسعار</a>
                <span>/</span>
                <span>تعديل</span>
            </nav>
        </div>
        <div class="page-header__right">
            <button class="btn btn--outline btn--sm" id="btnBackToShow" onclick="window.location.href='{{ route('quotations.show', $quotation['id']) }}'">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                رجوع للتفاصيل
            </button>
            <button class="btn btn--outline btn--sm" id="btnSaveDraft">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z"/>
                </svg>
                حفظ كمسودة
            </button>
            <button class="btn btn--outline btn--sm" id="btnPreviewPdf">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                </svg>
                معاينة PDF
            </button>
            <button class="btn btn--outline btn--sm btn--danger" id="btnDiscardChanges">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                تجاهل التغييرات
            </button>
            <button class="btn btn--primary btn--sm" id="btnSaveChanges">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                حفظ التعديلات
            </button>
            <button class="btn btn--primary btn--sm" id="btnSendForApproval">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                </svg>
                إرسال للاعتماد
            </button>
        </div>
    </div>

    <!-- Status Banner -->
    <div class="status-banner status-banner--{{ $quotation['status'] }}">
        <div class="status-banner__content">
            <div class="status-banner__info">
                <strong>عرض السعر: {{ $quotation['number'] }}</strong>
                <span class="badge badge--{{ $quotation['status'] }}">
                    @if($quotation['status'] == 'draft') مسودة
                    @elseif($quotation['status'] == 'pending') بانتظار اعتماد
                    @elseif($quotation['status'] == 'approved') معتمد
                    @elseif($quotation['status'] == 'rejected') مرفوض
                    @else منتهي
                    @endif
                </span>
                @if(!$canEdit)
                <span class="warning-text">⚠️ لا يمكن التعديل بهذه الحالة</span>
                @endif
            </div>
            @if($quotation['status'] == 'rejected' && $quotation['rejection_reason'])
            <div class="rejection-reason">
                <strong>سبب الرفض:</strong> {{ $quotation['rejection_reason'] }}
            </div>
            @endif
        </div>
    </div>

    <!-- Main Layout -->
    <div class="edit-layout">
        <!-- Main Form Column -->
        <div class="edit-form">
            <!-- Section: Customer & Project -->
            <div class="form-card">
                <div class="form-card__header">
                    <h3 class="form-card__title">العميل والمشروع</h3>
                </div>
                <div class="form-card__body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">العميل <span class="required">*</span></label>
                            <select class="form-input" id="customerSelect" {{ !$canEdit ? 'disabled' : '' }}>
                                <option value="1" selected>{{ $quotation['customer'] }}</option>
                                <option value="2">مؤسسة الفجر</option>
                                <option value="3">شركة البناء المتقدم</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">الفرع <span class="required">*</span></label>
                            <select class="form-input" id="branchSelect" {{ !$canEdit ? 'disabled' : '' }}>
                                <option value="1" selected>{{ $quotation['branch'] }}</option>
                                <option value="2">فرع الملك فهد</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">اسم المشروع <span class="required">*</span></label>
                            <input type="text" class="form-input" id="projectName" value="{{ $quotation['project'] }}" {{ !$canEdit ? 'disabled' : '' }}>
                        </div>
                        <div class="form-group">
                            <label class="form-label">جهة الاتصال</label>
                            <input type="text" class="form-input" id="contactPerson" value="{{ $quotation['contact_person'] }}" {{ !$canEdit ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">تاريخ العرض <span class="required">*</span></label>
                            <input type="date" class="form-input" id="quoteDate" value="{{ $quotation['date'] }}" {{ !$canEdit ? 'disabled' : '' }}>
                        </div>
                        <div class="form-group">
                            <label class="form-label">الصلاحية (بالأيام)</label>
                            <input type="number" class="form-input" id="validityDays" value="{{ $quotation['validity_days'] }}" {{ !$canEdit ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">ملاحظات داخلية <span class="internal-note">(لا تظهر للعميل)</span></label>
                        <textarea class="form-input" id="internalNotes" rows="2" {{ !$canEdit ? 'disabled' : '' }}>{{ $quotation['internal_notes'] }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section: Items & Pricing -->
            <div class="form-card">
                <div class="form-card__header">
                    <h3 class="form-card__title">البنود والتسعير</h3>
                    <div class="form-card__actions">
                        <button class="btn btn--outline btn--sm" id="btnAddFromTemplate" {{ !$canEdit ? 'disabled' : '' }}>
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                            إضافة من قالب
                        </button>
                        <button class="btn btn--outline btn--sm" id="btnRecalcTotals">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                            </svg>
                            إعادة حساب
                        </button>
                        <button class="btn btn--primary btn--sm" id="btnAddItem" {{ !$canEdit ? 'disabled' : '' }}>
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            إضافة بند
                        </button>
                    </div>
                </div>
                <div class="form-card__body">
                    <div class="items-table-wrapper">
                        <table class="items-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نوع البند</th>
                                    <th>الوصف</th>
                                    <th>الكمية</th>
                                    <th>سعر الوحدة</th>
                                    <th>الخصم</th>
                                    <th>الضريبة %</th>
                                    <th>الإجمالي</th>
                                    <th>إجراءات</th>
                                </tr>
                            </thead>
                            <tbody id="itemsTableBody">
                                <!-- Will be populated by JS -->
                            </tbody>
                        </table>
                    </div>

                    <div class="summary-box">
                        <div class="summary-row">
                            <span>المجموع الفرعي:</span>
                            <strong id="subtotalValue">{{ number_format($quotation['subtotal'], 2) }} ر.س</strong>
                        </div>
                        <div class="summary-row">
                            <span>الخصم:</span>
                            <strong id="discountValue">{{ number_format($quotation['discount'], 2) }} ر.س</strong>
                        </div>
                        <div class="summary-row">
                            <span>الضريبة:</span>
                            <strong id="taxValue">{{ number_format($quotation['tax'], 2) }} ر.س</strong>
                        </div>
                        <div class="summary-row summary-row--total">
                            <span>الإجمالي النهائي:</span>
                            <strong id="totalValue">{{ number_format($quotation['total'], 2) }} ر.س</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Terms & Attachments -->
            <div class="form-card">
                <div class="form-card__header">
                    <h3 class="form-card__title">الشروط والمرفقات</h3>
                </div>
                <div class="form-card__body">
                    <div class="form-group">
                        <label class="form-label">الشروط والأحكام</label>
                        <textarea class="form-input" id="termsText" rows="5" {{ !$canEdit ? 'disabled' : '' }}>{{ $quotation['terms'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">المرفقات</label>
                        <div class="attachments-list">
                            @foreach($attachments as $attachment)
                            <div class="attachment-item">
                                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                </svg>
                                <div class="attachment-info">
                                    <strong>{{ $attachment['name'] }}</strong>
                                    <span>{{ $attachment['size'] }}</span>
                                </div>
                                <button class="btn btn--sm btn--text btn--danger" data-attachment-id="{{ $attachment['id'] }}" {{ !$canEdit ? 'disabled' : '' }}>حذف</button>
                            </div>
                            @endforeach
                        </div>

                        <div class="upload-zone" id="uploadZone">
                            <svg width="48" height="48" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <h4>اسحب الملفات هنا أو اضغط للاختيار</h4>
                            <input type="file" id="fileInput" style="display: none;" multiple {{ !$canEdit ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Approval Log -->
            @if($quotation['status'] == 'rejected' || count($approvalLog) > 0)
            <div class="form-card">
                <div class="form-card__header">
                    <h3 class="form-card__title">سجل الاعتماد</h3>
                </div>
                <div class="form-card__body">
                    <div class="timeline">
                        @foreach($approvalLog as $log)
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h4>{{ $log['action'] }}</h4>
                                <p class="timeline-meta">{{ $log['user'] }} - {{ $log['time'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar Summary -->
        <div class="edit-sidebar">
            <!-- Financial Summary -->
            <div class="sidebar-card">
                <h4 class="sidebar-card__title">الملخص المالي</h4>
                <div class="financial-row">
                    <span>المجموع الفرعي</span>
                    <strong id="sidebarSubtotal">{{ number_format($quotation['subtotal']) }} ر.س</strong>
                </div>
                <div class="financial-row">
                    <span>الخصم</span>
                    <strong id="sidebarDiscount">{{ number_format($quotation['discount']) }} ر.س</strong>
                </div>
                <div class="financial-row">
                    <span>الضريبة</span>
                    <strong id="sidebarTax">{{ number_format($quotation['tax']) }} ر.س</strong>
                </div>
                <div class="financial-row financial-row--total">
                    <span>الإجمالي</span>
                    <strong id="sidebarTotal">{{ number_format($quotation['total']) }} ر.س</strong>
                </div>
            </div>

            <!-- Checklist -->
            <div class="sidebar-card">
                <h4 class="sidebar-card__title">قائمة التحقق</h4>
                <div class="checklist">
                    <div class="checklist-item" id="checkCustomer">
                        <svg class="check-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>العميل محدد</span>
                    </div>
                    <div class="checklist-item" id="checkItems">
                        <svg class="check-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>يوجد بنود</span>
                    </div>
                    <div class="checklist-item" id="checkTotal">
                        <svg class="check-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>الإجمالي > 0</span>
                    </div>
                    <div class="checklist-item" id="checkTerms">
                        <svg class="check-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>الشروط موجودة</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="sidebar-card">
                <h4 class="sidebar-card__title">إجراءات سريعة</h4>
                <div class="quick-actions">
                    <button class="quick-action-btn" id="btnCopyNumber">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"/>
                            <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"/>
                        </svg>
                        نسخ رقم العرض
                    </button>
                    <button class="quick-action-btn" id="btnCopyLink">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"/>
                        </svg>
                        نسخ رابط العرض
                    </button>
                    <button class="quick-action-btn" id="btnDownloadPdf">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        تنزيل PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Item Modal -->
    <div class="modal" id="itemModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title" id="itemModalTitle">إضافة بند</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="form-group">
                    <label class="form-label">نوع البند <span class="required">*</span></label>
                    <select class="form-input" id="modalItemType">
                        <option value="security">حراسة أمنية</option>
                        <option value="cleaning">خدمات نظافة</option>
                        <option value="allowance">بدلات</option>
                        <option value="equipment">معدات</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">الوصف <span class="required">*</span></label>
                    <input type="text" class="form-input" id="modalItemDescription" placeholder="وصف البند">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">الكمية <span class="required">*</span></label>
                        <input type="number" class="form-input" id="modalItemQuantity" value="1" min="1">
                    </div>
                    <div class="form-group">
                        <label class="form-label">سعر الوحدة <span class="required">*</span></label>
                        <input type="number" class="form-input" id="modalItemPrice" value="0" min="0" step="0.01">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">الخصم</label>
                        <input type="number" class="form-input" id="modalItemDiscount" value="0" min="0" step="0.01">
                    </div>
                    <div class="form-group">
                        <label class="form-label">الضريبة %</label>
                        <input type="number" class="form-input" id="modalItemTax" value="15" min="0" max="100">
                    </div>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="saveItemBtn">حفظ البند</button>
            </div>
        </div>
    </div>

    <!-- Templates Drawer -->
    <div class="drawer" id="templatesDrawer">
        <div class="drawer__overlay"></div>
        <div class="drawer__content">
            <div class="drawer__header">
                <h3 class="drawer__title">قوالب البنود</h3>
                <button class="drawer__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="drawer__body">
                <div class="templates-list">
                    @foreach($templates as $template)
                    <div class="template-item" data-template-id="{{ $template['id'] }}" data-template-type="{{ $template['type'] }}" data-template-name="{{ $template['name'] }}" data-template-price="{{ $template['price'] }}">
                        <div class="template-info">
                            <strong>{{ $template['name'] }}</strong>
                            <span>{{ number_format($template['price'], 2) }} ر.س</span>
                        </div>
                        <button class="btn btn--sm btn--primary add-template-btn">إضافة</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- PDF Preview Modal -->
    <div class="modal" id="pdfPreviewModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--large">
            <div class="modal__header">
                <h3 class="modal__title">معاينة PDF</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="pdf-preview">
                    <div class="skeleton-box"></div>
                    <p>معاينة PDF (UI)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Send for Approval Modal -->
    <div class="modal" id="approvalModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">إرسال للاعتماد</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="form-group">
                    <label class="form-label">اختر المُعتمد</label>
                    <select class="form-input">
                        <option>محمد أحمد - مدير الفرع</option>
                        <option>سارة علي - المدير العام</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">ملاحظات للمُعتمد</label>
                    <textarea class="form-input" rows="3" placeholder="أضف ملاحظات إضافية..."></textarea>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="confirmSendApprovalBtn">تأكيد الإرسال</button>
            </div>
        </div>
    </div>

    <!-- Discard Changes Confirmation -->
    <div class="modal" id="discardModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">تجاهل التغييرات</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <p>هل أنت متأكد من تجاهل التغييرات؟ سيتم استرجاع القيم الأصلية.</p>
                <p class="warning-text">لا يمكن التراجع عن هذا الإجراء.</p>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--danger" id="confirmDiscardBtn">تأكيد التجاهل</button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast" role="status" aria-live="polite">
        <div class="toast__icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="toast__message" id="toastMessage"></div>
    </div>

    <script>
        // Pass data to JS
        window.quotationData = {
            canEdit: {{ $canEdit ? 'true' : 'false' }},
            initialItems: @json($items),
            quotation: @json($quotation)
        };
    </script>
@endsection



