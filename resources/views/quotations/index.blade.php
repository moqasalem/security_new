@extends('layouts.app')

@section('title', 'عروض الأسعار')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/quotations-index.css') }}">
@endpush

@section('content')
    @php
    // Dummy quotations data
    $quotations = [
        ['id' => 1, 'number' => 'Q-2024-001', 'customer' => 'شركة النور للأمن', 'project' => 'حراسات أمنية', 'branch' => 'الفرع الرئيسي', 'total' => 45000, 'status' => 'approved', 'created_at' => '2024-01-15', 'approved_at' => '2024-01-18', 'expiry_days_left' => 45],
        ['id' => 2, 'number' => 'Q-2024-002', 'customer' => 'مؤسسة الفجر', 'project' => 'خدمات نظافة', 'branch' => 'فرع الملك فهد', 'total' => 28000, 'status' => 'pending', 'created_at' => '2024-01-18', 'approved_at' => null, 'expiry_days_left' => 25],
        ['id' => 3, 'number' => 'Q-2024-003', 'customer' => 'شركة البناء المتقدم', 'project' => 'تأمين منشآت', 'branch' => 'الفرع الرئيسي', 'total' => 65000, 'status' => 'draft', 'created_at' => '2024-01-20', 'approved_at' => null, 'expiry_days_left' => 30],
        ['id' => 4, 'number' => 'Q-2024-004', 'customer' => 'مجموعة الرواد', 'project' => 'حراسات ليلية', 'branch' => 'فرع الملك فهد', 'total' => 32000, 'status' => 'rejected', 'created_at' => '2024-01-22', 'approved_at' => null, 'expiry_days_left' => 0],
        ['id' => 5, 'number' => 'Q-2024-005', 'customer' => 'شركة الأمل', 'project' => 'خدمات متكاملة', 'branch' => 'الفرع الرئيسي', 'total' => 58000, 'status' => 'approved', 'created_at' => '2024-01-25', 'approved_at' => '2024-01-26', 'expiry_days_left' => 22],
        ['id' => 6, 'number' => 'Q-2024-006', 'customer' => 'مؤسسة التطوير', 'project' => 'أمن وحراسة', 'branch' => 'فرع الملك فهد', 'total' => 42000, 'status' => 'expired', 'created_at' => '2023-12-10', 'approved_at' => '2023-12-12', 'expiry_days_left' => -15],
        ['id' => 7, 'number' => 'Q-2024-007', 'customer' => 'شركة الحماية الشاملة', 'project' => 'حراسة مجمع تجاري', 'branch' => 'الفرع الرئيسي', 'total' => 75000, 'status' => 'pending', 'created_at' => '2024-01-28', 'approved_at' => null, 'expiry_days_left' => 18],
        ['id' => 8, 'number' => 'Q-2024-008', 'customer' => 'مؤسسة النجاح', 'project' => 'خدمات أمنية', 'branch' => 'فرع الملك فهد', 'total' => 38000, 'status' => 'draft', 'created_at' => '2024-01-30', 'approved_at' => null, 'expiry_days_left' => 30],
        ['id' => 9, 'number' => 'Q-2024-009', 'customer' => 'شركة المستقبل', 'project' => 'تأمين مقر الشركة', 'branch' => 'الفرع الرئيسي', 'total' => 52000, 'status' => 'approved', 'created_at' => '2024-02-01', 'approved_at' => '2024-02-02', 'expiry_days_left' => 28],
        ['id' => 10, 'number' => 'Q-2024-010', 'customer' => 'مجموعة السلام', 'project' => 'حراسة مستودعات', 'branch' => 'فرع الملك فهد', 'total' => 48000, 'status' => 'pending', 'created_at' => '2024-02-03', 'approved_at' => null, 'expiry_days_left' => 12],
        ['id' => 11, 'number' => 'Q-2024-011', 'customer' => 'شركة التقدم', 'project' => 'خدمات نظافة', 'branch' => 'الفرع الرئيسي', 'total' => 35000, 'status' => 'approved', 'created_at' => '2024-02-05', 'approved_at' => '2024-02-06', 'expiry_days_left' => 35],
        ['id' => 12, 'number' => 'Q-2024-012', 'customer' => 'مؤسسة الإبداع', 'project' => 'أمن وسلامة', 'branch' => 'فرع الملك فهد', 'total' => 62000, 'status' => 'draft', 'created_at' => '2024-02-08', 'approved_at' => null, 'expiry_days_left' => 30],
    ];

    // Status counts for chips
    $statusCounts = [
        'all' => count($quotations),
        'draft' => count(array_filter($quotations, fn($q) => $q['status'] === 'draft')),
        'pending' => count(array_filter($quotations, fn($q) => $q['status'] === 'pending')),
        'approved' => count(array_filter($quotations, fn($q) => $q['status'] === 'approved')),
        'rejected' => count(array_filter($quotations, fn($q) => $q['status'] === 'rejected')),
        'expired' => count(array_filter($quotations, fn($q) => $q['status'] === 'expired')),
    ];
    @endphp

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">عروض الأسعار</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <span>عروض الأسعار</span>
            </nav>
        </div>
        <div class="page-header__right">
            <button class="btn btn--outline" id="templatesBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                </svg>
                قوالب البنود
            </button>
            <div class="dropdown" id="exportDropdown">
                <button class="btn btn--outline dropdown-toggle" aria-expanded="false">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    تصدير
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item" id="exportPdfBtn">تصدير PDF</a>
                    <a href="#" class="dropdown-item" id="exportExcelBtn">تصدير Excel</a>
                </div>
            </div>
            <button class="btn btn--primary" id="createQuoteBtn" onclick="window.location.href='{{ route('quotations.create') }}'">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                إنشاء عرض سعر
            </button>
        </div>
    </div>

    <!-- Status Chips -->
    <div class="status-chips">
        <button class="status-chip active" data-status="all">
            <span class="chip-label">الكل</span>
            <span class="chip-count">{{ $statusCounts['all'] }}</span>
        </button>
        <button class="status-chip" data-status="draft">
            <span class="chip-label">مسودة</span>
            <span class="chip-count">{{ $statusCounts['draft'] }}</span>
        </button>
        <button class="status-chip" data-status="pending">
            <span class="chip-label">بانتظار اعتماد</span>
            <span class="chip-count">{{ $statusCounts['pending'] }}</span>
        </button>
        <button class="status-chip" data-status="approved">
            <span class="chip-label">معتمد</span>
            <span class="chip-count">{{ $statusCounts['approved'] }}</span>
        </button>
        <button class="status-chip" data-status="rejected">
            <span class="chip-label">مرفوض</span>
            <span class="chip-count">{{ $statusCounts['rejected'] }}</span>
        </button>
        <button class="status-chip" data-status="expired">
            <span class="chip-label">منتهي</span>
            <span class="chip-count">{{ $statusCounts['expired'] }}</span>
        </button>
    </div>

    <!-- Toolbar -->
    <div class="toolbar">
        <div class="toolbar__search">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
            </svg>
            <input type="text" class="toolbar__input" id="searchInput" placeholder="ابحث برقم العرض أو اسم العميل أو المشروع...">
        </div>

        <div class="toolbar__filters">
            <button class="btn btn--outline btn--sm" id="columnPickerBtn">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                </svg>
                إظهار الأعمدة
            </button>
            <button class="btn btn--text" id="clearFilters">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                مسح الفلاتر
            </button>
        </div>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div class="table-wrapper">
            <table class="quotations-table" id="quotationsTable">
                <thead>
                    <tr>
                        <th class="col-number">رقم العرض</th>
                        <th class="col-customer">العميل</th>
                        <th class="col-project">المشروع</th>
                        <th class="col-branch">الفرع</th>
                        <th class="col-total">الإجمالي</th>
                        <th class="col-status">الحالة</th>
                        <th class="col-created">تاريخ الإنشاء</th>
                        <th class="col-approved">تاريخ الاعتماد</th>
                        <th class="col-expiry">الصلاحية</th>
                        <th class="col-actions">الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="quotationsTableBody">
                    @foreach($quotations as $quote)
                    <tr class="quote-row" 
                        data-quote-id="{{ $quote['id'] }}" 
                        data-status="{{ $quote['status'] }}"
                        data-search="{{ strtolower($quote['number'] . ' ' . $quote['customer'] . ' ' . $quote['project']) }}">
                            <td>
                                <a href="{{ route('quotations.show', $quote['id']) }}" class="quotation-number">{{ $quote['number'] }}</a>
                            </td>
                        <td class="col-customer">{{ $quote['customer'] }}</td>
                        <td class="col-project">{{ $quote['project'] }}</td>
                        <td class="col-branch">{{ $quote['branch'] }}</td>
                        <td class="col-total">{{ number_format($quote['total']) }} ر.س</td>
                        <td class="col-status">
                            <span class="badge badge--{{ $quote['status'] }}">
                                @if($quote['status'] == 'draft') مسودة
                                @elseif($quote['status'] == 'pending') بانتظار اعتماد
                                @elseif($quote['status'] == 'approved') معتمد
                                @elseif($quote['status'] == 'rejected') مرفوض
                                @else منتهي
                                @endif
                            </span>
                        </td>
                        <td class="col-created">{{ $quote['created_at'] }}</td>
                        <td class="col-approved">{{ $quote['approved_at'] ?? '-' }}</td>
                        <td class="col-expiry">
                            @if($quote['expiry_days_left'] > 0)
                                <div class="expiry-indicator expiry--{{ $quote['expiry_days_left'] < 15 ? 'warning' : 'ok' }}">
                                    <span>{{ $quote['expiry_days_left'] }} يوم</span>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: {{ min(100, ($quote['expiry_days_left'] / 30) * 100) }}%"></div>
                                    </div>
                                </div>
                            @else
                                <span class="expiry-expired">منتهي</span>
                            @endif
                        </td>
                        <td class="col-actions">
                            <div class="dropdown actions-dropdown">
                                <button class="btn-icon" aria-label="الإجراءات" aria-expanded="false">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu--left">
                                    <a href="{{ route('quotations.show', $quote['id']) }}" class="dropdown-item">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                        عرض التفاصيل
                                    </a>
                                    @if($quote['status'] == 'draft')
                                    <a href="#" class="dropdown-item">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                        تعديل
                                    </a>
                                    @endif
                                    <a href="#" class="dropdown-item copy-link" data-number="{{ $quote['number'] }}">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"/>
                                            <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"/>
                                        </svg>
                                        نسخ رقم العرض
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        تحميل PDF
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    @if($quote['status'] == 'draft')
                                    <a href="#" class="dropdown-item send-approval" data-quote-id="{{ $quote['id'] }}">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                                        </svg>
                                        إرسال للاعتماد
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        <div class="empty-state" id="emptyState" style="display: none;">
            <svg width="64" height="64" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <h3>لا توجد نتائج</h3>
            <p>لم يتم العثور على عروض أسعار مطابقة للبحث أو الفلاتر</p>
            <button class="btn btn--outline" id="emptyStateClear">مسح الفلاتر</button>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <button class="pagination__btn" id="prevPage" disabled>
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                السابق
            </button>
            <div class="pagination__pages">
                <button class="pagination__page active">1</button>
            </div>
            <button class="pagination__btn" id="nextPage" disabled>
                التالي
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Column Picker Dropdown -->
    <div class="column-picker" id="columnPicker" style="display: none;">
        <div class="column-picker__header">
            <h4>إظهار الأعمدة</h4>
        </div>
        <div class="column-picker__body">
            <label class="column-option">
                <input type="checkbox" class="column-toggle" data-column="number" checked>
                <span>رقم العرض</span>
            </label>
            <label class="column-option">
                <input type="checkbox" class="column-toggle" data-column="customer" checked>
                <span>العميل</span>
            </label>
            <label class="column-option">
                <input type="checkbox" class="column-toggle" data-column="project" checked>
                <span>المشروع</span>
            </label>
            <label class="column-option">
                <input type="checkbox" class="column-toggle" data-column="branch" checked>
                <span>الفرع</span>
            </label>
            <label class="column-option">
                <input type="checkbox" class="column-toggle" data-column="total" checked>
                <span>الإجمالي</span>
            </label>
            <label class="column-option">
                <input type="checkbox" class="column-toggle" data-column="status" checked>
                <span>الحالة</span>
            </label>
            <label class="column-option">
                <input type="checkbox" class="column-toggle" data-column="created" checked>
                <span>تاريخ الإنشاء</span>
            </label>
            <label class="column-option">
                <input type="checkbox" class="column-toggle" data-column="approved" checked>
                <span>تاريخ الاعتماد</span>
            </label>
            <label class="column-option">
                <input type="checkbox" class="column-toggle" data-column="expiry" checked>
                <span>الصلاحية</span>
            </label>
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
                    <label class="form-label">ملاحظات</label>
                    <textarea class="form-input" rows="3" placeholder="أضف ملاحظات إضافية..."></textarea>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="sendApprovalBtn">إرسال</button>
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
@endsection



