@extends('layouts.app')

@section('title', 'تفاصيل عرض السعر')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/quotations-show.css') }}">
@endpush

@section('content')
    @php
    // Dummy quotation data
    $quotation = [
        'id' => 1,
        'number' => 'Q-2024-001',
        'customer' => 'شركة النور للأمن',
        'project' => 'حراسات أمنية',
        'branch' => 'الفرع الرئيسي',
        'status' => 'pending', // draft, pending, approved, rejected, expired
        'created_at' => '2024-01-15',
        'approved_at' => null,
        'owner' => 'محمد أحمد',
        'expiry_days_left' => 25,
        'validity_days' => 28,
        'rejection_reason' => null,
        'subtotal' => 45000,
        'discount' => 2000,
        'tax' => 6450,
        'total' => 49450
    ];

    // Dummy items
    $items = [
        ['type' => 'حراسة أمنية', 'description' => 'حراسة أمنية - 8 ساعات', 'quantity' => 30, 'price' => 150, 'discount' => 0, 'tax' => 15, 'total' => 5175],
        ['type' => 'حراسة أمنية', 'description' => 'حراسة أمنية - 12 ساعة', 'quantity' => 20, 'price' => 200, 'discount' => 0, 'tax' => 15, 'total' => 4600],
        ['type' => 'بدلات', 'description' => 'بدل مواصلات', 'quantity' => 50, 'price' => 300, 'discount' => 2000, 'tax' => 15, 'total' => 16675],
    ];

    // Dummy approval log
    $approvalLog = [
        ['action' => 'تم إنشاء العرض', 'user' => 'محمد أحمد', 'time' => '2024-01-15 10:30', 'note' => null],
        ['action' => 'تم الإرسال للاعتماد', 'user' => 'محمد أحمد', 'time' => '2024-01-15 14:00', 'note' => 'يرجى المراجعة والاعتماد'],
    ];

    // Dummy attachments
    $attachments = [
        ['name' => 'مواصفات_المشروع.pdf', 'size' => '2.3 MB', 'uploaded_at' => '2024-01-15'],
        ['name' => 'العقد_المرجعي.docx', 'size' => '1.1 MB', 'uploaded_at' => '2024-01-15'],
    ];

    // Dummy change log
    $changeLog = [
        ['field' => 'الحالة', 'from' => 'مسودة', 'to' => 'بانتظار اعتماد', 'user' => 'محمد أحمد', 'time' => '2024-01-15 14:00'],
    ];
    @endphp

    <!-- Page Header -->
    <div class="page-header no-print">
        <div class="page-header__left">
            <h1 class="page-title">تفاصيل عرض السعر</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <a href="{{ route('quotations') }}">عروض الأسعار</a>
                <span>/</span>
                <span>تفاصيل</span>
            </nav>
        </div>
        <div class="page-header__right">
            <button class="btn btn--outline btn--sm" id="btnBack" onclick="window.location.href='{{ route('quotations') }}'">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                رجوع
            </button>
            <button class="btn btn--outline btn--sm" id="btnCopyLink">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"/>
                </svg>
                نسخ رابط
            </button>
            <button class="btn btn--outline btn--sm" id="btnPrint">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"/>
                </svg>
                طباعة
            </button>
            <button class="btn btn--outline btn--sm" id="btnDownloadPdf">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                تحميل PDF
            </button>
            <button class="btn btn--outline btn--sm status-action" id="btnEditQuotation" data-status-required="draft,rejected" onclick="window.location.href='{{ route('quotations.edit', $quotation['id']) }}'">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                </svg>
                تعديل
            </button>
            <button class="btn btn--primary btn--sm status-action" id="btnSendForApproval" data-status-required="draft,rejected">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                </svg>
                إرسال للاعتماد
            </button>
            <button class="btn btn--success btn--sm status-action" id="btnApprove" data-status-required="pending">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                اعتماد
            </button>
            <button class="btn btn--danger btn--sm status-action" id="btnReject" data-status-required="pending">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                رفض
            </button>
            <button class="btn btn--outline btn--sm btn--danger" id="btnCancelQuotation">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                إلغاء العرض
            </button>
        </div>
    </div>

    <!-- Quotation Summary Card -->
    <div class="summary-card">
        <div class="summary-header">
            <div class="summary-title">
                <h2>{{ $quotation['number'] }}</h2>
                <span class="badge badge--{{ $quotation['status'] }}" id="statusBadge">
                    @if($quotation['status'] == 'draft') مسودة
                    @elseif($quotation['status'] == 'pending') بانتظار اعتماد
                    @elseif($quotation['status'] == 'approved') معتمد
                    @elseif($quotation['status'] == 'rejected') مرفوض
                    @else منتهي
                    @endif
                </span>
            </div>
            <span class="summary-branch">{{ $quotation['branch'] }}</span>
        </div>

        <div class="summary-grid">
            <div class="summary-item">
                <span class="summary-label">العميل:</span>
                <span class="summary-value">{{ $quotation['customer'] }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">المشروع:</span>
                <span class="summary-value">{{ $quotation['project'] }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">تاريخ الإنشاء:</span>
                <span class="summary-value">{{ $quotation['created_at'] }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">تاريخ الاعتماد:</span>
                <span class="summary-value" id="approvalDate">{{ $quotation['approved_at'] ?? 'لم يعتمد بعد' }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">منشئ العرض:</span>
                <span class="summary-value">{{ $quotation['owner'] }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">صلاحية العرض:</span>
                <div class="expiry-info">
                    <span class="expiry-text">{{ $quotation['expiry_days_left'] }} يوم متبقي</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ min(100, ($quotation['expiry_days_left'] / $quotation['validity_days']) * 100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        @if($quotation['rejection_reason'])
        <div class="rejection-alert">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <div>
                <strong>سبب الرفض:</strong>
                <p>{{ $quotation['rejection_reason'] }}</p>
            </div>
        </div>
        @endif
    </div>

    <!-- Financial KPIs -->
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--blue">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="kpi-content">
                <span class="kpi-label">المجموع الفرعي</span>
                <strong class="kpi-value">{{ number_format($quotation['subtotal']) }} ر.س</strong>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--green">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="kpi-content">
                <span class="kpi-label">الضريبة (15%)</span>
                <strong class="kpi-value">{{ number_format($quotation['tax']) }} ر.س</strong>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--purple">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="kpi-content">
                <span class="kpi-label">الإجمالي النهائي</span>
                <strong class="kpi-value kpi-value--large">{{ number_format($quotation['total']) }} ر.س</strong>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs-container">
        <div class="tabs-header no-print">
            <button class="tab-btn active" data-tab="items">البنود</button>
            <button class="tab-btn" data-tab="approval">سجل الاعتماد</button>
            <button class="tab-btn" data-tab="attachments">المرفقات</button>
            <button class="tab-btn" data-tab="terms">الشروط</button>
            <button class="tab-btn" data-tab="changelog">سجل التغييرات</button>
        </div>

        <!-- Items Tab -->
        <div class="tab-content active" data-tab-content="items">
            <div class="items-table-wrapper">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>نوع البند</th>
                            <th>الوصف</th>
                            <th>الكمية</th>
                            <th>سعر الوحدة</th>
                            <th>الخصم</th>
                            <th>الضريبة ٪</th>
                            <th>الإجمالي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item['type'] }}</td>
                            <td>{{ $item['description'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price'], 2) }} ر.س</td>
                            <td>{{ number_format($item['discount'], 2) }} ر.س</td>
                            <td>{{ $item['tax'] }}%</td>
                            <td><strong>{{ number_format($item['total'], 2) }} ر.س</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="summary-box">
                <div class="summary-row">
                    <span>المجموع الفرعي:</span>
                    <strong>{{ number_format($quotation['subtotal']) }} ر.س</strong>
                </div>
                <div class="summary-row">
                    <span>الخصم:</span>
                    <strong>{{ number_format($quotation['discount']) }} ر.س</strong>
                </div>
                <div class="summary-row">
                    <span>الضريبة:</span>
                    <strong>{{ number_format($quotation['tax']) }} ر.س</strong>
                </div>
                <div class="summary-row summary-row--total">
                    <span>الإجمالي النهائي:</span>
                    <strong>{{ number_format($quotation['total']) }} ر.س</strong>
                </div>
            </div>
        </div>

        <!-- Approval Log Tab -->
        <div class="tab-content" data-tab-content="approval">
            <div class="timeline">
                @foreach($approvalLog as $log)
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>{{ $log['action'] }}</h4>
                        <p class="timeline-meta">{{ $log['user'] }} - {{ $log['time'] }}</p>
                        @if($log['note'])
                        <p class="timeline-note">{{ $log['note'] }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Attachments Tab -->
        <div class="tab-content" data-tab-content="attachments">
            <div class="attachments-list">
                @foreach($attachments as $attachment)
                <div class="attachment-item">
                    <div class="attachment-icon">
                        <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="attachment-info">
                        <strong>{{ $attachment['name'] }}</strong>
                        <span>{{ $attachment['size'] }} - {{ $attachment['uploaded_at'] }}</span>
                    </div>
                    <div class="attachment-actions">
                        <button class="btn btn--sm btn--outline">تحميل</button>
                        <button class="btn btn--sm btn--text btn--danger">حذف</button>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="upload-zone no-print" id="uploadZone">
                <svg width="48" height="48" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <h4>اسحب الملفات هنا أو اضغط للاختيار</h4>
                <input type="file" id="fileInput" style="display: none;" multiple>
            </div>
        </div>

        <!-- Terms Tab -->
        <div class="tab-content" data-tab-content="terms">
            <div class="terms-box">
                <h4>الشروط والأحكام</h4>
                <div class="terms-content">
                    <p>1. يسري هذا العرض لمدة 28 يوم من تاريخه.</p>
                    <p>2. الأسعار شاملة ضريبة القيمة المضافة.</p>
                    <p>3. تخضع الأسعار للتغيير دون إشعار مسبق.</p>
                    <p>4. الدفع خلال 30 يوم من تاريخ الفاتورة.</p>
                    <p>5. يتحمل العميل أي تكاليف إضافية ناتجة عن تغيير في النطاق.</p>
                </div>
                <button class="btn btn--outline btn--sm no-print" id="btnCopyTerms">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"/>
                        <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"/>
                    </svg>
                    نسخ الشروط
                </button>
            </div>
        </div>

        <!-- Changelog Tab -->
        <div class="tab-content" data-tab-content="changelog">
            <div class="changelog-table-wrapper">
                <table class="changelog-table">
                    <thead>
                        <tr>
                            <th>الحقل</th>
                            <th>من</th>
                            <th>إلى</th>
                            <th>المستخدم</th>
                            <th>الوقت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($changeLog as $change)
                        <tr>
                            <td>{{ $change['field'] }}</td>
                            <td>{{ $change['from'] }}</td>
                            <td>{{ $change['to'] }}</td>
                            <td>{{ $change['user'] }}</td>
                            <td>{{ $change['time'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">تعديل عرض السعر</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="form-group">
                    <label class="form-label">العميل</label>
                    <input type="text" class="form-input" value="{{ $quotation['customer'] }}" readonly>
                </div>
                <div class="form-group">
                    <label class="form-label">المشروع</label>
                    <input type="text" class="form-input" value="{{ $quotation['project'] }}">
                </div>
                <div class="form-group">
                    <label class="form-label">الفرع</label>
                    <select class="form-input">
                        <option>الفرع الرئيسي</option>
                        <option>فرع الملك فهد</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">ملاحظات</label>
                    <textarea class="form-input" rows="3"></textarea>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="saveEditBtn">حفظ التعديلات</button>
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
                        <option>محمد أحمد - مدير الفرع الرئيسي</option>
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

    <!-- Approve Modal -->
    <div class="modal" id="approveModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">اعتماد عرض السعر</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <p>هل أنت متأكد من اعتماد عرض السعر رقم <strong>{{ $quotation['number'] }}</strong>؟</p>
                <div class="form-group">
                    <label class="form-label">ملاحظات (اختياري)</label>
                    <textarea class="form-input" rows="3"></textarea>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--success" id="confirmApproveBtn">تأكيد الاعتماد</button>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal" id="rejectModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">رفض عرض السعر</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="form-group">
                    <label class="form-label">سبب الرفض <span class="required">*</span></label>
                    <textarea class="form-input" id="rejectionReason" rows="4" placeholder="أدخل سبب الرفض..." required></textarea>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--danger" id="confirmRejectBtn">تأكيد الرفض</button>
            </div>
        </div>
    </div>

    <!-- Cancel Quotation Modal -->
    <div class="modal" id="cancelModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">إلغاء عرض السعر</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <p>هل أنت متأكد من إلغاء عرض السعر رقم <strong>{{ $quotation['number'] }}</strong>؟</p>
                <p class="warning-text">لا يمكن التراجع عن هذا الإجراء.</p>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--danger" id="confirmCancelBtn">تأكيد الإلغاء</button>
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
        // Pass current status to JS
        window.quotationStatus = '{{ $quotation['status'] }}';
    </script>
@endsection



