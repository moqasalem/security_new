@extends('layouts.app')

@section('title', 'قوالب البنود')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/item-templates-index.css') }}">
@endpush

@section('content')
    @php
    // Dummy templates data (20 items)
    $templates = [
        ['id' => 1, 'code' => 'TEMP-001', 'name' => 'حراسة أمنية - 8 ساعات', 'type' => 'security', 'description' => 'حارس أمني لمدة 8 ساعات يومياً', 'unit' => 'day', 'price' => 150, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-02-10'],
        ['id' => 2, 'code' => 'TEMP-002', 'name' => 'حراسة أمنية - 12 ساعة', 'type' => 'security', 'description' => 'حارس أمني لمدة 12 ساعة يومياً', 'unit' => 'day', 'price' => 200, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-02-09'],
        ['id' => 3, 'code' => 'TEMP-003', 'name' => 'خدمات نظافة يومية', 'type' => 'cleaning', 'description' => 'خدمة نظافة شاملة يومية', 'unit' => 'day', 'price' => 180, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-02-08'],
        ['id' => 4, 'code' => 'TEMP-004', 'name' => 'بدل مواصلات شهري', 'type' => 'allowance', 'description' => 'بدل مواصلات شهري للموظفين', 'unit' => 'month', 'price' => 300, 'tax_enabled' => false, 'status' => 'active', 'updated_at' => '2024-02-07'],
        ['id' => 5, 'code' => 'TEMP-005', 'name' => 'حراسة ليلية - موقع واحد', 'type' => 'security', 'description' => 'حراسة ليلية لموقع واحد من 8م - 8ص', 'unit' => 'site', 'price' => 450, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-02-06'],
        ['id' => 6, 'code' => 'TEMP-006', 'name' => 'خدمة تعقيم شهرية', 'type' => 'cleaning', 'description' => 'خدمة تعقيم شاملة مرة شهرياً', 'unit' => 'month', 'price' => 550, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-02-05'],
        ['id' => 7, 'code' => 'TEMP-007', 'name' => 'حارس أمني - ساعة', 'type' => 'guards', 'description' => 'تكلفة حارس أمني لساعة واحدة', 'unit' => 'hour', 'price' => 25, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-02-04'],
        ['id' => 8, 'code' => 'TEMP-008', 'name' => 'بدل إقامة شهري', 'type' => 'allowance', 'description' => 'بدل إقامة شهري للموظفين', 'unit' => 'month', 'price' => 500, 'tax_enabled' => false, 'status' => 'active', 'updated_at' => '2024-02-03'],
        ['id' => 9, 'code' => 'TEMP-009', 'name' => 'خدمة نظافة أسبوعية', 'type' => 'cleaning', 'description' => 'خدمة نظافة شاملة مرة أسبوعياً', 'unit' => 'week', 'price' => 400, 'tax_enabled' => true, 'status' => 'archived', 'updated_at' => '2024-01-30'],
        ['id' => 10, 'code' => 'TEMP-010', 'name' => 'حراسة مناسبات - يوم كامل', 'type' => 'security', 'description' => 'فريق حراسة للمناسبات ليوم كامل', 'unit' => 'day', 'price' => 800, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-01-28'],
        ['id' => 11, 'code' => 'TEMP-011', 'name' => 'مشرف أمن - شهري', 'type' => 'guards', 'description' => 'مشرف أمن متواجد بشكل شهري', 'unit' => 'month', 'price' => 5000, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-01-25'],
        ['id' => 12, 'code' => 'TEMP-012', 'name' => 'تأمين موقع بناء', 'type' => 'sites', 'description' => 'تأمين شامل لموقع بناء', 'unit' => 'site', 'price' => 1200, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-01-22'],
        ['id' => 13, 'code' => 'TEMP-013', 'name' => 'خدمة صيانة شهرية', 'type' => 'services', 'description' => 'خدمة صيانة عامة شهرية', 'unit' => 'month', 'price' => 600, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-01-20'],
        ['id' => 14, 'code' => 'TEMP-014', 'name' => 'بدل وجبات يومي', 'type' => 'allowance', 'description' => 'بدل وجبات للموظفين يومياً', 'unit' => 'day', 'price' => 50, 'tax_enabled' => false, 'status' => 'active', 'updated_at' => '2024-01-18'],
        ['id' => 15, 'code' => 'TEMP-015', 'name' => 'حراسة VIP - ساعة', 'type' => 'guards', 'description' => 'حارس VIP مدرب لساعة واحدة', 'unit' => 'hour', 'price' => 80, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-01-15'],
        ['id' => 16, 'code' => 'TEMP-016', 'name' => 'تنظيف موقع صناعي', 'type' => 'cleaning', 'description' => 'خدمة تنظيف للمواقع الصناعية', 'unit' => 'site', 'price' => 900, 'tax_enabled' => true, 'status' => 'archived', 'updated_at' => '2024-01-12'],
        ['id' => 17, 'code' => 'TEMP-017', 'name' => 'حراسة 24 ساعة - موقع', 'type' => 'sites', 'description' => 'حراسة مستمرة 24 ساعة لموقع واحد', 'unit' => 'site', 'price' => 1500, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-01-10'],
        ['id' => 18, 'code' => 'TEMP-018', 'name' => 'استشارات أمنية - ساعة', 'type' => 'services', 'description' => 'استشارات أمنية متخصصة', 'unit' => 'hour', 'price' => 150, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-01-08'],
        ['id' => 19, 'code' => 'TEMP-019', 'name' => 'فريق نظافة - يوم', 'type' => 'cleaning', 'description' => 'فريق نظافة كامل ليوم واحد', 'unit' => 'day', 'price' => 700, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-01-05'],
        ['id' => 20, 'code' => 'TEMP-020', 'name' => 'حراسة مناسبات - ساعة', 'type' => 'security', 'description' => 'حارس للمناسبات لساعة واحدة', 'unit' => 'hour', 'price' => 60, 'tax_enabled' => true, 'status' => 'active', 'updated_at' => '2024-01-02'],
    ];

    // Type counts for chips
    $typeCounts = [
        'all' => count($templates),
        'security' => count(array_filter($templates, fn($t) => $t['type'] === 'security')),
        'guards' => count(array_filter($templates, fn($t) => $t['type'] === 'guards')),
        'cleaning' => count(array_filter($templates, fn($t) => $t['type'] === 'cleaning')),
        'sites' => count(array_filter($templates, fn($t) => $t['type'] === 'sites')),
        'allowance' => count(array_filter($templates, fn($t) => $t['type'] === 'allowance')),
        'services' => count(array_filter($templates, fn($t) => $t['type'] === 'services')),
    ];
    @endphp

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">قوالب البنود</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <span>قوالب البنود</span>
            </nav>
        </div>
        <div class="page-header__right">
            <div class="dropdown" id="exportDropdown">
                <button class="btn btn--outline btn--sm dropdown-toggle" id="btnExportTemplates" aria-expanded="false">
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
            <button class="btn btn--outline btn--sm" id="btnImportTemplates">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                استيراد
            </button>
            <div class="dropdown" id="bulkActionsDropdown">
                <button class="btn btn--outline btn--sm dropdown-toggle" id="btnBulkActions" aria-expanded="false" disabled>
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                    إجراءات جماعية
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item" data-bulk-action="archive">أرشفة المحدد</a>
                    <a href="#" class="dropdown-item" data-bulk-action="delete">حذف المحدد</a>
                </div>
            </div>
            <button class="btn btn--primary btn--sm" id="btnAddTemplate">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                إضافة قالب
            </button>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar">
        <div class="toolbar__search">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
            </svg>
            <input type="text" class="toolbar__input" id="searchInput" placeholder="ابحث بالاسم أو النوع أو الوصف...">
        </div>

        <div class="toolbar__filters">
            <select class="filter-select" id="filterType">
                <option value="">كل الأنواع</option>
                <option value="security">خدمات أمنية</option>
                <option value="guards">حراس</option>
                <option value="cleaning">خدمات نظافة</option>
                <option value="sites">مواقع</option>
                <option value="allowance">بدلات</option>
                <option value="services">خدمات أخرى</option>
            </select>

            <select class="filter-select" id="filterStatus">
                <option value="">كل الحالات</option>
                <option value="active">نشط</option>
                <option value="archived">مؤرشف</option>
            </select>

            <button class="btn btn--text btn--sm" id="btnResetFilters">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                مسح
            </button>

            <button class="btn btn--outline btn--sm" id="btnToggleView" aria-label="تبديل العرض">
                <svg class="view-icon view-icon--table" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                </svg>
                <svg class="view-icon view-icon--cards" width="16" height="16" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                    <path d="M3 4a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 12a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H4a1 1 0 01-1-1v-4zM11 4a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V4zM11 12a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Type Chips -->
    <div class="type-chips">
        <button class="type-chip active" data-type="">
            <span>الكل</span>
            <span class="chip-count">{{ $typeCounts['all'] }}</span>
        </button>
        <button class="type-chip" data-type="security">
            <span>خدمات أمنية</span>
            <span class="chip-count">{{ $typeCounts['security'] }}</span>
        </button>
        <button class="type-chip" data-type="guards">
            <span>حراس</span>
            <span class="chip-count">{{ $typeCounts['guards'] }}</span>
        </button>
        <button class="type-chip" data-type="cleaning">
            <span>خدمات نظافة</span>
            <span class="chip-count">{{ $typeCounts['cleaning'] }}</span>
        </button>
        <button class="type-chip" data-type="sites">
            <span>مواقع</span>
            <span class="chip-count">{{ $typeCounts['sites'] }}</span>
        </button>
        <button class="type-chip" data-type="allowance">
            <span>بدلات</span>
            <span class="chip-count">{{ $typeCounts['allowance'] }}</span>
        </button>
        <button class="type-chip" data-type="services">
            <span>خدمات أخرى</span>
            <span class="chip-count">{{ $typeCounts['services'] }}</span>
        </button>
    </div>

    <!-- Bulk Selection Bar -->
    <div class="bulk-bar" id="bulkBar" style="display: none;">
        <div class="bulk-bar__content">
            <span class="bulk-bar__count"><strong id="bulkCount">0</strong> عنصر محدد</span>
            <button class="btn btn--text btn--sm" id="btnClearSelection">إلغاء التحديد</button>
        </div>
    </div>

    <!-- Table View -->
    <div class="table-view active" id="tableView">
        <div class="table-card">
            <div class="table-wrapper">
                <table class="templates-table">
                    <thead>
                        <tr>
                            <th style="width: 40px;">
                                <input type="checkbox" id="selectAll" aria-label="تحديد الكل">
                            </th>
                            <th>الكود</th>
                            <th>اسم القالب</th>
                            <th>النوع</th>
                            <th>الوصف</th>
                            <th>السعر</th>
                            <th>الوحدة</th>
                            <th>الضريبة</th>
                            <th>الحالة</th>
                            <th>آخر تحديث</th>
                            <th style="width: 60px;">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Will be populated by JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Cards View -->
    <div class="cards-view" id="cardsView">
        <div class="cards-grid" id="cardsGrid">
            <!-- Will be populated by JS -->
        </div>
    </div>

    <!-- Empty State -->
    <div class="empty-state" id="emptyState" style="display: none;">
        <svg width="64" height="64" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
        </svg>
        <h3>لا توجد نتائج</h3>
        <p>لم يتم العثور على قوالب مطابقة للبحث أو الفلاتر</p>
        <button class="btn btn--outline" id="emptyStateClear">مسح الفلاتر</button>
    </div>

    <!-- Add/Edit Template Modal -->
    <div class="modal" id="templateModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title" id="templateModalTitle">إضافة قالب جديد</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="form-group">
                    <label class="form-label">اسم القالب <span class="required">*</span></label>
                    <input type="text" class="form-input" id="modalName" placeholder="مثال: حراسة أمنية - 8 ساعات">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">النوع <span class="required">*</span></label>
                        <select class="form-input" id="modalType">
                            <option value="security">خدمات أمنية</option>
                            <option value="guards">حراس</option>
                            <option value="cleaning">خدمات نظافة</option>
                            <option value="sites">مواقع</option>
                            <option value="allowance">بدلات</option>
                            <option value="services">خدمات أخرى</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">وحدة القياس <span class="required">*</span></label>
                        <select class="form-input" id="modalUnit">
                            <option value="hour">ساعة</option>
                            <option value="day">يوم</option>
                            <option value="week">أسبوع</option>
                            <option value="month">شهر</option>
                            <option value="site">موقع</option>
                            <option value="guard">حارس</option>
                            <option value="service">خدمة</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">الوصف</label>
                    <textarea class="form-input" id="modalDescription" rows="3" placeholder="وصف مختصر للقالب..."></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">السعر الافتراضي <span class="required">*</span></label>
                        <input type="number" class="form-input" id="modalPrice" value="0" min="0" step="0.01">
                    </div>
                    <div class="form-group">
                        <label class="form-label">الضريبة</label>
                        <div class="toggle-group">
                            <input type="checkbox" id="modalTaxEnabled" checked>
                            <label for="modalTaxEnabled">تطبيق الضريبة (15%)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="saveTemplateBtn">حفظ القالب</button>
            </div>
        </div>
    </div>

    <!-- View Template Modal -->
    <div class="modal" id="viewModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">تفاصيل القالب</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="view-details" id="viewDetails">
                    <!-- Will be populated by JS -->
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إغلاق</button>
            </div>
        </div>
    </div>

    <!-- Delete/Archive Confirmation Modal -->
    <div class="modal" id="confirmModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title" id="confirmModalTitle">تأكيد الإجراء</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <p id="confirmModalMessage"></p>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--danger" id="confirmActionBtn">تأكيد</button>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal" id="importModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">استيراد قوالب</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="upload-zone" id="importUploadZone">
                    <svg width="48" height="48" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <h4>اسحب ملف CSV أو Excel هنا</h4>
                    <p>أو اضغط للاختيار</p>
                    <input type="file" id="importFileInput" style="display: none;" accept=".csv,.xlsx,.xls">
                </div>
                <div class="import-info">
                    <p><strong>الأعمدة المطلوبة:</strong></p>
                    <p>name, type, description, unit, price, tax_enabled</p>
                    <a href="#" class="btn btn--text btn--sm">تحميل ملف قالب (UI)</a>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="simulateImportBtn">محاكاة الاستيراد</button>
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
        // Pass templates data to JS
        window.templatesData = @json($templates);
    </script>
@endsection



