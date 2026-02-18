@extends('layouts.app')

@section('title', 'الأدوار والصلاحيات')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/permissions-index.css') }}">
@endpush

@section('content')
    @php
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
    @endphp

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">الأدوار والصلاحيات</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <span>الأدوار والصلاحيات</span>
            </nav>
        </div>
    </div>

    <!-- Tabs via radio buttons (CSS-only) -->
    <input type="radio" name="permTabRadio" id="tabRoles" class="tab-radio" checked>
    <input type="radio" name="permTabRadio" id="tabPermissions" class="tab-radio">

    <div class="tabs-nav">
        <label for="tabRoles" class="tab-btn">الأدوار <small class="tab-count">{{ count($roles) }}</small></label>
        <label for="tabPermissions" class="tab-btn">الصلاحيات <small
                class="tab-count">{{ count($permissions) }}</small></label>
    </div>

    <!-- TAB: ROLES -->
    <div class="tab-panel tab-panel--roles">
        <div class="table-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>اسم الدور</th>
                            <th>الوصف</th>
                            <th>المستخدمون</th>
                            <th>الصلاحيات</th>
                            <th>النطاق</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $r)
                            <tr>
                                <td><strong>{{ $r['name'] }}</strong></td>
                                <td>{{ $r['desc'] }}</td>
                                <td>{{ $r['users_count'] }}</td>
                                <td>{{ $r['permissions_count'] }}</td>
                                <td>
                                    <span
                                        class="status-badge status-badge--{{ $r['scope'] === 'عام' ? 'success' : 'info' }}">
                                        {{ $r['scope'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB: PERMISSIONS -->
    <div class="tab-panel tab-panel--permissions">
        <div class="table-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>المفتاح</th>
                            <th>الاسم</th>
                            <th>المجموعة</th>
                            <th>الوصف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $p)
                            <tr>
                                <td><code class="code-key">{{ $p['key'] }}</code></td>
                                <td>{{ $p['name_ar'] }}</td>
                                <td><span class="chip chip--group">{{ $p['group'] }}</span></td>
                                <td><span class="text-muted">{{ $p['desc'] }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
