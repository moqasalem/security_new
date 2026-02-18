@extends('layouts.app')

@section('title', 'الاعتمادات')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/approvals-index.css') }}">
@endpush

@section('content')
    @php
    // Dummy Approvals Data (15 items)
    $approvals = [
        ['id' => 1, 'type' => 'quotation', 'number' => 'Q-2025-0145', 'customer' => 'شركة الأمن المتطور', 'branch' => 'الرياض', 'created_by' => 'أحمد محمد', 'total' => 17365, 'submitted_at' => '2025-02-10', 'age_days' => 2, 'priority' => 'urgent', 'status' => 'pending'],
        ['id' => 2, 'type' => 'quotation', 'number' => 'Q-2025-0144', 'customer' => 'مؤسسة الحراسات الشاملة', 'branch' => 'جدة', 'created_by' => 'فاطمة علي', 'total' => 24500, 'submitted_at' => '2025-02-11', 'age_days' => 1, 'priority' => 'normal', 'status' => 'pending'],
        ['id' => 3, 'type' => 'quotation', 'number' => 'Q-2025-0143', 'customer' => 'شركة النظافة المثالية', 'branch' => 'الدمام', 'created_by' => 'خالد أحمد', 'total' => 8900, 'submitted_at' => '2025-02-09', 'age_days' => 3, 'priority' => 'normal', 'status' => 'pending'],
        ['id' => 4, 'type' => 'contract', 'number' => 'C-2025-0012', 'customer' => 'الشركة الوطنية للخدمات', 'branch' => 'الرياض', 'created_by' => 'سارة محمود', 'total' => 45000, 'submitted_at' => '2025-02-08', 'age_days' => 4, 'priority' => 'urgent', 'status' => 'pending'],
        ['id' => 5, 'type' => 'quotation', 'number' => 'Q-2025-0142', 'customer' => 'مجمع الأعمال التجاري', 'branch' => 'جدة', 'created_by' => 'محمد حسن', 'total' => 12300, 'submitted_at' => '2025-02-12', 'age_days' => 0, 'priority' => 'normal', 'status' => 'pending'],
        ['id' => 6, 'type' => 'quotation', 'number' => 'Q-2025-0141', 'customer' => 'فندق الضيافة الراقية', 'branch' => 'مكة', 'created_by' => 'نورة عبدالله', 'total' => 31200, 'submitted_at' => '2025-02-11', 'age_days' => 1, 'priority' => 'urgent', 'status' => 'pending'],
        ['id' => 7, 'type' => 'quotation', 'number' => 'Q-2025-0140', 'customer' => 'مستشفى الرعاية الصحية', 'branch' => 'الرياض', 'created_by' => 'عمر يوسف', 'total' => 19800, 'submitted_at' => '2025-02-10', 'age_days' => 2, 'priority' => 'normal', 'status' => 'pending'],
        ['id' => 8, 'type' => 'contract', 'number' => 'C-2025-0011', 'customer' => 'مركز التسوق الكبير', 'branch' => 'جدة', 'created_by' => 'ليلى إبراهيم', 'total' => 52000, 'submitted_at' => '2025-02-07', 'age_days' => 5, 'priority' => 'urgent', 'status' => 'pending'],
        ['id' => 9, 'type' => 'quotation', 'number' => 'Q-2025-0139', 'customer' => 'شركة البناء والتعمير', 'branch' => 'الدمام', 'created_by' => 'حسن علي', 'total' => 15600, 'submitted_at' => '2025-02-11', 'age_days' => 1, 'priority' => 'normal', 'status' => 'pending'],
        ['id' => 10, 'type' => 'quotation', 'number' => 'Q-2025-0138', 'customer' => 'بنك الاستثمار الوطني', 'branch' => 'الرياض', 'created_by' => 'ريم خالد', 'total' => 67500, 'submitted_at' => '2025-02-06', 'age_days' => 6, 'priority' => 'urgent', 'status' => 'pending'],
        ['id' => 11, 'type' => 'quotation', 'number' => 'Q-2025-0137', 'customer' => 'شركة النقل السريع', 'branch' => 'جدة', 'created_by' => 'طارق سعيد', 'total' => 9200, 'submitted_at' => '2025-02-12', 'age_days' => 0, 'priority' => 'normal', 'status' => 'pending'],
        ['id' => 12, 'type' => 'quotation', 'number' => 'Q-2025-0136', 'customer' => 'جامعة المستقبل', 'branch' => 'الرياض', 'created_by' => 'منى أحمد', 'total' => 28900, 'submitted_at' => '2025-02-10', 'age_days' => 2, 'priority' => 'normal', 'status' => 'pending'],
        ['id' => 13, 'type' => 'contract', 'number' => 'C-2025-0010', 'customer' => 'مصنع الإنتاج الصناعي', 'branch' => 'الدمام', 'created_by' => 'ياسر محمود', 'total' => 38400, 'submitted_at' => '2025-02-09', 'age_days' => 3, 'priority' => 'urgent', 'status' => 'pending'],
        ['id' => 14, 'type' => 'quotation', 'number' => 'Q-2025-0135', 'customer' => 'مطار السفر الدولي', 'branch' => 'جدة', 'created_by' => 'علياء حسن', 'total' => 73200, 'submitted_at' => '2025-02-05', 'age_days' => 7, 'priority' => 'urgent', 'status' => 'pending'],
        ['id' => 15, 'type' => 'quotation', 'number' => 'Q-2025-0134', 'customer' => 'شركة التقنية الحديثة', 'branch' => 'الرياض', 'created_by' => 'وليد فهد', 'total' => 11700, 'submitted_at' => '2025-02-11', 'age_days' => 1, 'priority' => 'normal', 'status' => 'pending'],
    ];

    // Dummy items for each approval
    $itemsByApproval = [
        1 => [
            ['name' => 'حراسة أمنية - 8 ساعات', 'qty' => 30, 'price' => 150, 'total' => 4500],
            ['name' => 'خدمة نظافة شاملة', 'qty' => 20, 'price' => 180, 'total' => 3600],
            ['name' => 'بدل مواصلات', 'qty' => 10, 'price' => 300, 'total' => 3000],
        ],
    ];

    // Store data in window for JS
    echo '<script>window.approvalsData = ' . json_encode($approvals) . ';</script>';
    @endphp

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">الاعتمادات</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <span>الاعتمادات</span>
            </nav>
        </div>
        <div class="page-header__right">
            <button class="btn btn--outline btn--sm" id="btnRefresh">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                </svg>
                تحديث
            </button>
            <div class="dropdown" id="exportDropdown">
                <button class="btn btn--outline btn--sm dropdown-toggle" id="btnExport">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    تصدير
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item" data-export="pdf">تصدير PDF</a>
                    <a href="#" class="dropdown-item" data-export="excel">تصدير Excel</a>
                </div>
            </div>
            <button class="btn btn--success btn--sm" id="btnBulkApprove" disabled>
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                اعتماد المحدد
            </button>
            <button class="btn btn--danger btn--sm" id="btnBulkReject" disabled>
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                رفض المحدد
            </button>
            <button class="btn btn--text btn--sm" id="btnResetFilters">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                مسح الفلاتر
            </button>
        </div>
    </div>

    <!-- Summary Chips -->
    <div class="summary-chips">
        <button class="chip-btn active" data-filter="all">
            <span class="chip-label">الكل</span>
            <span class="chip-count" id="countAll">{{ count($approvals) }}</span>
        </button>
        <button class="chip-btn" data-filter="today">
            <span class="chip-label">اليوم</span>
            <span class="chip-count" id="countToday">2</span>
        </button>
        <button class="chip-btn" data-filter="week">
            <span class="chip-label">هذا الأسبوع</span>
            <span class="chip-count" id="countWeek">{{ count($approvals) }}</span>
        </button>
        <button class="chip-btn" data-filter="overdue">
            <span class="chip-label">متأخر (+3 أيام)</span>
            <span class="chip-count" id="countOverdue">6</span>
        </button>
        <button class="chip-btn" data-filter="high-value">
            <span class="chip-label">عالي القيمة (+30,000)</span>
            <span class="chip-count" id="countHighValue">6</span>
        </button>
    </div>

    <!-- Toolbar Filters -->
    <div class="toolbar">
        <div class="toolbar__search">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
            </svg>
            <input type="text" class="toolbar__input" id="searchInput" placeholder="ابحث برقم العرض أو العميل أو الفرع...">
        </div>
        <div class="toolbar__filters">
            <select class="filter-select" id="filterType">
                <option value="">جميع الأنواع</option>
                <option value="quotation">عروض أسعار</option>
                <option value="contract">عقود</option>
            </select>
            <select class="filter-select" id="filterBranch">
                <option value="">جميع الفروع</option>
                <option value="الرياض">الرياض</option>
                <option value="جدة">جدة</option>
                <option value="الدمام">الدمام</option>
                <option value="مكة">مكة</option>
            </select>
            <select class="filter-select" id="filterPriority">
                <option value="">جميع الأولويات</option>
                <option value="normal">عادية</option>
                <option value="urgent">عاجلة</option>
            </select>
        </div>
    </div>

    <!-- Bulk Selection Bar -->
    <div class="bulk-bar" id="bulkBar" style="display: none;">
        <div class="bulk-bar__count">
            تم تحديد <strong id="bulkCount">0</strong> عنصر
        </div>
        <button class="btn btn--text btn--sm" id="btnClearSelection">إلغاء التحديد</button>
    </div>

    <!-- Approvals Table -->
    <div class="table-card">
        <div class="table-wrapper" id="tableWrapper">
            <table class="approvals-table" id="approvalsTable">
                <thead>
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th>رقم الطلب</th>
                        <th>العميل</th>
                        <th>الفرع</th>
                        <th>المنشئ</th>
                        <th>القيمة الإجمالية</th>
                        <th>تاريخ الإرسال</th>
                        <th>العمر</th>
                        <th>الأولوية</th>
                        <th>الحالة</th>
                        <th style="width: 200px;">إجراءات</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach($approvals as $approval)
                    <tr data-id="{{ $approval['id'] }}" data-type="{{ $approval['type'] }}" data-branch="{{ $approval['branch'] }}" data-priority="{{ $approval['priority'] }}" data-age="{{ $approval['age_days'] }}" data-total="{{ $approval['total'] }}">
                        <td>
                            <input type="checkbox" class="approval-checkbox" data-id="{{ $approval['id'] }}">
                        </td>
                        <td>
                            <a href="#" class="approval-number" data-action="open" data-id="{{ $approval['id'] }}">
                                {{ $approval['number'] }}
                            </a>
                        </td>
                        <td>{{ $approval['customer'] }}</td>
                        <td>{{ $approval['branch'] }}</td>
                        <td>{{ $approval['created_by'] }}</td>
                        <td><strong>{{ number_format($approval['total'], 2) }} ر.س</strong></td>
                        <td>{{ $approval['submitted_at'] }}</td>
                        <td>
                            <span class="age-badge age-badge--{{ $approval['age_days'] >= 3 ? 'warning' : 'normal' }}">
                                {{ $approval['age_days'] }} يوم
                            </span>
                        </td>
                        <td>
                            <span class="priority-badge priority-badge--{{ $approval['priority'] }}">
                                {{ $approval['priority'] === 'urgent' ? 'عاجلة' : 'عادية' }}
                            </span>
                        </td>
                        <td>
                            <span class="status-badge status-badge--pending">بانتظار اعتماد</span>
                        </td>
                        <td>
                            <div class="actions-group">
                                <button class="btn-icon btn-icon--success" data-action="approve" data-id="{{ $approval['id'] }}" title="اعتماد">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <button class="btn-icon btn-icon--danger" data-action="reject" data-id="{{ $approval['id'] }}" title="رفض">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <button class="btn-icon" data-action="open" data-id="{{ $approval['id'] }}" title="عرض التفاصيل">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Loading Skeleton -->
            <div class="loading-skeleton" id="loadingSkeleton" style="display: none;">
                <div class="skeleton-row" style="--delay: 0s;"></div>
                <div class="skeleton-row" style="--delay: 0.1s;"></div>
                <div class="skeleton-row" style="--delay: 0.2s;"></div>
                <div class="skeleton-row" style="--delay: 0.3s;"></div>
                <div class="skeleton-row" style="--delay: 0.4s;"></div>
            </div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <svg width="64" height="64" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <h3>لا توجد اعتمادات</h3>
                <p>لا توجد عناصر تطابق معايير البحث</p>
                <button class="btn btn--primary" id="emptyStateClear">مسح الفلاتر</button>
            </div>
        </div>
    </div>

    <!-- Details Drawer -->
    <div class="drawer" id="detailsDrawer">
        <div class="drawer__overlay"></div>
        <div class="drawer__content">
            <div class="drawer__header">
                <h2 class="drawer__title" id="drawerTitle">تفاصيل الاعتماد</h2>
                <button class="drawer__close" aria-label="إغلاق">
                    <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="drawer__body" id="drawerBody">
                <!-- Content will be populated by JS -->
            </div>
            <div class="drawer__footer">
                <button class="btn btn--success" data-action="approve-drawer">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    اعتماد
                </button>
                <button class="btn btn--danger" data-action="reject-drawer">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    رفض
                </button>
                <button class="btn btn--outline" id="btnOpenFullPage">فتح صفحة العرض</button>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div class="modal" id="approveModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">اعتماد الطلب</h3>
                <button class="modal__close">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <p id="approveMessage">هل أنت متأكد من اعتماد هذا الطلب؟</p>
                <div class="form-group">
                    <label class="form-label">ملاحظات (اختياري)</label>
                    <textarea class="form-textarea" id="approveNotes" rows="3" placeholder="أضف ملاحظة..."></textarea>
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
                <h3 class="modal__title">رفض الطلب</h3>
                <button class="modal__close">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <p id="rejectMessage">يرجى تحديد سبب الرفض:</p>
                <div class="form-group">
                    <label class="form-label">سبب الرفض <span class="required">*</span></label>
                    <textarea class="form-textarea" id="rejectReason" rows="4" placeholder="أدخل سبب الرفض..." required></textarea>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--danger" id="confirmRejectBtn">تأكيد الرفض</button>
            </div>
        </div>
    </div>

    <!-- Bulk Confirm Modal -->
    <div class="modal" id="bulkConfirmModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title" id="bulkConfirmTitle">اعتماد جماعي</h3>
                <button class="modal__close">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <p id="bulkConfirmMessage"></p>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--success" id="confirmBulkBtn">تأكيد</button>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div class="toast" id="toast" role="status" aria-live="polite">
        <div class="toast__icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="toast__message" id="toastMessage"></div>
    </div>
@endsection



