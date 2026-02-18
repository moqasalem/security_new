@extends('layouts.app')

@section('title', 'تفاصيل الفرع')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/branches-show.css') }}">
@endpush

@section('content')
    {{-- Server flash messages --}}
    @if (session('success'))
        <input type="hidden" id="flashMessage" value="{{ session('success') }}">
    @endif
    @if ($errors->any())
        <input type="hidden" id="flashError" value="{{ $errors->first() }}">
    @endif

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">تفاصيل الفرع</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <a href="{{ route('branches') }}">الفروع</a>
                <span>/</span>
                <span>تفاصيل الفرع</span>
            </nav>
        </div>
        <div class="page-header__right">
            <a href="{{ route('branches') }}" class="btn btn--outline">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                رجوع للقائمة
            </a>
            <form action="{{ route('branches.toggle-status', $branch->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn--outline">
                    {{ $branch->is_active ? 'إيقاف' : 'تفعيل' }}
                </button>
            </form>
            <button class="btn btn--primary" id="editBranchBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                تعديل الفرع
            </button>
        </div>
    </div>

    <!-- Branch Profile Card -->
    <div class="profile-card">
        <div class="profile-card__header">
            <div class="profile-icon">
                <svg width="48" height="48" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="profile-info">
                <h2 class="profile-name">{{ $branch->name }}</h2>
                <div class="profile-meta">
                    <span class="meta-item">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        BR-{{ str_pad($branch->id, 3, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="meta-item">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $branch->city->name ?? '-' }}
                    </span>
                    <span class="badge badge--{{ $branch->is_active ? 'success' : 'secondary' }}">
                        {{ $branch->is_active ? 'نشط' : 'غير نشط' }}
                    </span>
                </div>
            </div>
            <button class="btn-copy" id="copyBtn" aria-label="نسخ بيانات الفرع">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                    <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                </svg>
            </button>
        </div>
        <div class="profile-card__body">
            <div class="profile-details">
                <div class="detail-item">
                    <span class="detail-label">العنوان</span>
                    <span class="detail-value">{{ $branch->address ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">المدير</span>
                    <span class="detail-value">{{ $branch->manager->name ?? '-' }}</span>
                </div>
            </div>
            <div class="profile-chips">
                <div class="chip">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                    <span>{{ $branch->users_count }} مستخدم</span>
                </div>
                <div class="chip">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>0 عرض هذا الشهر</span>
                </div>
                <div class="chip">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>0 عقد ساري</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--blue">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                    <path fill-rule="evenodd"
                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <h3 class="stat-card__title">العروض (30 يوم)</h3>
            <div class="stat-card__value">0</div>
            <div class="stat-card__footer">
                <span class="stat-card__note">لا توجد بيانات حالياً</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--green">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <h3 class="stat-card__title">العقود السارية</h3>
            <div class="stat-card__value">0</div>
            <div class="stat-card__footer">
                <span class="stat-card__note">لا توجد بيانات حالياً</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--purple">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                </svg>
            </div>
            <h3 class="stat-card__title">المستخدمون</h3>
            <div class="stat-card__value">{{ $branch->users_count }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__note">إجمالي مستخدمي الفرع</span>
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="tabs-container">
        <div class="tabs-header">
            <button class="tab-btn active" data-tab="overview" aria-selected="true">نظرة عامة</button>
            <button class="tab-btn" data-tab="users" aria-selected="false">المستخدمون</button>
            <button class="tab-btn" data-tab="settings" aria-selected="false">الإعدادات</button>
        </div>

        <div class="tabs-content">
            <!-- Overview Tab -->
            <div class="tab-pane active" id="overview-tab">
                <div class="tab-grid">
                    <!-- Branch Info -->
                    <div class="activity-section">
                        <h3 class="section-title">معلومات الفرع</h3>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <p><strong>اسم الفرع:</strong> {{ $branch->name }}</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <p><strong>المدينة:</strong> {{ $branch->city->name ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <p><strong>العنوان:</strong> {{ $branch->address ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <p><strong>المدير:</strong> {{ $branch->manager->name ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <p><strong>تاريخ الإنشاء:</strong>
                                        {{ $branch->created_at ? $branch->created_at->format('Y-m-d') : '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alerts -->
                    <div class="alerts-section">
                        <h3 class="section-title">تنبيهات الفرع</h3>
                        <div class="alert-list">
                            <div class="alert-box alert-box--info">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <strong>عدد المستخدمين</strong>
                                    <p>{{ $branch->users_count }} مستخدم مرتبط بهذا الفرع</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Tab -->
            <div class="tab-pane" id="users-tab">
                <div class="users-grid">
                    @foreach ($branch->users as $user)
                        <div class="user-card">
                            <div class="user-avatar">{{ mb_substr($user->name, 0, 1) }}</div>
                            <div class="user-info">
                                <h4>{{ $user->name }}</h4>
                                <p>{{ $user->email }}</p>
                                <span class="badge badge--{{ $user->is_active ? 'success' : 'secondary' }}">
                                    {{ $user->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </div>
                        </div>
                    @endforeach

                    @if ($branch->users->isEmpty())
                        <div class="empty-state">
                            <p>لا يوجد مستخدمون مرتبطون بهذا الفرع</p>
                        </div>
                    @endif
                </div>
                <div class="tab-footer">
                    <button class="btn btn--primary" id="manageUsersBtn">إدارة المستخدمين</button>
                </div>
            </div>

            <!-- Settings Tab -->
            <div class="tab-pane" id="settings-tab">
                <form class="settings-form" id="settingsForm">
                    <div class="form-section">
                        <h3 class="section-title">إعدادات PDF</h3>
                        <div class="form-group">
                            <label class="toggle-label">
                                <input type="checkbox" id="customHeader">
                                <span class="toggle-switch"></span>
                                <span>استخدام ترويسة PDF مخصصة للفرع</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="section-title">الشروط والأحكام</h3>
                        <div class="form-group">
                            <label class="form-label">شروط خاصة بالفرع</label>
                            <textarea class="form-input" rows="5" placeholder="أدخل الشروط الخاصة..."></textarea>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="section-title">الترقيم</h3>
                        <div class="form-group">
                            <label class="toggle-label">
                                <input type="checkbox" id="customNumbering">
                                <span class="toggle-switch"></span>
                                <span>استخدام ترقيم مخصص للفرع</span>
                            </label>
                        </div>
                        <div class="form-group" id="prefixGroup" style="display: none;">
                            <label class="form-label">بادئة الترقيم</label>
                            <input type="text" class="form-input" placeholder="مثال: RYD-"
                                value="BR-{{ str_pad($branch->id, 3, '0', STR_PAD_LEFT) }}-">
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn--primary">حفظ الإعدادات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Branch Modal -->
    <div class="modal" id="editModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">تعديل الفرع</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <form class="modal__body" id="editForm" method="POST"
                action="{{ route('branches.update', $branch->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">اسم الفرع <span class="required">*</span></label>
                    <input type="text" class="form-input" id="editName" name="name" value="{{ $branch->name }}"
                        required>
                </div>
                <div class="form-group">
                    <label class="form-label">المدينة <span class="required">*</span></label>
                    <select class="form-input" id="editCityId" name="city_id" required>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ $branch->city_id == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">العنوان</label>
                    <textarea class="form-input" id="editAddress" name="address" rows="3">{{ $branch->address }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">المدير</label>
                    <select class="form-input" id="editManagerId" name="manager_id">
                        <option value="">اختر المدير</option>
                        @foreach ($managers as $manager)
                            <option value="{{ $manager->id }}"
                                {{ $branch->manager_id == $manager->id ? 'selected' : '' }}>{{ $manager->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="editIsActive" name="is_active"
                            {{ $branch->is_active ? 'checked' : '' }}>
                        <span>فرع نشط</span>
                    </label>
                </div>
                <div class="modal__footer">
                    <button type="button" class="btn btn--outline modal__close">إلغاء</button>
                    <button type="submit" class="btn btn--primary">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Manage Users Drawer -->
    <div class="drawer" id="usersDrawer">
        <div class="drawer__overlay"></div>
        <div class="drawer__content">
            <div class="drawer__header">
                <h3 class="drawer__title">إدارة مستخدمي الفرع</h3>
                <button class="drawer__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <form action="{{ route('branches.assign-users', $branch->id) }}" method="POST" id="assignUsersForm">
                @csrf
                <div class="drawer__body">
                    <div class="drawer__search">
                        <svg class="search-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="text" placeholder="ابحث عن مستخدم..." class="drawer__input"
                            id="userSearchInput">
                    </div>
                    <div class="users-list">
                        @foreach ($allUsers as $user)
                            <label class="user-item">
                                <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                    {{ $user->branch_id == $branch->id ? 'checked' : '' }}>
                                <div class="user-info">
                                    <div class="user-avatar">{{ mb_substr($user->name, 0, 1) }}</div>
                                    <div class="user-details">
                                        <div class="user-name">{{ $user->name }}</div>
                                        <div class="user-role">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="drawer__footer">
                    <button type="submit" class="btn btn--primary btn--block">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast" role="status" aria-live="polite">
        <div class="toast__icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <div class="toast__message" id="toastMessage"></div>
    </div>
@endsection



