@extends('layouts.app')

@section('title', 'تفاصيل العميل')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/customers-show.css') }}">
@endpush

@section('content')
    @php
    // Dummy customer data
    $customer = [
        'id' => 1,
        'code' => 'C-001',
        'name' => 'شركة النور للأمن',
        'sector' => 'أمن',
        'status' => 'active',
        'cr' => '1010123456',
        'vat' => '300123456700003',
        'contact_person' => 'محمد أحمد',
        'phone' => '0501234567',
        'email' => 'info@alnoor.com',
        'city' => 'الرياض',
        'address' => 'حي الملك فهد، طريق الملك عبدالعزيز'
    ];

    // Dummy quotations
    $quotations = [
        ['id' => 1, 'number' => 'Q-2024-001', 'project' => 'حراسات أمنية', 'branch' => 'الفرع الرئيسي', 'status' => 'pending', 'date' => '2024-01-15'],
        ['id' => 2, 'number' => 'Q-2024-002', 'project' => 'خدمات نظافة', 'branch' => 'فرع الملك فهد', 'status' => 'approved', 'date' => '2024-01-18'],
        ['id' => 3, 'number' => 'Q-2024-003', 'project' => 'تأمين منشآت', 'branch' => 'الفرع الرئيسي', 'status' => 'pending', 'date' => '2024-01-20'],
        ['id' => 4, 'number' => 'Q-2024-004', 'project' => 'حراسات ليلية', 'branch' => 'فرع الملك فهد', 'status' => 'rejected', 'date' => '2024-01-22'],
        ['id' => 5, 'number' => 'Q-2024-005', 'project' => 'خدمات متكاملة', 'branch' => 'الفرع الرئيسي', 'status' => 'approved', 'date' => '2024-01-25'],
    ];

    // Dummy contracts
    $contracts = [
        ['id' => 1, 'number' => 'C-2024-001', 'branch' => 'الفرع الرئيسي', 'status' => 'active', 'start' => '2024-01-01', 'end' => '2024-12-31'],
        ['id' => 2, 'number' => 'C-2024-002', 'branch' => 'فرع الملك فهد', 'status' => 'active', 'start' => '2024-02-01', 'end' => '2024-07-31'],
        ['id' => 3, 'number' => 'C-2023-015', 'branch' => 'الفرع الرئيسي', 'status' => 'expired', 'start' => '2023-06-01', 'end' => '2024-01-31'],
    ];

    // Dummy attachments
    $attachments = [
        ['id' => 1, 'name' => 'السجل_التجاري.pdf', 'size' => '2.4 MB', 'date' => '2024-01-10'],
        ['id' => 2, 'name' => 'شهادة_الزكاة.pdf', 'size' => '1.8 MB', 'date' => '2024-01-10'],
        ['id' => 3, 'name' => 'عقد_تأسيسي.pdf', 'size' => '3.2 MB', 'date' => '2024-01-12'],
    ];

    // Dummy notes
    $notes = [
        ['id' => 1, 'content' => 'عميل مميز، يفضل التواصل المباشر مع المدير التنفيذي', 'author' => 'أحمد محمد', 'date' => '2024-01-15 10:30'],
        ['id' => 2, 'content' => 'تم الاتفاق على خصم 10% للعقود السنوية', 'author' => 'سارة علي', 'date' => '2024-01-18 14:20'],
    ];

    // Dummy contacts
    $contacts = [
        ['id' => 1, 'name' => 'محمد أحمد', 'position' => 'المدير التنفيذي', 'phone' => '0501234567', 'email' => 'mohamed@alnoor.com'],
        ['id' => 2, 'name' => 'خالد سعيد', 'position' => 'مدير المشتريات', 'phone' => '0551234567', 'email' => 'khaled@alnoor.com'],
    ];
    @endphp

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">تفاصيل العميل</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <a href="{{ route('customers') }}">العملاء</a>
                <span>/</span>
                <span>تفاصيل العميل</span>
            </nav>
        </div>
        <div class="page-header__right">
            <button class="btn btn--outline" id="backBtn" onclick="window.location.href='{{ route('customers') }}'">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                رجوع للقائمة
            </button>
            <button class="btn btn--outline" id="createQuoteBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                </svg>
                إنشاء عرض سعر
            </button>
            <button class="btn btn--outline" id="archiveBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                    <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ $customer['status'] == 'active' ? 'أرشفة' : 'إلغاء الأرشفة' }}
            </button>
            <button class="btn btn--primary" id="editCustomerBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                </svg>
                تعديل العميل
            </button>
        </div>
    </div>

    <!-- Customer Profile Card -->
    <div class="profile-card">
        <div class="profile-card__header">
            <div class="customer-avatar-large">{{ mb_substr($customer['name'], 0, 1) }}</div>
            <div class="profile-info">
                <h2>{{ $customer['name'] }}</h2>
                <div class="profile-chips">
                    <span class="chip">{{ $customer['sector'] }}</span>
                    <span class="badge badge--{{ $customer['status'] == 'active' ? 'success' : 'secondary' }}">
                        {{ $customer['status'] == 'active' ? 'نشط' : 'مؤرشف' }}
                    </span>
                </div>
            </div>
        </div>
        <div class="profile-card__body">
            <div class="profile-details">
                <div class="detail-item">
                    <span class="detail-label">كود العميل</span>
                    <span class="detail-value">{{ $customer['code'] }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">السجل التجاري</span>
                    <span class="detail-value">{{ $customer['cr'] ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">الرقم الضريبي</span>
                    <span class="detail-value">{{ $customer['vat'] ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">الشخص المسؤول</span>
                    <span class="detail-value">{{ $customer['contact_person'] }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">رقم الجوال</span>
                    <span class="detail-value">{{ $customer['phone'] }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">البريد الإلكتروني</span>
                    <span class="detail-value">{{ $customer['email'] }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">المدينة</span>
                    <span class="detail-value">{{ $customer['city'] }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">العنوان</span>
                    <span class="detail-value">{{ $customer['address'] }}</span>
                </div>
            </div>
            <div class="profile-actions">
                <button class="btn btn--sm btn--outline" id="copyContactBtn">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"/>
                        <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"/>
                    </svg>
                    نسخ بيانات التواصل
                </button>
                <a href="mailto:{{ $customer['email'] }}" class="btn btn--sm btn--outline">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                    إرسال بريد
                </a>
                <a href="tel:{{ $customer['phone'] }}" class="btn btn--sm btn--outline">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                    </svg>
                    اتصال
                </a>
            </div>
        </div>
    </div>

    <!-- KPIs Cards -->
    <div class="kpis-grid">
        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--blue">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="kpi-content">
                <h4>إجمالي عروض الأسعار</h4>
                <div class="kpi-value">45</div>
                <div class="kpi-footer">
                    <span class="change change--up">+12%</span>
                    <span class="kpi-note">آخر تحديث: اليوم</span>
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--green">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="kpi-content">
                <h4>عروض هذا الشهر</h4>
                <div class="kpi-value">8</div>
                <div class="kpi-footer">
                    <span class="change change--up">+2</span>
                    <span class="kpi-note">آخر تحديث: اليوم</span>
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--purple">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="kpi-content">
                <h4>العقود السارية</h4>
                <div class="kpi-value">12</div>
                <div class="kpi-footer">
                    <span class="change change--up">+3</span>
                    <span class="kpi-note">آخر تحديث: أمس</span>
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--orange">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="kpi-content">
                <h4>القيمة التقديرية</h4>
                <div class="kpi-value">2.4M</div>
                <div class="kpi-footer">
                    <span class="change change--up">+18%</span>
                    <span class="kpi-note">ريال سعودي</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Container -->
    <div class="tabs-container">
        <div class="tabs-header">
            <button class="tab-btn active" data-tab="overview" aria-selected="true">نظرة عامة</button>
            <button class="tab-btn" data-tab="quotes" aria-selected="false">عروض الأسعار</button>
            <button class="tab-btn" data-tab="contracts" aria-selected="false">العقود</button>
            <button class="tab-btn" data-tab="attachments" aria-selected="false">المرفقات</button>
            <button class="tab-btn" data-tab="notes" aria-selected="false">الملاحظات</button>
            <button class="tab-btn" data-tab="contacts" aria-selected="false">جهات الاتصال</button>
        </div>

        <div class="tabs-content">
            <!-- Overview Tab -->
            <div class="tab-pane active" id="overview-tab">
                <div class="tab-grid">
                    <div class="timeline-section">
                        <h3 class="section-title">آخر النشاطات</h3>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <p><strong>تم إنشاء عرض سعر جديد</strong></p>
                                    <span class="timeline-time">منذ ساعتين</span>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <p><strong>تم اعتماد عرض السعر Q-2024-002</strong></p>
                                    <span class="timeline-time">منذ 5 ساعات</span>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <p><strong>تحديث بيانات العميل</strong></p>
                                    <span class="timeline-time">أمس</span>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <p><strong>إضافة ملاحظة جديدة</strong></p>
                                    <span class="timeline-time">منذ يومين</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alerts-section">
                        <h3 class="section-title">التنبيهات</h3>
                        <div class="alert-list">
                            <div class="alert-box alert-box--warning">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <strong>عرض قريب الانتهاء</strong>
                                    <p>عرض السعر Q-2024-003 صالح حتى 2024-02-15</p>
                                </div>
                            </div>
                            <div class="alert-box alert-box--info">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <strong>تجديد عقد قريب</strong>
                                    <p>العقد C-2024-002 ينتهي في 2024-07-31</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quotes Tab -->
            <div class="tab-pane" id="quotes-tab">
                <div class="tab-toolbar">
                    <input type="text" class="search-input-sm" id="quotesSearch" placeholder="بحث في العروض...">
                </div>
                <div class="table-wrapper">
                    <table class="data-table" id="quotesTable">
                        <thead>
                            <tr>
                                <th>رقم العرض</th>
                                <th>المشروع</th>
                                <th>الفرع</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotations as $quote)
                            <tr data-search="{{ strtolower($quote['number'] . ' ' . $quote['project']) }}">
                                <td><strong>{{ $quote['number'] }}</strong></td>
                                <td>{{ $quote['project'] }}</td>
                                <td>{{ $quote['branch'] }}</td>
                                <td>
                                    <span class="badge badge--{{ $quote['status'] == 'approved' ? 'success' : ($quote['status'] == 'pending' ? 'warning' : 'danger') }}">
                                        {{ $quote['status'] == 'approved' ? 'معتمد' : ($quote['status'] == 'pending' ? 'قيد المراجعة' : 'مرفوض') }}
                                    </span>
                                </td>
                                <td>{{ $quote['date'] }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon-sm" aria-label="عرض">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                        <button class="btn-icon-sm" aria-label="تحميل PDF">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Contracts Tab -->
            <div class="tab-pane" id="contracts-tab">
                <div class="tab-toolbar">
                    <input type="text" class="search-input-sm" id="contractsSearch" placeholder="بحث في العقود...">
                </div>
                <div class="table-wrapper">
                    <table class="data-table" id="contractsTable">
                        <thead>
                            <tr>
                                <th>رقم العقد</th>
                                <th>الفرع</th>
                                <th>الحالة</th>
                                <th>تاريخ البداية</th>
                                <th>تاريخ النهاية</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contracts as $contract)
                            <tr data-search="{{ strtolower($contract['number'] . ' ' . $contract['branch']) }}">
                                <td><strong>{{ $contract['number'] }}</strong></td>
                                <td>{{ $contract['branch'] }}</td>
                                <td>
                                    <span class="badge badge--{{ $contract['status'] == 'active' ? 'success' : 'secondary' }}">
                                        {{ $contract['status'] == 'active' ? 'ساري' : 'منتهي' }}
                                    </span>
                                </td>
                                <td>{{ $contract['start'] }}</td>
                                <td>{{ $contract['end'] }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon-sm" aria-label="عرض">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                        <button class="btn-icon-sm" aria-label="تحميل PDF">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Attachments Tab -->
            <div class="tab-pane" id="attachments-tab">
                <div class="upload-zone" id="uploadZone">
                    <svg width="48" height="48" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <h4>اسحب الملفات هنا أو اضغط للاختيار</h4>
                    <p>الملفات المدعومة: PDF, JPG, PNG, DOC, DOCX</p>
                    <input type="file" id="fileInput" style="display: none;" multiple>
                </div>

                <div class="attachments-list">
                    @foreach($attachments as $attachment)
                    <div class="attachment-item">
                        <div class="attachment-icon">
                            <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="attachment-info">
                            <div class="attachment-name">{{ $attachment['name'] }}</div>
                            <div class="attachment-meta">{{ $attachment['size'] }} • {{ $attachment['date'] }}</div>
                        </div>
                        <div class="attachment-actions">
                            <button class="btn-icon-sm" aria-label="تحميل">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <button class="btn-icon-sm btn-icon-danger" aria-label="حذف">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Notes Tab -->
            <div class="tab-pane" id="notes-tab">
                <div class="notes-form">
                    <textarea class="form-textarea" id="noteInput" placeholder="اكتب ملاحظة جديدة..." rows="3"></textarea>
                    <button class="btn btn--primary btn--sm" id="addNoteBtn">إضافة ملاحظة</button>
                </div>

                <div class="notes-list">
                    @foreach($notes as $note)
                    <div class="note-item">
                        <div class="note-header">
                            <div class="note-author">
                                <div class="note-avatar">{{ mb_substr($note['author'], 0, 1) }}</div>
                                <div>
                                    <strong>{{ $note['author'] }}</strong>
                                    <span class="note-date">{{ $note['date'] }}</span>
                                </div>
                            </div>
                            <button class="btn-icon-sm btn-icon-danger" aria-label="حذف">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                        <div class="note-content">{{ $note['content'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Contacts Tab -->
            <div class="tab-pane" id="contacts-tab">
                <div class="tab-header">
                    <button class="btn btn--primary btn--sm" id="addContactBtn">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                        </svg>
                        إضافة جهة اتصال
                    </button>
                </div>

                <div class="contacts-list">
                    @foreach($contacts as $contact)
                    <div class="contact-card">
                        <div class="contact-avatar">{{ mb_substr($contact['name'], 0, 1) }}</div>
                        <div class="contact-info">
                            <h4>{{ $contact['name'] }}</h4>
                            <p class="contact-position">{{ $contact['position'] }}</p>
                            <div class="contact-details">
                                <div class="contact-detail">
                                    <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                    {{ $contact['phone'] }}
                                </div>
                                <div class="contact-detail">
                                    <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                    {{ $contact['email'] }}
                                </div>
                            </div>
                        </div>
                        <div class="contact-actions">
                            <button class="btn-icon-sm" aria-label="تعديل">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                </svg>
                            </button>
                            <button class="btn-icon-sm btn-icon-danger" aria-label="حذف">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Customer Modal -->
    <div class="modal" id="editModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--large">
            <div class="modal__header">
                <h3 class="modal__title">تعديل بيانات العميل</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <form class="modal__body" id="editForm">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">اسم العميل <span class="required">*</span></label>
                        <input type="text" class="form-input" value="{{ $customer['name'] }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">القطاع</label>
                        <select class="form-input">
                            <option>{{ $customer['sector'] }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">السجل التجاري</label>
                        <input type="text" class="form-input" value="{{ $customer['cr'] }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">الرقم الضريبي</label>
                        <input type="text" class="form-input" value="{{ $customer['vat'] }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">الشخص المسؤول</label>
                        <input type="text" class="form-input" value="{{ $customer['contact_person'] }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">رقم الجوال</label>
                        <input type="tel" class="form-input" value="{{ $customer['phone'] }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-input" value="{{ $customer['email'] }}">
                </div>
                <div class="form-group">
                    <label class="form-label">العنوان</label>
                    <textarea class="form-input" rows="2">{{ $customer['address'] }}</textarea>
                </div>
                <div class="modal__footer">
                    <button type="button" class="btn btn--outline modal__close">إلغاء</button>
                    <button type="submit" class="btn btn--primary">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal" id="contactModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">إضافة جهة اتصال</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <form class="modal__body" id="contactForm">
                <div class="form-group">
                    <label class="form-label">الاسم <span class="required">*</span></label>
                    <input type="text" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">المنصب</label>
                    <input type="text" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">رقم الجوال</label>
                    <input type="tel" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-input">
                </div>
                <div class="modal__footer">
                    <button type="button" class="btn btn--outline modal__close">إلغاء</button>
                    <button type="submit" class="btn btn--primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal modal--small" id="confirmModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">تأكيد الإجراء</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <p id="confirmMessage">هل أنت متأكد من {{ $customer['status'] == 'active' ? 'أرشفة' : 'إلغاء أرشفة' }} هذا العميل؟</p>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="confirmActionBtn">تأكيد</button>
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



