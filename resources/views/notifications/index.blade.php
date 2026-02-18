@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/notifications-index.css') }}">
@endpush



@section('content')
@php
$notifications = [
    ['id'=>1,'type'=>'approval','title'=>'عرض سعر بانتظار الاعتماد','body'=>'قام سعد المطيري بإرسال عرض سعر جديد رقم QT-1044 للعميل شركة المستقبل بقيمة 85,000 ريال ويحتاج لاعتمادكم.','ref_type'=>'quotation','ref_code'=>'QT-1044','branch'=>'الرياض','created_by'=>'سعد المطيري','priority'=>'urgent','is_read'=>false,'created_at_human'=>'منذ 5 دقائق'],
    ['id'=>2,'type'=>'contract','title'=>'عقد قارب على الانتهاء','body'=>'العقد رقم CT-310 مع شركة البناء الحديث سينتهي خلال 7 أيام. يرجى اتخاذ الإجراء المناسب لتجديده أو إغلاقه.','ref_type'=>'contract','ref_code'=>'CT-310','branch'=>'جدة','created_by'=>'النظام','priority'=>'urgent','is_read'=>false,'created_at_human'=>'منذ 15 دقيقة'],
    ['id'=>3,'type'=>'employee_contract','title'=>'تم توقيع عقد موظف','body'=>'قام الموظف محمد العتيبي بتوقيع عقد العمل الخاص به بنجاح عبر الرابط الإلكتروني.','ref_type'=>'employee_contract','ref_code'=>'EC-205','branch'=>'جدة','created_by'=>'النظام','priority'=>'normal','is_read'=>false,'created_at_human'=>'منذ 30 دقيقة'],
    ['id'=>4,'type'=>'approval','title'=>'تم اعتماد عرض سعر','body'=>'تم اعتماد عرض السعر رقم QT-1042 من قبل المدير عبدالله الراشد. يمكنك الآن إرسال العرض للعميل.','ref_type'=>'quotation','ref_code'=>'QT-1042','branch'=>'الرياض','created_by'=>'عبدالله الراشد','priority'=>'normal','is_read'=>false,'created_at_human'=>'منذ ساعة'],
    ['id'=>5,'type'=>'system','title'=>'تحديث النظام','body'=>'تم تحديث النظام إلى الإصدار 2.5.0 بنجاح. يتضمن التحديث تحسينات في الأداء وإصلاحات أمنية.','ref_type'=>'system','ref_code'=>'SYS-001','branch'=>'عام','created_by'=>'النظام','priority'=>'normal','is_read'=>true,'created_at_human'=>'منذ ساعتين'],
    ['id'=>6,'type'=>'contract','title'=>'تم إنشاء عقد جديد','body'=>'تم إنشاء العقد رقم CT-319 مع شركة الأمان للخدمات بقيمة 120,000 ريال لمدة سنة.','ref_type'=>'contract','ref_code'=>'CT-319','branch'=>'الرياض','created_by'=>'فهد القحطاني','priority'=>'normal','is_read'=>true,'created_at_human'=>'منذ 3 ساعات'],
    ['id'=>7,'type'=>'approval','title'=>'عرض سعر مرفوض','body'=>'تم رفض عرض السعر رقم QT-1040 من قبل المدير. السبب: الأسعار غير تنافسية مقارنة بالسوق.','ref_type'=>'quotation','ref_code'=>'QT-1040','branch'=>'الدمام','created_by'=>'عبدالله الراشد','priority'=>'normal','is_read'=>true,'created_at_human'=>'منذ 4 ساعات'],
    ['id'=>8,'type'=>'employee_contract','title'=>'عقد موظف بانتظار التوقيع','body'=>'تم إرسال رابط التوقيع للموظف خالد الشمري. ينتظر التوقيع خلال 48 ساعة.','ref_type'=>'employee_contract','ref_code'=>'EC-210','branch'=>'الدمام','created_by'=>'فهد القحطاني','priority'=>'normal','is_read'=>false,'created_at_human'=>'منذ 5 ساعات'],
    ['id'=>9,'type'=>'contract','title'=>'تنبيه: عقد منتهي','body'=>'العقد رقم CT-298 مع مؤسسة الخليج انتهت صلاحيته اليوم. يرجى التواصل مع العميل للتجديد.','ref_type'=>'contract','ref_code'=>'CT-298','branch'=>'مكة','created_by'=>'النظام','priority'=>'urgent','is_read'=>false,'created_at_human'=>'منذ 6 ساعات'],
    ['id'=>10,'type'=>'system','title'=>'نسخة احتياطية مكتملة','body'=>'تم إنشاء النسخة الاحتياطية اليومية بنجاح. حجم النسخة: 2.3 جيجابايت.','ref_type'=>'system','ref_code'=>'SYS-002','branch'=>'عام','created_by'=>'النظام','priority'=>'normal','is_read'=>true,'created_at_human'=>'منذ 8 ساعات'],
    ['id'=>11,'type'=>'approval','title'=>'عرض سعر بانتظار المراجعة','body'=>'قام يوسف الدوسري بإنشاء عرض سعر رقم QT-1045 بقيمة 45,000 ريال لشركة النور.','ref_type'=>'quotation','ref_code'=>'QT-1045','branch'=>'الرياض','created_by'=>'يوسف الدوسري','priority'=>'normal','is_read'=>false,'created_at_human'=>'أمس'],
    ['id'=>12,'type'=>'contract','title'=>'تجديد عقد تلقائي','body'=>'تم تجديد العقد رقم CT-280 تلقائياً لمدة سنة إضافية حسب الشروط المتفق عليها.','ref_type'=>'contract','ref_code'=>'CT-280','branch'=>'جدة','created_by'=>'النظام','priority'=>'normal','is_read'=>true,'created_at_human'=>'أمس'],
    ['id'=>13,'type'=>'employee_contract','title'=>'رفض توقيع عقد موظف','body'=>'رفض الموظف بندر العنزي التوقيع على عقد العمل. يرجى التواصل مع الموارد البشرية.','ref_type'=>'employee_contract','ref_code'=>'EC-208','branch'=>'الرياض','created_by'=>'النظام','priority'=>'urgent','is_read'=>false,'created_at_human'=>'أمس'],
    ['id'=>14,'type'=>'system','title'=>'صيانة مجدولة','body'=>'سيتم إجراء صيانة مجدولة يوم الجمعة من 2:00 ص إلى 4:00 ص. قد يتأثر الوصول للنظام.','ref_type'=>'system','ref_code'=>'SYS-003','branch'=>'عام','created_by'=>'النظام','priority'=>'normal','is_read'=>true,'created_at_human'=>'منذ يومين'],
    ['id'=>15,'type'=>'approval','title'=>'طلب تعديل عرض سعر','body'=>'طلب العميل شركة التقنية تعديل عرض السعر QT-1038 لإضافة بنود إضافية.','ref_type'=>'quotation','ref_code'=>'QT-1038','branch'=>'الرياض','created_by'=>'ناصر الغامدي','priority'=>'normal','is_read'=>true,'created_at_human'=>'منذ يومين'],
    ['id'=>16,'type'=>'contract','title'=>'عقد قارب على الانتهاء','body'=>'العقد رقم CT-305 مع شركة الراية سينتهي خلال 14 يوماً.','ref_type'=>'contract','ref_code'=>'CT-305','branch'=>'المدينة','created_by'=>'النظام','priority'=>'normal','is_read'=>true,'created_at_human'=>'منذ 3 أيام'],
    ['id'=>17,'type'=>'employee_contract','title'=>'تم إنشاء عقد موظف','body'=>'تم إنشاء عقد عمل جديد للموظف تركي الحربي في فرع مكة.','ref_type'=>'employee_contract','ref_code'=>'EC-212','branch'=>'مكة','created_by'=>'فهد القحطاني','priority'=>'normal','is_read'=>true,'created_at_human'=>'منذ 3 أيام'],
    ['id'=>18,'type'=>'system','title'=>'تغيير إعدادات الأمان','body'=>'قام المدير بتفعيل المصادقة الثنائية لجميع المستخدمين.','ref_type'=>'system','ref_code'=>'SYS-004','branch'=>'عام','created_by'=>'عبدالله الراشد','priority'=>'normal','is_read'=>true,'created_at_human'=>'منذ 4 أيام'],
    ['id'=>19,'type'=>'approval','title'=>'عرض سعر معلّق','body'=>'عرض السعر QT-1035 معلق منذ 5 أيام بدون اعتماد. يرجى المراجعة.','ref_type'=>'quotation','ref_code'=>'QT-1035','branch'=>'الدمام','created_by'=>'النظام','priority'=>'urgent','is_read'=>false,'created_at_human'=>'منذ 5 أيام'],
    ['id'=>20,'type'=>'contract','title'=>'إشعار دفعة مستحقة','body'=>'الدفعة الثانية من العقد CT-290 بقيمة 30,000 ريال مستحقة خلال 3 أيام.','ref_type'=>'contract','ref_code'=>'CT-290','branch'=>'الرياض','created_by'=>'النظام','priority'=>'normal','is_read'=>true,'created_at_human'=>'منذ أسبوع'],
];

$timelineData = [
    1 => [['action'=>'أُنشئ عرض السعر','time'=>'منذ ساعة','user'=>'سعد المطيري'],['action'=>'أُرسل للاعتماد','time'=>'منذ 5 دقائق','user'=>'سعد المطيري']],
    2 => [['action'=>'أُنشئ العقد','time'=>'منذ 6 أشهر','user'=>'فهد القحطاني'],['action'=>'تنبيه قرب الانتهاء','time'=>'منذ 15 دقيقة','user'=>'النظام']],
    3 => [['action'=>'أُنشئ العقد','time'=>'منذ يومين','user'=>'فهد القحطاني'],['action'=>'أُرسل رابط التوقيع','time'=>'أمس','user'=>'النظام'],['action'=>'تم التوقيع','time'=>'منذ 30 دقيقة','user'=>'محمد العتيبي']],
];
@endphp

<div class="notif-page">

    {{-- Header --}}
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">الإشعارات</h1>
            <nav class="breadcrumb" aria-label="breadcrumb"><a href="{{ route('dashboard') }}">الرئيسية</a><span>/</span><span>الإشعارات</span></nav>
        </div>
        <div class="page-header__right">
            <button class="btn btn--primary" id="btnMarkAllRead" aria-label="تعيين الكل كمقروء"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg> تعيين الكل كمقروء</button>
            <button class="btn btn--outline" id="btnClearAll" aria-label="حذف الكل">🗑️ حذف الكل</button>
            <button class="btn btn--outline" id="btnOpenPreferences" aria-label="تفضيلات الإشعارات"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/></svg> التفضيلات</button>
            <div class="dropdown-wrap">
                <button class="btn btn--outline" id="btnExportNotifications" aria-label="تصدير" aria-expanded="false"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/></svg> تصدير</button>
                <div class="dropdown-menu" id="exportMenu">
                    <button class="dropdown-item" data-export="csv">تصدير CSV</button>
                    <button class="dropdown-item" data-export="excel">تصدير Excel</button>
                </div>
            </div>
            <button class="btn btn--outline btn--icon" id="btnRefreshNotifications" aria-label="تحديث"><svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg></button>
        </div>
    </div>

    {{-- Summary Chips --}}
    <div class="summary-chips" id="summaryChips">
        <button class="summary-chip active" data-chip="all">الكل <span class="chip-count" id="countAll">{{ count($notifications) }}</span></button>
        <button class="summary-chip" data-chip="unread">غير مقروء <span class="chip-count" id="countUnread">{{ count(array_filter($notifications, fn($n)=>!$n['is_read'])) }}</span></button>
        <button class="summary-chip" data-chip="approval">اعتمادات <span class="chip-count" id="countApproval">{{ count(array_filter($notifications, fn($n)=>$n['type']==='approval')) }}</span></button>
        <button class="summary-chip" data-chip="contract">عقود <span class="chip-count" id="countContract">{{ count(array_filter($notifications, fn($n)=>$n['type']==='contract')) }}</span></button>
        <button class="summary-chip" data-chip="employee_contract">عقود موظفين <span class="chip-count" id="countEmpContract">{{ count(array_filter($notifications, fn($n)=>$n['type']==='employee_contract')) }}</span></button>
        <button class="summary-chip" data-chip="system">نظام <span class="chip-count" id="countSystem">{{ count(array_filter($notifications, fn($n)=>$n['type']==='system')) }}</span></button>
    </div>

    {{-- Filters --}}
    <div class="filter-card">
        <div class="filter-grid">
            <div class="filter-group filter-group--wide">
                <input type="text" class="filter-input" id="searchNotif" placeholder="ابحث بعنوان الإشعار أو المرجع أو اسم العميل/الموظف...">
            </div>
            <div class="filter-group">
                <select class="filter-select" id="filterType">
                    <option value="">كل الأنواع</option>
                    <option value="approval">اعتمادات</option>
                    <option value="contract">عقود</option>
                    <option value="employee_contract">عقود موظفين</option>
                    <option value="system">نظام</option>
                </select>
            </div>
            <div class="filter-group">
                <select class="filter-select" id="filterPriority">
                    <option value="">كل الأولويات</option>
                    <option value="urgent">عاجلة</option>
                    <option value="normal">عادية</option>
                </select>
            </div>
            <div class="filter-group">
                <select class="filter-select" id="filterDate">
                    <option value="">كل الأوقات</option>
                    <option value="today">اليوم</option>
                    <option value="week">هذا الأسبوع</option>
                    <option value="month">هذا الشهر</option>
                </select>
            </div>
            <div class="filter-group filter-group--actions">
                <button class="btn btn--outline btn--sm" id="btnResetFilters">مسح</button>
            </div>
        </div>
    </div>

    {{-- Bulk Bar --}}
    <div class="bulk-bar" id="bulkBar" style="display:none;">
        <span class="bulk-bar__text">تم تحديد <strong id="bulkCount">0</strong> إشعار</span>
        <div class="bulk-bar__actions">
            <button class="btn btn--sm btn--outline" data-action="bulk-read">تعيين كمقروء</button>
            <button class="btn btn--sm btn--outline" id="btnBulkArchive">أرشفة</button>
            <button class="btn btn--sm btn--danger" id="btnBulkDelete">حذف</button>
            <button class="btn btn--sm btn--outline" data-action="bulk-cancel">إلغاء التحديد</button>
        </div>
    </div>

    {{-- Main layout --}}
    <div class="notif-layout">
        {{-- Notification List --}}
        <div class="notif-list-card" id="notifListCard">
            <div class="notif-list-header">
                <label class="select-all-wrap"><input type="checkbox" id="selectAll" aria-label="تحديد الكل"><span>تحديد الكل</span></label>
            </div>
            <div class="notif-list" id="notifList">
                @foreach($notifications as $n)
                <div class="notif-item {{ $n['is_read']?'':'notif-item--unread' }} {{ $n['priority']==='urgent'?'notif-item--urgent':'' }}" data-id="{{ $n['id'] }}" data-type="{{ $n['type'] }}" data-priority="{{ $n['priority'] }}" data-read="{{ $n['is_read']?'1':'0' }}">
                    <div class="notif-item__check"><input type="checkbox" class="notif-check" value="{{ $n['id'] }}" aria-label="تحديد"></div>
                    <div class="notif-item__icon">
                        @if($n['type']==='approval')<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="icon-approval"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        @elseif($n['type']==='contract')<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="icon-contract"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg>
                        @elseif($n['type']==='employee_contract')<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="icon-emp"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/></svg>
                        @else<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="icon-system"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        @endif
                    </div>
                    <div class="notif-item__body" data-action="open" data-id="{{ $n['id'] }}">
                        <div class="notif-item__top">
                            <h3 class="notif-item__title">{{ $n['title'] }}</h3>
                            @if(!$n['is_read'])<span class="unread-dot" title="غير مقروء"></span>@endif
                        </div>
                        <p class="notif-item__desc">{{ Str::limit($n['body'], 80) }}</p>
                        <div class="notif-item__meta">
                            <span class="notif-ref" title="المرجع">{{ $n['ref_code'] }}</span>
                            @if($n['priority']==='urgent')<span class="badge badge--urgent">عاجل</span>@endif
                            <span class="notif-time">{{ $n['created_at_human'] }}</span>
                        </div>
                    </div>
                    <div class="notif-item__actions">
                        <button class="action-btn" data-action="toggle-read" data-id="{{ $n['id'] }}" aria-label="{{ $n['is_read']?'تعليم كغير مقروء':'تعليم كمقروء' }}" title="{{ $n['is_read']?'غير مقروء':'مقروء' }}">{{ $n['is_read']?'📭':'📬' }}</button>
                        <button class="action-btn" data-action="copy-ref" data-id="{{ $n['id'] }}" data-ref="{{ $n['ref_code'] }}" aria-label="نسخ المرجع" title="نسخ المرجع">📋</button>
                        <button class="action-btn" data-action="archive" data-id="{{ $n['id'] }}" aria-label="أرشفة" title="أرشفة">📥</button>
                        <button class="action-btn action-btn--danger" data-action="delete" data-id="{{ $n['id'] }}" aria-label="حذف" title="حذف">🗑️</button>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="empty-state" id="emptyState" style="display:none;">
                <svg width="48" height="48" viewBox="0 0 20 20" fill="#cbd5e1"><path fill-rule="evenodd" d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" clip-rule="evenodd"/></svg>
                <p>لا توجد إشعارات</p>
            </div>
            <div class="load-more-wrap" id="loadMoreWrap"><button class="btn btn--outline" id="btnLoadMore">تحميل المزيد</button></div>
        </div>

        {{-- Preview Panel --}}
        <div class="notif-preview-card" id="previewPanel">
            <div class="preview-empty" id="previewEmpty">
                <svg width="48" height="48" viewBox="0 0 20 20" fill="#cbd5e1"><path fill-rule="evenodd" d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" clip-rule="evenodd"/></svg>
                <p>اختر إشعاراً لعرض تفاصيله</p>
            </div>
            <div class="preview-content" id="previewContent" style="display:none;">
                <div class="preview-header">
                    <h2 id="previewTitle"></h2>
                    <div class="preview-meta"><span class="chip" id="previewType"></span><span class="notif-time" id="previewTime"></span></div>
                </div>
                <div class="preview-body" id="previewBody"></div>
                <div class="preview-info">
                    <div class="info-row"><span class="info-label">المرجع:</span><span id="previewRef"></span></div>
                    <div class="info-row"><span class="info-label">الفرع:</span><span id="previewBranch"></span></div>
                    <div class="info-row"><span class="info-label">المُرسل:</span><span id="previewCreator"></span></div>
                </div>
                <div class="preview-actions">
                    <a href="#" class="btn btn--primary btn--sm" data-action="go-to-ref">فتح المرجع</a>
                    <button class="btn btn--outline btn--sm" data-action="toggle-read-drawer">مقروء/غير مقروء</button>
                    <button class="btn btn--outline btn--sm" data-action="archive-drawer">أرشفة</button>
                    <button class="btn btn--outline btn--sm btn--danger-outline" data-action="delete-drawer">حذف</button>
                </div>
                <div class="preview-timeline">
                    <h3>الأحداث المرتبطة</h3>
                    <div class="timeline" id="previewTimeline"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ==================== MODALS ==================== --}}

{{-- Confirmation Modal --}}
<div class="modal" id="confirmModal">
    <div class="modal__overlay"></div>
    <div class="modal__content modal__content--sm">
        <div class="modal__header"><h2 class="modal__title" id="confirmTitle">تأكيد</h2><button class="modal__close" aria-label="إغلاق">&times;</button></div>
        <div class="modal__body"><p id="confirmMsg"></p><input type="hidden" id="confirmAction"><input type="hidden" id="confirmTarget"></div>
        <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button class="btn btn--danger" id="confirmBtn">تأكيد</button></div>
    </div>
</div>

{{-- Preferences Modal --}}
<div class="modal" id="prefsModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header"><h2 class="modal__title">تفضيلات الإشعارات</h2><button class="modal__close" aria-label="إغلاق">&times;</button></div>
        <div class="modal__body">
            <div class="prefs-tabs">
                <button class="prefs-tab active" data-ptab="channels">القنوات</button>
                <button class="prefs-tab" data-ptab="types">أنواع الإشعارات</button>
                <button class="prefs-tab" data-ptab="quiet">ساعات الهدوء</button>
            </div>
            <div class="prefs-panel active" id="ptab-channels">
                <div class="toggle-row"><label class="toggle-label">البريد الإلكتروني</label><label class="toggle-switch"><input type="checkbox" class="pref-field" data-pref="channel_email" checked><span class="toggle-track"></span></label></div>
                <div class="toggle-row"><label class="toggle-label">داخل النظام (In-app)</label><label class="toggle-switch"><input type="checkbox" class="pref-field" data-pref="channel_inapp" checked><span class="toggle-track"></span></label></div>
                <div class="toggle-row"><label class="toggle-label">واتساب</label><label class="toggle-switch"><input type="checkbox" class="pref-field" data-pref="channel_whatsapp"><span class="toggle-track"></span></label></div>
            </div>
            <div class="prefs-panel" id="ptab-types">
                <label class="notif-pref-option"><input type="checkbox" class="pref-field" data-pref="type_approval" checked> الاعتمادات</label>
                <label class="notif-pref-option"><input type="checkbox" class="pref-field" data-pref="type_contract_expiry" checked> قرب انتهاء عقد</label>
                <label class="notif-pref-option"><input type="checkbox" class="pref-field" data-pref="type_emp_sign" checked> توقيع عقد موظف</label>
                <label class="notif-pref-option"><input type="checkbox" class="pref-field" data-pref="type_create"> إنشاء عرض/عقد</label>
                <label class="notif-pref-option"><input type="checkbox" class="pref-field" data-pref="type_system" checked> إشعارات النظام</label>
            </div>
            <div class="prefs-panel" id="ptab-quiet">
                <div class="toggle-row"><label class="toggle-label">تفعيل ساعات الهدوء</label><label class="toggle-switch"><input type="checkbox" class="pref-field" data-pref="quiet_enabled"><span class="toggle-track"></span></label></div>
                <div class="quiet-times">
                    <div class="form-group"><label class="form-label">من</label><input type="time" class="form-input pref-field" data-pref="quiet_from" value="22:00"></div>
                    <div class="form-group"><label class="form-label">إلى</label><input type="time" class="form-input pref-field" data-pref="quiet_to" value="07:00"></div>
                </div>
            </div>
        </div>
        <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button class="btn btn--primary" id="savePrefs">حفظ التفضيلات</button></div>
    </div>
</div>

{{-- Drawer: Notification Detail (mobile) --}}
<div class="drawer" id="notifDrawer">
    <div class="drawer__overlay"></div>
    <div class="drawer__panel">
        <div class="drawer__header"><h2 id="drawerTitle">تفاصيل الإشعار</h2><button class="drawer__close" aria-label="إغلاق">&times;</button></div>
        <div class="drawer__body">
            <div class="drawer-meta"><span class="chip" id="drawerType"></span><span class="notif-time" id="drawerTime"></span>@<span id="drawerPriority"></span></div>
            <div class="drawer-body-text" id="drawerBody"></div>
            <div class="preview-info">
                <div class="info-row"><span class="info-label">المرجع:</span><span id="drawerRef"></span></div>
                <div class="info-row"><span class="info-label">الفرع:</span><span id="drawerBranch"></span></div>
                <div class="info-row"><span class="info-label">المُرسل:</span><span id="drawerCreator"></span></div>
            </div>
            <div class="drawer-actions">
                <a href="#" class="btn btn--primary btn--sm" data-action="go-to-ref">فتح المرجع</a>
                <button class="btn btn--outline btn--sm" data-action="toggle-read-drawer" id="drawerToggleRead">مقروء</button>
                <button class="btn btn--outline btn--sm" data-action="archive-drawer">أرشفة</button>
                <button class="btn btn--outline btn--sm btn--danger-outline" data-action="delete-drawer">حذف</button>
            </div>
            <div class="drawer-timeline">
                <h3>الأحداث المرتبطة</h3>
                <div class="timeline" id="drawerTimeline"></div>
            </div>
        </div>
    </div>
</div>

{{-- Toast --}}
<div class="toast" id="toast" role="status" aria-live="polite"><span class="toast__message" id="toastMessage"></span></div>

<script>
    window.__NOTIF_DATA = {
        notifications: @json($notifications),
        timeline: @json($timelineData)
    };
</script>
@endsection

