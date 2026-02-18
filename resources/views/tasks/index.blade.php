@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/tasks-index.css') }}">
@endpush



@section('title', 'إدارة المهام')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-header__right">
        <h1 class="page-title">
            <svg width="28" height="28" viewBox="0 0 20 20" fill="currentColor" style="color:var(--brand)">
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
            </svg>
            إدارة المهام
        </h1>
        <span class="page-subtitle" id="taskCount">0 مهمة</span>
    </div>
    <div class="page-header__left">
        <button class="btn btn--primary" id="btnAddTask">
            <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/></svg>
            مهمة جديدة
        </button>
    </div>
</div>

<!-- KPI Cards -->
<div class="tasks-kpi-row" id="kpiRow">
    <div class="tasks-kpi" data-filter="all">
        <div class="tasks-kpi__icon tasks-kpi__icon--brand">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        </div>
        <div class="tasks-kpi__data">
            <div class="tasks-kpi__value" id="kpiTotal">0</div>
            <div class="tasks-kpi__label">إجمالي المهام</div>
        </div>
    </div>
    <div class="tasks-kpi" data-filter="in_progress">
        <div class="tasks-kpi__icon tasks-kpi__icon--blue">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
        </div>
        <div class="tasks-kpi__data">
            <div class="tasks-kpi__value" id="kpiProgress">0</div>
            <div class="tasks-kpi__label">قيد التنفيذ</div>
        </div>
    </div>
    <div class="tasks-kpi" data-filter="done">
        <div class="tasks-kpi__icon tasks-kpi__icon--green">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        </div>
        <div class="tasks-kpi__data">
            <div class="tasks-kpi__value" id="kpiDone">0</div>
            <div class="tasks-kpi__label">مكتملة</div>
        </div>
    </div>
    <div class="tasks-kpi" data-filter="overdue">
        <div class="tasks-kpi__icon tasks-kpi__icon--red">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
        </div>
        <div class="tasks-kpi__data">
            <div class="tasks-kpi__value" id="kpiOverdue">0</div>
            <div class="tasks-kpi__label">متأخرة</div>
        </div>
    </div>
</div>

<!-- Toolbar -->
<div class="toolbar">
    <div class="toolbar__right">
        <div class="toolbar__search">
            <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
            <input type="text" id="searchInput" placeholder="بحث عن مهمة..." class="toolbar__search-input">
        </div>
    </div>
    <div class="toolbar__left">
        <select id="filterPriority" class="toolbar__select">
            <option value="">كل الأولويات</option>
            <option value="high">عالية</option>
            <option value="medium">متوسطة</option>
            <option value="low">منخفضة</option>
        </select>
        <select id="filterCategory" class="toolbar__select">
            <option value="">كل الفئات</option>
            <option value="تفتيش">تفتيش</option>
            <option value="تقارير">تقارير</option>
            <option value="صيانة">صيانة</option>
            <option value="تدريب">تدريب</option>
            <option value="إدارة">إدارة</option>
            <option value="سجلات">سجلات</option>
        </select>
    </div>
</div>

<!-- Tasks Grid -->
<div class="tasks-grid" id="tasksGrid"></div>

<!-- Empty State -->
<div class="empty-state" id="emptyState" style="display:none">
    <svg width="64" height="64" viewBox="0 0 20 20" fill="currentColor" style="color:#cbd5e1">
        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
    </svg>
    <h3>لا توجد مهام</h3>
    <p>لم يتم العثور على مهام تطابق البحث</p>
</div>

<!-- Add Task Modal -->
<div class="modal" id="taskModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header">
            <h2 class="modal__title" id="taskModalTitle">إضافة مهمة جديدة</h2>
            <button class="modal__close">&times;</button>
        </div>
        <div class="modal__body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">عنوان المهمة <span class="required">*</span></label>
                    <input type="text" class="form-input" id="taskTitleInput" placeholder="أدخل عنوان المهمة">
                </div>
            </div>
            <div class="form-row form-row--2col">
                <div class="form-group">
                    <label class="form-label">المسؤول</label>
                    <input type="text" class="form-input" id="taskAssigneeInput" placeholder="اسم الموظف">
                </div>
                <div class="form-group">
                    <label class="form-label">الأولوية</label>
                    <select class="form-input" id="taskPriorityInput">
                        <option value="medium">متوسطة</option>
                        <option value="high">عالية</option>
                        <option value="low">منخفضة</option>
                    </select>
                </div>
            </div>
            <div class="form-row form-row--2col">
                <div class="form-group">
                    <label class="form-label">الفئة</label>
                    <select class="form-input" id="taskCategoryInput">
                        <option value="تفتيش">تفتيش</option>
                        <option value="تقارير">تقارير</option>
                        <option value="صيانة">صيانة</option>
                        <option value="تدريب">تدريب</option>
                        <option value="إدارة">إدارة</option>
                        <option value="سجلات">سجلات</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">تاريخ الاستحقاق</label>
                    <input type="date" class="form-input" id="taskDueDateInput">
                </div>
            </div>
            <div class="form-row form-row--2col">
                <div class="form-group">
                    <label class="form-label">الموقع</label>
                    <input type="text" class="form-input" id="taskSiteInput" placeholder="موقع التنفيذ">
                </div>
                <div class="form-group">
                    <label class="form-label">الحالة</label>
                    <select class="form-input" id="taskStatusInput">
                        <option value="pending">لم تبدأ</option>
                        <option value="in_progress">قيد التنفيذ</option>
                        <option value="done">مكتملة</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--ghost modal__close-btn">إلغاء</button>
            <button class="btn btn--primary" id="btnSaveTask">حفظ المهمة</button>
        </div>
    </div>
</div>

<!-- Task Drawer -->
<div class="drawer" id="taskDrawer">
    <div class="drawer__overlay"></div>
    <div class="drawer__content">
        <div class="drawer__header">
            <h3 class="drawer__title">تفاصيل المهمة</h3>
            <button class="drawer__close">&times;</button>
        </div>
        <div class="drawer__body" id="taskDrawerBody"></div>
    </div>
</div>

@endsection

