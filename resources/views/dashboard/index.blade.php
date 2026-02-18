@extends('layouts.app')

@section('title', 'لوحة التحكم')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard.css') }}">
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">لوحة التحكم</h1>
            <nav class="breadcrumb">
                <a href="#">الرئيسية</a>
                <span>/</span>
                <span>لوحة التحكم</span>
            </nav>
        </div>
        <div class="page-header__right">
            <button class="btn btn--secondary" id="refreshBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                </svg>
                تحديث
            </button>
            <div class="dropdown" id="dateFilterDropdown">
                <button class="dropdown-toggle btn btn--outline" aria-expanded="false">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                    <span>هذا الشهر</span>
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">اليوم</a>
                    <a href="#" class="dropdown-item">هذا الأسبوع</a>
                    <a href="#" class="dropdown-item active">هذا الشهر</a>
                    <a href="#" class="dropdown-item">مخصص</a>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="kpi-grid" id="kpiGrid">
        <div class="kpi-card">
            <div class="kpi-card__header">
                <div class="kpi-card__icon kpi-card__icon--blue">
                    <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="kpi-card__body">
                <h3 class="kpi-card__title">إجمالي عروض الأسعار</h3>
                <div class="kpi-card__value">152</div>
                <div class="kpi-card__footer">
                    <span class="change change--up">
                        <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                        </svg>
                        12%
                    </span>
                    <span class="kpi-card__update">آخر تحديث منذ 5 دقائق</span>
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-card__header">
                <div class="kpi-card__icon kpi-card__icon--yellow">
                    <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="kpi-card__body">
                <h3 class="kpi-card__title">العروض بانتظار الاعتماد</h3>
                <div class="kpi-card__value">28</div>
                <div class="kpi-card__footer">
                    <span class="change">بدون تغيير</span>
                    <span class="kpi-card__update">آخر تحديث منذ 10 دقائق</span>
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-card__header">
                <div class="kpi-card__icon kpi-card__icon--green">
                    <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="kpi-card__body">
                <h3 class="kpi-card__title">العقود السارية</h3>
                <div class="kpi-card__value">87</div>
                <div class="kpi-card__footer">
                    <span class="change change--up">
                        <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                        </svg>
                        8%
                    </span>
                    <span class="kpi-card__update">آخر تحديث منذ 15 دقيقة</span>
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-card__header">
                <div class="kpi-card__icon kpi-card__icon--purple">
                    <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                    </svg>
                </div>
            </div>
            <div class="kpi-card__body">
                <h3 class="kpi-card__title">عقود الموظفين قيد التوقيع</h3>
                <div class="kpi-card__value">43</div>
                <div class="kpi-card__footer">
                    <span class="change change--down">
                        <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd"/>
                        </svg>
                        5%
                    </span>
                    <span class="kpi-card__update">آخر تحديث منذ 20 دقيقة</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-card__header">
                <h3>حركة العروض خلال الفترة</h3>
                <div class="chart-legend">
                    <span class="legend-item">
                        <span class="legend-dot legend-dot--blue"></span>
                        المعتمدة
                    </span>
                    <span class="legend-item">
                        <span class="legend-dot legend-dot--yellow"></span>
                        قيد الانتظار
                    </span>
                    <span class="legend-item">
                        <span class="legend-dot legend-dot--red"></span>
                        المرفوضة
                    </span>
                </div>
            </div>
            <div class="chart-placeholder">
                <div class="chart-skeleton">
                    <div class="chart-bars">
                        <div class="chart-bar" style="height: 70%"></div>
                        <div class="chart-bar" style="height: 85%"></div>
                        <div class="chart-bar" style="height: 60%"></div>
                        <div class="chart-bar" style="height: 90%"></div>
                        <div class="chart-bar" style="height: 75%"></div>
                        <div class="chart-bar" style="height: 95%"></div>
                        <div class="chart-bar" style="height: 80%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-card__header">
                <h3>توزيع الحالات</h3>
            </div>
            <div class="chart-placeholder">
                <div class="chart-skeleton">
                    <div class="chart-pie">
                        <svg viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="40" fill="#e2e8f0"/>
                            <circle cx="50" cy="50" r="40" fill="transparent" stroke="#2563eb" stroke-width="40" stroke-dasharray="125 251" transform="rotate(-90 50 50)"/>
                            <circle cx="50" cy="50" r="40" fill="transparent" stroke="#f59e0b" stroke-width="40" stroke-dasharray="63 251" stroke-dashoffset="-125" transform="rotate(-90 50 50)"/>
                            <circle cx="50" cy="50" r="40" fill="transparent" stroke="#dc2626" stroke-width="40" stroke-dasharray="63 251" stroke-dashoffset="-188" transform="rotate(-90 50 50)"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts Section -->
    <div class="alerts-section">
        <div class="alert-item alert-item--warning" id="alert1" data-alert-id="alert1">
            <div class="alert-item__icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="alert-item__content">
                <strong>عروض تنتهي خلال 7 أيام</strong>
                <p>لديك 5 عروض أسعار تنتهي صلاحيتها قريباً</p>
            </div>
            <button class="alert-item__close" aria-label="إغلاق التنبيه">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>

        <div class="alert-item alert-item--danger" id="alert2" data-alert-id="alert2">
            <div class="alert-item__icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="alert-item__content">
                <strong>عقود على وشك الانتهاء</strong>
                <p>هناك 3 عقود تنتهي خلال أسبوعين - يُرجى اتخاذ الإجراء المناسب</p>
            </div>
            <button class="alert-item__close" aria-label="إغلاق التنبيه">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Activity and Quick Actions -->
    <div class="bottom-grid">
        <!-- Recent Activity -->
        <div class="activity-card">
            <div class="card-header">
                <h3>آخر النشاطات</h3>
                <a href="#" class="link-primary">عرض الكل</a>
            </div>
            <div class="activity-list">
                @php
                $activities = [
                    ['user' => 'أحمد محمد', 'action' => 'أنشأ عرض سعر جديد', 'time' => 'قبل 5 دقائق', 'icon' => 'add'],
                    ['user' => 'سارة علي', 'action' => 'وافقت على عقد موظف', 'time' => 'قبل 15 دقيقة', 'icon' => 'check'],
                    ['user' => 'خالد أحمد', 'action' => 'رفض عرض سعر', 'time' => 'قبل 30 دقيقة', 'icon' => 'x'],
                    ['user' => 'فاطمة حسن', 'action' => 'أضافت عميل جديد', 'time' => 'قبل ساعة', 'icon' => 'add'],
                    ['user' => 'عمر سالم', 'action' => 'عدّل معلومات العقد', 'time' => 'قبل ساعتين', 'icon' => 'edit'],
                    ['user' => 'ريم عبدالله', 'action' => 'أنشأت تقرير شهري', 'time' => 'قبل 3 ساعات', 'icon' => 'add'],
                    ['user' => 'ياسر مراد', 'action' => 'حدّث بيانات الفرع', 'time' => 'قبل 4 ساعات', 'icon' => 'edit'],
                    ['user' => 'نورة سعيد', 'action' => 'أضافت مستخدم جديد', 'time' => 'قبل 5 ساعات', 'icon' => 'add']
                ];
                @endphp

                @foreach($activities as $activity)
                <div class="activity-item">
                    <div class="activity-icon activity-icon--{{ $activity['icon'] }}">
                        @if($activity['icon'] == 'add')
                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        @elseif($activity['icon'] == 'check')
                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        @elseif($activity['icon'] == 'x')
                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        @else
                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                        @endif
                    </div>
                    <div class="activity-content">
                        <p><strong>{{ $activity['user'] }}</strong> {{ $activity['action'] }}</p>
                        <span class="activity-time">{{ $activity['time'] }}</span>
                    </div>
                    <a href="#" class="activity-action">عرض</a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions-card">
            <div class="card-header">
                <h3>اختصارات سريعة</h3>
            </div>
            <div class="quick-actions-grid">
                <a href="#" class="quick-action">
                    <div class="quick-action__icon quick-action__icon--blue">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span>إنشاء عرض سعر</span>
                </a>
                <a href="#" class="quick-action">
                    <div class="quick-action__icon quick-action__icon--yellow">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span>العروض بانتظار الاعتماد</span>
                </a>
                <a href="#" class="quick-action">
                    <div class="quick-action__icon quick-action__icon--green">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span>إنشاء عقد</span>
                </a>
                <a href="#" class="quick-action">
                    <div class="quick-action__icon quick-action__icon--purple">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                        </svg>
                    </div>
                    <span>إضافة موظف</span>
                </a>
                <a href="#" class="quick-action">
                    <div class="quick-action__icon quick-action__icon--indigo">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                        </svg>
                    </div>
                    <span>إدارة المستخدمين</span>
                </a>
                <a href="#" class="quick-action">
                    <div class="quick-action__icon quick-action__icon--pink">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                    <span>التقارير</span>
                </a>
            </div>
        </div>
    </div>
@endsection



