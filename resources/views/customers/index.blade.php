@extends('layouts.app')

@section('title', 'العملاء')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/customers-index.css') }}">
@endpush

@section('content')
    @php
    // Dummy customers data
    $customers = [
        ['id' => 1, 'code' => 'C-001', 'name' => 'شركة النور للأمن', 'sector' => 'أمن', 'contact_person' => 'محمد أحمد', 'phone' => '0501234567', 'email' => 'info@alnoor.com', 'quotes' => 12, 'contracts' => 5, 'status' => 'active'],
        ['id' => 2, 'code' => 'C-002', 'name' => 'مؤسسة الفجر للتشغيل', 'sector' => 'تشغيل', 'contact_person' => 'سارة علي', 'phone' => '0551234567', 'email' => 'contact@alfajr.com', 'quotes' => 8, 'contracts' => 3, 'status' => 'active'],
        ['id' => 3, 'code' => 'C-003', 'name' => 'شركة البناء المتقدم', 'sector' => 'مقاولات', 'contact_person' => 'خالد سعيد', 'phone' => '0561234567', 'email' => 'info@albina.com', 'quotes' => 15, 'contracts' => 8, 'status' => 'active'],
        ['id' => 4, 'code' => 'C-004', 'name' => 'مجموعة الرواد التجارية', 'sector' => 'تجارة', 'contact_person' => 'فاطمة حسن', 'phone' => '0501234568', 'email' => 'sales@alrawad.com', 'quotes' => 6, 'contracts' => 2, 'status' => 'archived'],
        ['id' => 5, 'code' => 'C-005', 'name' => 'شركة الأمل للخدمات', 'sector' => 'خدمات', 'contact_person' => 'عمر محمود', 'phone' => '0551234568', 'email' => 'info@alamal.com', 'quotes' => 10, 'contracts' => 4, 'status' => 'active'],
        ['id' => 6, 'code' => 'C-006', 'name' => 'مؤسسة التطوير الحديث', 'sector' => 'تطوير', 'contact_person' => 'ريم عبدالله', 'phone' => '0561234568', 'email' => 'contact@altatweer.com', 'quotes' => 7, 'contracts' => 3, 'status' => 'active'],
        ['id' => 7, 'code' => 'C-007', 'name' => 'شركة الحماية الشاملة', 'sector' => 'أمن', 'contact_person' => 'ياسر مراد', 'phone' => '0501234569', 'email' => 'info@alhimaya.com', 'quotes' => 9, 'contracts' => 6, 'status' => 'active'],
        ['id' => 8, 'code' => 'C-008', 'name' => 'مؤسسة النجاح للمقاولات', 'sector' => 'مقاولات', 'contact_person' => 'نورة سعيد', 'phone' => '0551234569', 'email' => 'info@alnajah.com', 'quotes' => 4, 'contracts' => 1, 'status' => 'archived'],
        ['id' => 9, 'code' => 'C-009', 'name' => 'شركة المستقبل للتقنية', 'sector' => 'تقنية', 'contact_person' => 'محمود علي', 'phone' => '0561234569', 'email' => 'tech@almustaqbal.com', 'quotes' => 11, 'contracts' => 7, 'status' => 'active'],
        ['id' => 10, 'code' => 'C-010', 'name' => 'مجموعة السلام الدولية', 'sector' => 'تجارة', 'contact_person' => 'هند خالد', 'phone' => '0501234570', 'email' => 'info@alsalam.com', 'quotes' => 5, 'contracts' => 2, 'status' => 'active'],
    ];
    @endphp

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">العملاء</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <span>العملاء</span>
            </nav>
        </div>
        <div class="page-header__right">
            <div class="dropdown" id="exportDropdown">
                <button class="btn btn--outline dropdown-toggle" aria-expanded="false">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    تصدير
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">تصدير PDF</a>
                    <a href="#" class="dropdown-item">تصدير Excel</a>
                </div>
            </div>
            <button class="btn btn--outline" id="importBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                استيراد
            </button>
            <button class="btn btn--primary" id="addCustomerBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                </svg>
                إضافة عميل
            </button>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar">
        <div class="toolbar__search">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
            </svg>
            <input type="text" class="toolbar__input" id="searchInput" placeholder="ابحث باسم العميل أو السجل التجاري أو رقم التواصل...">
        </div>
        
        <div class="toolbar__filters">
            <div class="dropdown" id="statusFilter">
                <button class="dropdown-toggle filter-btn" aria-expanded="false">
                    <span class="filter-label">الحالة:</span>
                    <span class="filter-value">الكل</span>
                    <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item active" data-value="all">الكل</a>
                    <a href="#" class="dropdown-item" data-value="active">نشط</a>
                    <a href="#" class="dropdown-item" data-value="archived">مؤرشف</a>
                </div>
            </div>

            <div class="dropdown" id="sectorFilter">
                <button class="dropdown-toggle filter-btn" aria-expanded="false">
                    <span class="filter-label">القطاع:</span>
                    <span class="filter-value">الكل</span>
                    <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item active" data-value="all">الكل</a>
                    <a href="#" class="dropdown-item" data-value="أمن">أمن</a>
                    <a href="#" class="dropdown-item" data-value="تشغيل">تشغيل</a>
                    <a href="#" class="dropdown-item" data-value="مقاولات">مقاولات</a>
                    <a href="#" class="dropdown-item" data-value="تجارة">تجارة</a>
                    <a href="#" class="dropdown-item" data-value="خدمات">خدمات</a>
                    <a href="#" class="dropdown-item" data-value="تطوير">تطوير</a>
                    <a href="#" class="dropdown-item" data-value="تقنية">تقنية</a>
                </div>
            </div>

            <button class="btn btn--text" id="clearFilters">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                مسح الفلاتر
            </button>
        </div>

        <div class="view-switch" role="group" aria-label="View switch">
            <button class="view-btn active" data-view="table" aria-label="عرض الجدول" aria-pressed="true">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z" clip-rule="evenodd"/>
                </svg>
            </button>
            <button class="view-btn" data-view="cards" aria-label="عرض البطاقات" aria-pressed="false">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Table View -->
    <div class="table-container" id="tableView">
        <div class="table-card">
            <div class="table-wrapper">
                <table class="customers-table" id="customersTable">
                    <thead>
                        <tr>
                            <th>الكود</th>
                            <th>اسم العميل</th>
                            <th>القطاع</th>
                            <th>المسؤول</th>
                            <th>الجوال</th>
                            <th>البريد الإلكتروني</th>
                            <th>العروض</th>
                            <th>العقود</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="customersTableBody">
                        @foreach($customers as $customer)
                        <tr class="customer-row" 
                            data-customer-id="{{ $customer['id'] }}" 
                            data-status="{{ $customer['status'] }}" 
                            data-sector="{{ $customer['sector'] }}"
                            data-search="{{ strtolower($customer['name'] . ' ' . $customer['code'] . ' ' . $customer['phone'] . ' ' . $customer['email']) }}">
                            <td>{{ $customer['code'] }}</td>
                            <td>
                                <a href="{{ route('customers.show', $customer['id']) }}" class="customer-name">{{ $customer['name'] }}</a>
                                <div class="customer-phone">{{ $customer['phone'] }}</div>
                            </td>
                            <td>{{ $customer['sector'] }}</td>
                            <td>{{ $customer['contact_person'] }}</td>
                            <td class="customer-email">{{ $customer['email'] }}</td>
                            <td>{{ $customer['quotes'] }}</td>
                            <td>{{ $customer['contracts'] }}</td>
                            <td>
                                <span class="badge badge--{{ $customer['status'] == 'active' ? 'success' : 'secondary' }}">
                                    {{ $customer['status'] == 'active' ? 'نشط' : 'مؤرشف' }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown actions-dropdown">
                                    <button class="btn-icon" aria-label="الإجراءات" aria-expanded="false">
                                        <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu--left">
                                        <a href="{{ route('customers.show', $customer['id']) }}" class="dropdown-item">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                            عرض التفاصيل
                                        </a>
                                        <a href="#" class="dropdown-item edit-customer" data-customer='@json($customer)'>
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                            </svg>
                                            تعديل
                                        </a>
                                        <a href="#" class="dropdown-item copy-contact" data-phone="{{ $customer['phone'] }}" data-email="{{ $customer['email'] }}">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"/>
                                                <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"/>
                                            </svg>
                                            نسخ بيانات التواصل
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                            </svg>
                                            إنشاء عرض سعر
                                        </a>
                                        <a href="#" class="dropdown-item archive-customer" data-customer-id="{{ $customer['id'] }}" data-status="{{ $customer['status'] }}">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                                                <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $customer['status'] == 'active' ? 'أرشفة' : 'إلغاء الأرشفة' }}
                                        </a>
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
                <p>لم يتم العثور على عملاء مطابقين للبحث أو الفلاتر</p>
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
    </div>

    <!-- Cards View -->
    <div class="cards-container" id="cardsView" style="display: none;">
        <div class="customers-grid" id="customersGrid">
            @foreach($customers as $customer)
            <div class="customer-card" 
                data-customer-id="{{ $customer['id'] }}" 
                data-status="{{ $customer['status'] }}" 
                data-sector="{{ strtolower($customer['sector']) }}"
                data-search="{{ strtolower($customer['name'] . ' ' . $customer['code'] . ' ' . $customer['phone'] . ' ' . $customer['email']) }}">
                <a href="{{ route('customers.show', $customer['id']) }}" style="text-decoration: none; color: inherit;">
                    <div class="customer-card__header">
                        <div class="customer-avatar">{{ mb_substr($customer['name'], 0, 1) }}</div>
                        <div class="customer-info">
                            <h3>{{ $customer['name'] }}</h3>
                            <div class="customer-code">{{ $customer['code'] }}</div>
                        </div>
                    </div>
                </a>
                <div class="customer-card__chips">
                    <span class="chip">{{ $customer['sector'] }}</span>
                    <span class="badge badge--{{ $customer['status'] == 'active' ? 'success' : 'secondary' }}">
                        {{ $customer['status'] == 'active' ? 'نشط' : 'مؤرشف' }}
                    </span>
                </div>
                <div class="customer-card__details">
                    <div class="detail-row">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $customer['contact_person'] }}</span>
                    </div>
                    <div class="detail-row">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        <span>{{ $customer['phone'] }}</span>
                    </div>
                    <div class="detail-row">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        <span class="text-truncate">{{ $customer['email'] }}</span>
                    </div>
                </div>
                <div class="customer-card__stats">
                    <div class="stat">
                        <span class="stat-value">{{ $customer['quotes'] }}</span>
                        <span class="stat-label">عروض</span>
                    </div>
                    <div class="stat">
                        <span class="stat-value">{{ $customer['contracts'] }}</span>
                        <span class="stat-label">عقود</span>
                    </div>
                </div>
                <div class="customer-card__actions">
                    <a href="{{ route('customers.show', $customer['id']) }}" class="btn btn--outline btn--sm">عرض التفاصيل</a>
                    <button class="btn btn--primary btn--sm">إنشاء عرض سعر</button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State for Cards -->
        <div class="empty-state" id="emptyStateCards" style="display: none;">
            <svg width="64" height="64" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <h3>لا توجد نتائج</h3>
            <p>لم يتم العثور على عملاء مطابقين للبحث أو الفلاتر</p>
        </div>
    </div>

    <!-- Add/Edit Customer Modal -->
    <div class="modal" id="customerModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--large">
            <div class="modal__header">
                <h3 class="modal__title" id="modalTitle">إضافة عميل جديد</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <form class="modal__body" id="customerForm">
                <input type="hidden" id="customerId">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="customerName" class="form-label">اسم العميل <span class="required">*</span></label>
                        <input type="text" id="customerName" class="form-input" required>
                        <span class="form-error" id="customerNameError"></span>
                    </div>

                    <div class="form-group">
                        <label for="customerSector" class="form-label">القطاع <span class="required">*</span></label>
                        <select id="customerSector" class="form-input" required>
                            <option value="">اختر القطاع</option>
                            <option value="أمن">أمن</option>
                            <option value="تشغيل">تشغيل</option>
                            <option value="مقاولات">مقاولات</option>
                            <option value="تجارة">تجارة</option>
                            <option value="خدمات">خدمات</option>
                            <option value="تطوير">تطوير</option>
                            <option value="تقنية">تقنية</option>
                        </select>
                        <span class="form-error" id="customerSectorError"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="customerCR" class="form-label">السجل التجاري</label>
                        <input type="text" id="customerCR" class="form-input">
                    </div>

                    <div class="form-group">
                        <label for="customerVAT" class="form-label">الرقم الضريبي</label>
                        <input type="text" id="customerVAT" class="form-input">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="contactPerson" class="form-label">الشخص المس��ول <span class="required">*</span></label>
                        <input type="text" id="contactPerson" class="form-input" required>
                        <span class="form-error" id="contactPersonError"></span>
                    </div>

                    <div class="form-group">
                        <label for="customerPhone" class="form-label">رقم الجوال <span class="required">*</span></label>
                        <input type="tel" id="customerPhone" class="form-input" required>
                        <span class="form-error" id="customerPhoneError"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="customerEmail" class="form-label">البريد الإلكتروني</label>
                    <input type="email" id="customerEmail" class="form-input">
                </div>

                <div class="form-group">
                    <label for="customerAddress" class="form-label">العنوان</label>
                    <textarea id="customerAddress" class="form-input" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="customerNotes" class="form-label">ملاحظات</label>
                    <textarea id="customerNotes" class="form-input" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="customerStatus" checked>
                        <span>عميل نشط</span>
                    </label>
                </div>

                <div class="modal__footer">
                    <button type="button" class="btn btn--outline modal__close">إلغاء</button>
                    <button type="submit" class="btn btn--primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal" id="importModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">استيراد العملاء</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="upload-area" id="uploadArea">
                    <svg width="48" height="48" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <h4>اسحب الملف هنا أو اضغط للاختيار</h4>
                    <p>الملفات المدعومة: CSV, XLSX</p>
                    <input type="file" id="fileInput" accept=".csv,.xlsx" style="display: none;">
                </div>
                <div class="import-info">
                    <p><strong>الأعمدة المطلوبة:</strong></p>
                    <ul>
                        <li>اسم العميل (مطلوب)</li>
                        <li>القطاع (مطلوب)</li>
                        <li>الشخص المسؤول</li>
                        <li>رقم الجوال</li>
                        <li>البريد الإلكتروني</li>
                    </ul>
                    <a href="#" class="btn btn--text btn--sm">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        تحميل قالب Excel
                    </a>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary">استيراد</button>
            </div>
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
                <p id="confirmMessage"></p>
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



