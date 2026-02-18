@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/users-index.css') }}">
@endpush



@section('content')
    @php
        $branches = ['الرياض', 'جدة', 'الدمام', 'مكة', 'المدينة'];

        $roles = [
            [
                'id' => 1,
                'name' => 'مدير النظام',
                'desc' => 'صلاحية كاملة على جميع الأقسام',
                'scope' => 'عام',
                'users_count' => 2,
                'permissions_count' => 42,
            ],
            [
                'id' => 2,
                'name' => 'مدير فرع',
                'desc' => 'إدارة فرع محدد',
                'scope' => 'فرع',
                'users_count' => 4,
                'permissions_count' => 28,
            ],
            [
                'id' => 3,
                'name' => 'مدير موارد بشرية',
                'desc' => 'إدارة شؤون الموظفين والعقود',
                'scope' => 'عام',
                'users_count' => 3,
                'permissions_count' => 18,
            ],
            [
                'id' => 4,
                'name' => 'محاسب',
                'desc' => 'إدارة الفواتير والتقارير المالية',
                'scope' => 'فرع',
                'users_count' => 5,
                'permissions_count' => 12,
            ],
            [
                'id' => 5,
                'name' => 'مسؤول مبيعات',
                'desc' => 'إدارة عروض الأسعار والعملاء',
                'scope' => 'فرع',
                'users_count' => 8,
                'permissions_count' => 15,
            ],
            [
                'id' => 6,
                'name' => 'مشاهد',
                'desc' => 'صلاحية عرض فقط بدون تعديل',
                'scope' => 'عام',
                'users_count' => 6,
                'permissions_count' => 8,
            ],
        ];

        $permissionGroups = ['عروض الأسعار', 'العقود', 'المستخدمون', 'التقارير', 'الإعدادات', 'الفروع', 'العملاء'];
        $permissions = [
            [
                'id' => 1,
                'key' => 'quotations.view',
                'name_ar' => 'عرض عروض الأسعار',
                'group' => 'عروض الأسعار',
                'desc' => 'السماح بعرض قائمة العروض',
            ],
            [
                'id' => 2,
                'key' => 'quotations.create',
                'name_ar' => 'إنشاء عرض سعر',
                'group' => 'عروض الأسعار',
                'desc' => 'السماح بإنشاء عروض جديدة',
            ],
            [
                'id' => 3,
                'key' => 'quotations.edit',
                'name_ar' => 'تعديل عرض سعر',
                'group' => 'عروض الأسعار',
                'desc' => 'السماح بتعديل العروض',
            ],
            [
                'id' => 4,
                'key' => 'quotations.approve',
                'name_ar' => 'اعتماد عرض سعر',
                'group' => 'عروض الأسعار',
                'desc' => 'السماح باعتماد العروض',
            ],
            [
                'id' => 5,
                'key' => 'quotations.delete',
                'name_ar' => 'حذف عرض سعر',
                'group' => 'عروض الأسعار',
                'desc' => 'السماح بحذف العروض',
            ],
            [
                'id' => 6,
                'key' => 'contracts.view',
                'name_ar' => 'عرض العقود',
                'group' => 'العقود',
                'desc' => 'السماح بعرض قائمة العقود',
            ],
            [
                'id' => 7,
                'key' => 'contracts.create',
                'name_ar' => 'إنشاء عقد',
                'group' => 'العقود',
                'desc' => 'السماح بإنشاء عقود جديدة',
            ],
            [
                'id' => 8,
                'key' => 'contracts.edit',
                'name_ar' => 'تعديل عقد',
                'group' => 'العقود',
                'desc' => 'السماح بتعديل العقود',
            ],
            [
                'id' => 9,
                'key' => 'contracts.sign',
                'name_ar' => 'توقيع عقد',
                'group' => 'العقود',
                'desc' => 'السماح بتوقيع العقود',
            ],
            [
                'id' => 10,
                'key' => 'users.view',
                'name_ar' => 'عرض المستخدمين',
                'group' => 'المستخدمون',
                'desc' => 'السماح بعرض قائمة المستخدمين',
            ],
            [
                'id' => 11,
                'key' => 'users.create',
                'name_ar' => 'إنشاء مستخدم',
                'group' => 'المستخدمون',
                'desc' => 'السماح بإنشاء مستخدمين جدد',
            ],
            [
                'id' => 12,
                'key' => 'users.edit',
                'name_ar' => 'تعديل مستخدم',
                'group' => 'المستخدمون',
                'desc' => 'السماح بتعديل بيانات المستخدمين',
            ],
            [
                'id' => 13,
                'key' => 'users.delete',
                'name_ar' => 'حذف مستخدم',
                'group' => 'المستخدمون',
                'desc' => 'السماح بحذف المستخدمين',
            ],
            [
                'id' => 14,
                'key' => 'reports.view',
                'name_ar' => 'عرض التقارير',
                'group' => 'التقارير',
                'desc' => 'السماح بعرض التقارير',
            ],
            [
                'id' => 15,
                'key' => 'reports.export',
                'name_ar' => 'تصدير التقارير',
                'group' => 'التقارير',
                'desc' => 'السماح بتصدير التقارير',
            ],
            [
                'id' => 16,
                'key' => 'settings.view',
                'name_ar' => 'عرض الإعدادات',
                'group' => 'الإعدادات',
                'desc' => 'السماح بعرض صفحة الإعدادات',
            ],
            [
                'id' => 17,
                'key' => 'settings.edit',
                'name_ar' => 'تعديل الإعدادات',
                'group' => 'الإعدادات',
                'desc' => 'السماح بتعديل إعدادات النظام',
            ],
            [
                'id' => 18,
                'key' => 'branches.view',
                'name_ar' => 'عرض الفروع',
                'group' => 'الفروع',
                'desc' => 'السماح بعرض قائمة الفروع',
            ],
            [
                'id' => 19,
                'key' => 'branches.manage',
                'name_ar' => 'إدارة الفروع',
                'group' => 'الفروع',
                'desc' => 'السماح بإضافة وتعديل الفروع',
            ],
            [
                'id' => 20,
                'key' => 'customers.view',
                'name_ar' => 'عرض العملاء',
                'group' => 'العملاء',
                'desc' => 'السماح بعرض قائمة العملاء',
            ],
            [
                'id' => 21,
                'key' => 'customers.manage',
                'name_ar' => 'إدارة العملاء',
                'group' => 'العملاء',
                'desc' => 'السماح بإضافة وتعديل العملاء',
            ],
        ];

        $users = [
            [
                'id' => 1,
                'name' => 'عبدالله الراشد',
                'email' => 'abdullah@company.sa',
                'phone' => '0501234567',
                'branch' => 'الرياض',
                'roles' => ['مدير النظام'],
                'status' => 'نشط',
                'last_login' => 'منذ 5 دقائق',
            ],
            [
                'id' => 2,
                'name' => 'محمد العتيبي',
                'email' => 'mohammed@company.sa',
                'phone' => '0557654321',
                'branch' => 'جدة',
                'roles' => ['مدير فرع'],
                'status' => 'نشط',
                'last_login' => 'منذ ساعة',
            ],
            [
                'id' => 3,
                'name' => 'فهد القحطاني',
                'email' => 'fahad@company.sa',
                'phone' => '0509876543',
                'branch' => 'الرياض',
                'roles' => ['مدير موارد بشرية', 'مشاهد'],
                'status' => 'نشط',
                'last_login' => 'منذ 3 ساعات',
            ],
            [
                'id' => 4,
                'name' => 'خالد الشمري',
                'email' => 'khalid@company.sa',
                'phone' => '0541112233',
                'branch' => 'الدمام',
                'roles' => ['محاسب'],
                'status' => 'موقوف',
                'last_login' => 'منذ يومين',
            ],
            [
                'id' => 5,
                'name' => 'سعد المطيري',
                'email' => 'saad@company.sa',
                'phone' => '0563334455',
                'branch' => 'مكة',
                'roles' => ['مسؤول مبيعات'],
                'status' => 'نشط',
                'last_login' => 'منذ 30 دقيقة',
            ],
            [
                'id' => 6,
                'name' => 'يوسف الدوسري',
                'email' => 'yousef@company.sa',
                'phone' => '0525556677',
                'branch' => 'الرياض',
                'roles' => ['مسؤول مبيعات', 'مشاهد'],
                'status' => 'نشط',
                'last_login' => 'اليوم',
            ],
            [
                'id' => 7,
                'name' => 'عمر الزهراني',
                'email' => 'omar@company.sa',
                'phone' => '0587778899',
                'branch' => 'المدينة',
                'roles' => ['مدير فرع'],
                'status' => 'نشط',
                'last_login' => 'أمس',
            ],
            [
                'id' => 8,
                'name' => 'أحمد السبيعي',
                'email' => 'ahmad@company.sa',
                'phone' => '0549990011',
                'branch' => 'جدة',
                'roles' => ['محاسب'],
                'status' => 'موقوف',
                'last_login' => 'منذ أسبوع',
            ],
            [
                'id' => 9,
                'name' => 'بندر العنزي',
                'email' => 'bandar@company.sa',
                'phone' => '0512223344',
                'branch' => 'الرياض',
                'roles' => ['مشاهد'],
                'status' => 'نشط',
                'last_login' => 'منذ ساعتين',
            ],
            [
                'id' => 10,
                'name' => 'ناصر الغامدي',
                'email' => 'nasser@company.sa',
                'phone' => '0534445566',
                'branch' => 'الدمام',
                'roles' => ['مسؤول مبيعات'],
                'status' => 'نشط',
                'last_login' => 'منذ 10 دقائق',
            ],
            [
                'id' => 11,
                'name' => 'تركي الحربي',
                'email' => 'turki@company.sa',
                'phone' => '0566677889',
                'branch' => 'مكة',
                'roles' => ['مدير موارد بشرية'],
                'status' => 'نشط',
                'last_login' => 'اليوم',
            ],
            [
                'id' => 12,
                'name' => 'ماجد السالم',
                'email' => 'majed@company.sa',
                'phone' => '0578899001',
                'branch' => 'الرياض',
                'roles' => ['مدير النظام'],
                'status' => 'نشط',
                'last_login' => 'منذ 15 دقيقة',
            ],
        ];
    @endphp

    <div class="users-page">

        {{-- Header --}}
        <div class="page-header">
            <div class="page-header__left">
                <h1 class="page-title">المستخدمون والصلاحيات</h1>
                <nav class="breadcrumb" aria-label="breadcrumb"><a
                        href="{{ route('dashboard') }}">الرئيسية</a><span>/</span><span>المستخدمون والصلاحيات</span></nav>
            </div>
            <div class="page-header__right">
                <button class="btn btn--primary" id="btnAddUser" aria-label="إضافة مستخدم"><svg width="16"
                        height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
                    </svg> إضافة مستخدم</button>
                <button class="btn btn--outline" id="btnAddRole" aria-label="إضافة دور"><svg width="16" height="16"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
                    </svg> إضافة دور</button>
                <button class="btn btn--outline" id="btnAddPermission" aria-label="إضافة صلاحية"><svg width="16"
                        height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
                    </svg> إضافة صلاحية</button>
                <div class="dropdown-wrap">
                    <button class="btn btn--outline" id="btnExportUsers" aria-label="تصدير" aria-expanded="false"><svg
                            width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg> تصدير</button>
                    <div class="dropdown-menu" id="exportMenu">
                        <button class="dropdown-item" data-export="pdf">تصدير PDF</button>
                        <button class="dropdown-item" data-export="excel">تصدير Excel</button>
                    </div>
                </div>
                <button class="btn btn--outline btn--icon" id="btnRefreshUsers" aria-label="تحديث"><svg width="18"
                        height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                            clip-rule="evenodd" />
                    </svg></button>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="tabs-nav" id="tabsNav">
            <button class="tab-btn active" data-tab="users">المستخدمون <small
                    class="tab-count">{{ count($users) }}</small></button>
            <button class="tab-btn" data-tab="roles" id="btnOpenRolesTab">الأدوار <small
                    class="tab-count">{{ count($roles) }}</small></button>
            {{-- <button class="tab-btn" data-tab="permissions" id="btnOpenPermissionsTab">الصلاحيات <small
                    class="tab-count">{{ count($permissions) }}</small></button> --}}
        </div>

        {{-- ==================== TAB: USERS ==================== --}}
        <div class="tab-panel active" id="panel-users">
            <div class="filter-card">
                <div class="filter-grid">
                    <div class="filter-group filter-group--wide">
                        <input type="text" class="filter-input" id="searchUsers"
                            placeholder="ابحث بالاسم أو البريد أو رقم الجوال...">
                    </div>
                    <div class="filter-group">
                        <select class="filter-select" id="filterRole">
                            <option value="">كل الأدوار</option>
                            @foreach ($roles as $r)
                                <option value="{{ $r['name'] }}">{{ $r['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <select class="filter-select" id="filterBranch">
                            <option value="">كل الفروع</option>
                            @foreach ($branches as $b)
                                <option value="{{ $b }}">{{ $b }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <select class="filter-select" id="filterUserStatus">
                            <option value="">الكل</option>
                            <option value="نشط">نشط</option>
                            <option value="موقوف">موقوف</option>
                        </select>
                    </div>
                    <div class="filter-group filter-group--actions">
                        <button class="btn btn--outline btn--sm" id="btnResetFilters">مسح</button>
                    </div>
                </div>
            </div>

            {{-- Bulk Bar --}}
            <div class="bulk-bar" id="bulkBar" style="display:none;">
                <span class="bulk-bar__text">تم تحديد <strong id="bulkCount">0</strong> مستخدم</span>
                <div class="bulk-bar__actions">
                    <button class="btn btn--sm btn--outline" data-bulk="activate">تفعيل</button>
                    <button class="btn btn--sm btn--outline" data-bulk="deactivate">إيقاف</button>
                    <button class="btn btn--sm btn--outline" data-bulk="assign-role">إسناد دور</button>
                    <button class="btn btn--sm btn--danger" data-bulk="delete">حذف</button>
                </div>
            </div>

            {{-- Users Table --}}
            <div class="table-card">
                <div class="table-scroll">
                    <table class="data-table" id="usersTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllUsers" aria-label="تحديد الكل"></th>
                                <th>المستخدم</th>
                                <th>البريد</th>
                                <th>الجوال</th>
                                <th>الفرع</th>
                                <th>الأدوار</th>
                                <th>آخر دخول</th>
                                <th>الحالة</th>
                                <th>إجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="usersBody">
                            @foreach ($users as $u)
                                <tr data-user-id="{{ $u['id'] }}">
                                    <td><input type="checkbox" class="user-check" value="{{ $u['id'] }}"
                                            aria-label="تحديد {{ $u['name'] }}"></td>
                                    <td>
                                        <div class="user-cell">
                                            <div class="avatar">{{ mb_substr($u['name'], 0, 1) }}</div>
                                            <span>{{ $u['name'] }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $u['email'] }}</td>
                                    <td dir="ltr">{{ $u['phone'] }}</td>
                                    <td>{{ $u['branch'] }}</td>
                                    <td>
                                        <div class="chips">
                                            @foreach ($u['roles'] as $rl)
                                                <span class="chip">{{ $rl }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td><span class="text-muted">{{ $u['last_login'] }}</span></td>
                                    <td><span
                                            class="badge {{ $u['status'] === 'نشط' ? 'badge--active' : 'badge--suspended' }}">{{ $u['status'] }}</span>
                                    </td>
                                    <td>
                                        <div class="actions-wrap">
                                            <button class="btn btn--xs btn--outline" data-menu="user-actions"
                                                data-id="{{ $u['id'] }}" aria-label="إجراءات"
                                                aria-expanded="false">⋯</button>
                                            <div class="actions-menu">
                                                <button class="actions-item" data-action="edit"
                                                    data-id="{{ $u['id'] }}">✏️ تعديل</button>
                                                <button class="actions-item" data-action="assign-roles"
                                                    data-id="{{ $u['id'] }}">🔑 إسناد أدوار</button>
                                                <button class="actions-item" data-action="reset-password"
                                                    data-id="{{ $u['id'] }}">🔒 إعادة كلمة المرور</button>
                                                <button class="actions-item" data-action="toggle-active"
                                                    data-id="{{ $u['id'] }}">{{ $u['status'] === 'نشط' ? '⏸️ إيقاف' : '▶️ تفعيل' }}</button>
                                                <hr class="actions-sep">
                                                <button class="actions-item actions-item--danger" data-action="delete"
                                                    data-id="{{ $u['id'] }}">🗑️ حذف</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="empty-state" id="usersEmpty" style="display:none;">
                    <svg width="48" height="48" viewBox="0 0 20 20" fill="#cbd5e1">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                    <p>لا توجد نتائج مطابقة</p>
                    <button class="btn btn--outline btn--sm" data-clear-filters>مسح الفلاتر</button>
                </div>
                <div class="table-pagination" id="usersPagination">
                    <div class="page-size"><label>عرض:</label><select id="usersPageSize">
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select></div>
                    <div class="page-nav" id="usersPageNav"></div>
                </div>
            </div>
        </div>

        {{-- ==================== TAB: ROLES ==================== --}}
        <div class="tab-panel" id="panel-roles">
            <div class="filter-card">
                <div class="filter-grid">
                    <div class="filter-group filter-group--wide">
                        <input type="text" class="filter-input" id="searchRoles" placeholder="ابحث باسم الدور...">
                    </div>
                    <div class="filter-group">
                        <select class="filter-select" id="filterRoleScope">
                            <option value="">كل النطاقات</option>
                            <option value="عام">عام</option>
                            <option value="فرع">فرع</option>
                            <option value="قسم">قسم</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-card">
                <div class="table-scroll">
                    <table class="data-table" id="rolesTable">
                        <thead>
                            <tr>
                                <th>اسم الدور</th>
                                <th>الوصف</th>
                                <th>المستخدمون</th>
                                <th>الصلاحيات</th>
                                <th>النطاق</th>
                                <th>إجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="rolesBody">
                            @foreach ($roles as $r)
                                <tr data-role-id="{{ $r['id'] }}">
                                    <td><a href="#" class="link-role"
                                            data-role-id="{{ $r['id'] }}">{{ $r['name'] }}</a></td>
                                    <td>{{ $r['desc'] }}</td>
                                    <td>{{ $r['users_count'] }}</td>
                                    <td>{{ $r['permissions_count'] }}</td>
                                    <td><span
                                            class="badge badge--scope-{{ $r['scope'] === 'عام' ? 'global' : ($r['scope'] === 'فرع' ? 'branch' : 'dept') }}">{{ $r['scope'] }}</span>
                                    </td>
                                    <td>
                                        <div class="actions-wrap">
                                            <button class="btn btn--xs btn--outline" data-menu="role-actions"
                                                data-id="{{ $r['id'] }}" aria-label="إجراءات"
                                                aria-expanded="false">⋯</button>
                                            <div class="actions-menu">
                                                <button class="actions-item" data-action="view"
                                                    data-id="{{ $r['id'] }}">👁️ عرض</button>
                                                <button class="actions-item" data-action="edit"
                                                    data-id="{{ $r['id'] }}">✏️ تعديل</button>
                                                <button class="actions-item" data-action="duplicate"
                                                    data-id="{{ $r['id'] }}">📋 نسخ</button>
                                                <hr class="actions-sep">
                                                <button class="actions-item actions-item--danger" data-action="delete"
                                                    data-id="{{ $r['id'] }}">🗑️ حذف</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ==================== TAB: PERMISSIONS ==================== --}}
        <div class="tab-panel" id="panel-permissions">
            <div class="filter-card">
                <div class="filter-grid">
                    <div class="filter-group filter-group--wide">
                        <input type="text" class="filter-input" id="searchPerms"
                            placeholder="ابحث بالمفتاح أو الاسم...">
                    </div>
                    <div class="filter-group">
                        <select class="filter-select" id="filterPermGroup">
                            <option value="">كل المجموعات</option>
                            @foreach ($permissionGroups as $pg)
                                <option value="{{ $pg }}">{{ $pg }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-card">
                <div class="table-scroll">
                    <table class="data-table" id="permsTable">
                        <thead>
                            <tr>
                                <th>المفتاح</th>
                                <th>الاسم</th>
                                <th>المجموعة</th>
                                <th>الوصف</th>
                                <th>إجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="permsBody">
                            @foreach ($permissions as $p)
                                <tr data-perm-id="{{ $p['id'] }}">
                                    <td><code class="code-key">{{ $p['key'] }}</code></td>
                                    <td>{{ $p['name_ar'] }}</td>
                                    <td><span class="chip chip--group">{{ $p['group'] }}</span></td>
                                    <td><span class="text-muted">{{ $p['desc'] }}</span></td>
                                    <td>
                                        <div class="actions-wrap">
                                            <button class="btn btn--xs btn--outline" data-menu="perm-actions"
                                                data-id="{{ $p['id'] }}" aria-label="إجراءات"
                                                aria-expanded="false">⋯</button>
                                            <div class="actions-menu">
                                                <button class="actions-item" data-action="view"
                                                    data-id="{{ $p['id'] }}">👁️ عرض</button>
                                                <button class="actions-item" data-action="edit"
                                                    data-id="{{ $p['id'] }}">✏️ تعديل</button>
                                                <hr class="actions-sep">
                                                <button class="actions-item actions-item--danger" data-action="delete"
                                                    data-id="{{ $p['id'] }}">🗑️ حذف</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== MODALS ==================== --}}

    {{-- Modal: Add/Edit User --}}
    <div class="modal" id="userModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title" id="userModalTitle">إضافة مستخدم</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <input type="hidden" id="editUserId">
                <div class="form-group"><label class="form-label">الاسم <span class="req">*</span></label><input
                        type="text" class="form-input" id="userFormName" required></div>
                <div class="form-group"><label class="form-label">البريد الإلكتروني <span
                            class="req">*</span></label><input type="email" class="form-input" id="userFormEmail"
                        required></div>
                <div class="form-group"><label class="form-label">الجوال</label><input type="tel" class="form-input"
                        id="userFormPhone" dir="ltr"></div>
                <div class="form-row">
                    <div class="form-group"><label class="form-label">الفرع</label><select class="form-select"
                            id="userFormBranch">
                            <option value="">اختر</option>
                            @foreach ($branches as $b)
                                <option value="{{ $b }}">{{ $b }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label">الحالة</label><select class="form-select"
                            id="userFormStatus">
                            <option value="نشط">نشط</option>
                            <option value="موقوف">موقوف</option>
                        </select></div>
                </div>
                <div class="form-group">
                    <label class="form-label">الأدوار</label>
                    <div class="multi-select" id="userFormRoles">
                        @foreach ($roles as $r)
                            <label class="multi-option"><input type="checkbox" value="{{ $r['name'] }}">
                                {{ $r['name'] }}</label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--primary" id="userFormSave">حفظ</button></div>
        </div>
    </div>

    {{-- Modal: Assign Roles --}}
    <div class="modal" id="assignRolesModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">إسناد أدوار</h2><button class="modal__close" aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <input type="hidden" id="assignUserId">
                <p class="modal__desc" id="assignUserName"></p>
                <div class="multi-select" id="assignRolesList">
                    @foreach ($roles as $r)
                        <label class="multi-option"><input type="checkbox" value="{{ $r['name'] }}">
                            {{ $r['name'] }}</label>
                    @endforeach
                </div>
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--primary" id="assignRolesSave">حفظ</button></div>
        </div>
    </div>

    {{-- Modal: Reset Password --}}
    <div class="modal" id="resetPwModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--sm">
            <div class="modal__header">
                <h2 class="modal__title">إعادة تعيين كلمة المرور</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <input type="hidden" id="resetPwUserId">
                <p class="modal__desc" id="resetPwUserName"></p>
                <div class="radio-group">
                    <label class="radio-option"><input type="radio" name="resetMethod" value="link" checked> إرسال
                        رابط إعادة التعيين</label>
                    <label class="radio-option"><input type="radio" name="resetMethod" value="temp"> تعيين كلمة مرور
                        مؤقتة</label>
                </div>
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--primary" id="resetPwConfirm">تأكيد</button></div>
        </div>
    </div>

    {{-- Modal: Toggle Active Confirm --}}
    <div class="modal" id="toggleActiveModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--sm">
            <div class="modal__header">
                <h2 class="modal__title" id="toggleActiveTitle">تأكيد</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <p id="toggleActiveMsg"></p><input type="hidden" id="toggleActiveUserId">
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--primary" id="toggleActiveConfirm">تأكيد</button></div>
        </div>
    </div>

    {{-- Modal: Add/Edit Role --}}
    <div class="modal" id="roleModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--lg">
            <div class="modal__header">
                <h2 class="modal__title" id="roleModalTitle">إضافة دور</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <input type="hidden" id="editRoleId">
                <div class="form-row">
                    <div class="form-group"><label class="form-label">اسم الدور <span
                                class="req">*</span></label><input type="text" class="form-input"
                            id="roleFormName" required></div>
                    <div class="form-group"><label class="form-label">النطاق</label><select class="form-select"
                            id="roleFormScope">
                            <option value="عام">عام</option>
                            <option value="فرع">فرع</option>
                            <option value="قسم">قسم</option>
                        </select></div>
                </div>
                <div class="form-group"><label class="form-label">الوصف</label>
                    <textarea class="form-textarea" id="roleFormDesc" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">الصلاحيات</label>
                    <div class="perms-grid" id="rolePermsGrid">
                        @foreach ($permissionGroups as $pg)
                            <div class="perm-group">
                                <h4 class="perm-group__title">{{ $pg }}</h4>
                                @foreach ($permissions as $p)
                                    @if ($p['group'] === $pg)
                                        <label class="multi-option"><input type="checkbox" value="{{ $p['key'] }}">
                                            {{ $p['name_ar'] }}</label>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--primary" id="roleFormSave">حفظ</button></div>
        </div>
    </div>

    {{-- Modal: Add/Edit Permission --}}
    <div class="modal" id="permModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title" id="permModalTitle">إضافة صلاحية</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <input type="hidden" id="editPermId">
                <div class="form-group"><label class="form-label">المفتاح <span class="req">*</span></label><input
                        type="text" class="form-input" id="permFormKey" placeholder="module.action" required></div>
                <div class="form-row">
                    <div class="form-group"><label class="form-label">الاسم بالعربية</label><input type="text"
                            class="form-input" id="permFormName"></div>
                    <div class="form-group"><label class="form-label">المجموعة</label><select class="form-select"
                            id="permFormGroup">
                            <option value="">اختر</option>
                            @foreach ($permissionGroups as $pg)
                                <option value="{{ $pg }}">{{ $pg }}</option>
                            @endforeach
                        </select></div>
                </div>
                <div class="form-group"><label class="form-label">الوصف</label>
                    <textarea class="form-textarea" id="permFormDesc" rows="2"></textarea>
                </div>
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--primary" id="permFormSave">حفظ</button></div>
        </div>
    </div>

    {{-- Modal: Delete Confirm --}}
    <div class="modal" id="deleteModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--sm">
            <div class="modal__header">
                <h2 class="modal__title">تأكيد الحذف</h2><button class="modal__close" aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <p id="deleteMsg">هل أنت متأكد من حذف هذا العنصر؟</p><input type="hidden" id="deleteTargetId"><input
                    type="hidden" id="deleteTargetType">
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--danger" id="deleteConfirm">حذف</button></div>
        </div>
    </div>

    {{-- Drawer: Role Details --}}
    <div class="drawer" id="roleDrawer">
        <div class="drawer__overlay"></div>
        <div class="drawer__panel">
            <div class="drawer__header">
                <h2 id="drawerRoleName">تفاصيل الدور</h2><button class="drawer__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="drawer__body">
                <div class="drawer-info">
                    <div class="info-row"><span class="info-label">الاسم:</span><span id="drawerRoleNameVal"></span>
                    </div>
                    <div class="info-row"><span class="info-label">الوصف:</span><span id="drawerRoleDesc"></span></div>
                    <div class="info-row"><span class="info-label">النطاق:</span><span id="drawerRoleScope"></span></div>
                    <div class="info-row"><span class="info-label">المستخدمون:</span><span id="drawerRoleUsers"></span>
                    </div>
                </div>
                <h3 class="drawer__subtitle">صلاحيات الدور</h3>
                <div class="drawer-perms" id="drawerPermsList">
                    @foreach ($permissionGroups as $pg)
                        <div class="perm-group">
                            <h4 class="perm-group__title">{{ $pg }}</h4>
                            @foreach ($permissions as $p)
                                @if ($p['group'] === $pg)
                                    <label class="multi-option"><input type="checkbox" value="{{ $p['key'] }}"
                                            class="drawer-perm-check"> {{ $p['name_ar'] }}</label>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="drawer__footer"><button class="btn btn--primary" id="drawerPermsSave">حفظ الصلاحيات</button>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <div class="toast" id="toast" role="status" aria-live="polite"><span class="toast__message"
            id="toastMessage"></span></div>

    <script>
        window.__PAGE_DATA = {
            users: @json($users),
            roles: @json($roles),
            permissions: @json($permissions),
            branches: @json($branches),
            permissionGroups: @json($permissionGroups)
        };
    </script>
@endsection

