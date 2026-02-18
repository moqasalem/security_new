@extends('layouts.app')

@section('title', 'الفروع')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/branches-index.css') }}">
@endpush

@section('content')
    {{-- Server flash messages (read by JS on page load) --}}
    @if (session('success'))
        <input type="hidden" id="flashMessage" value="{{ session('success') }}">
    @endif
    @if ($errors->any())
        <input type="hidden" id="flashError" value="{{ $errors->first() }}">
    @endif

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">الفروع</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <span>الفروع</span>
            </nav>
        </div>
        <div class="page-header__right">
            <div class="dropdown" id="exportDropdown">
                <button class="btn btn--outline dropdown-toggle" aria-expanded="false">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    تصدير
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">تصدير PDF</a>
                    <a href="#" class="dropdown-item">تصدير Excel</a>
                </div>
            </div>
            <button class="btn btn--primary" id="addBranchBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                إضافة فرع
            </button>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar">
        <div class="toolbar__search">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd" />
            </svg>
            <input type="text" class="toolbar__input" id="searchInput" placeholder="ابحث باسم الفرع أو المدينة...">
        </div>

        <div class="toolbar__filters">
            <div class="dropdown" id="statusFilter">
                <button class="dropdown-toggle filter-btn" aria-expanded="false">
                    <span class="filter-label">الحالة:</span>
                    <span class="filter-value">الكل</span>
                    <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item active" data-value="all">الكل</a>
                    <a href="#" class="dropdown-item" data-value="active">نشط</a>
                    <a href="#" class="dropdown-item" data-value="inactive">غير نشط</a>
                </div>
            </div>

            <div class="dropdown" id="cityFilter">
                <button class="dropdown-toggle filter-btn" aria-expanded="false">
                    <span class="filter-label">المدينة:</span>
                    <span class="filter-value">الكل</span>
                    <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item active" data-value="all">الكل</a>
                    @foreach ($cities as $city)
                        <a href="#" class="dropdown-item" data-value="{{ $city->name }}">{{ $city->name }}</a>
                    @endforeach
                </div>
            </div>

            <button class="btn btn--text" id="clearFilters">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
                مسح الفلاتر
            </button>
        </div>
    </div>

    <!-- Branches Table -->
    <div class="table-card">
        <div class="table-wrapper">
            <table class="branches-table" id="branchesTable">
                <thead>
                    <tr>
                        <th>الكود</th>
                        <th>اسم الفرع</th>
                        <th>المدينة</th>
                        <th>المدير</th>
                        <th>المستخدمون</th>
                        <th>العروض</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="branchesTableBody">


                    @foreach ($branches as $branch)
                        <tr data-branch-id="{{ $branch->id }}"
                            data-status="{{ $branch->is_active ? 'active' : 'inactive' }}"
                            data-city="{{ $branch->city->name ?? '' }}">
                            <td>BR-{{ str_pad($branch->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <a href="{{ route('branches.show', $branch->id) }}"
                                    class="branch-name">{{ $branch->name }}</a>
                            </td>
                            <td>{{ $branch->city->name ?? '-' }}</td>
                            <td>{{ $branch->manager->name ?? '-' }}</td>
                            <td>{{ $branch->users_count }}</td>
                            <td>0</td>
                            <td>
                                <span class="badge badge--{{ $branch->is_active ? 'success' : 'secondary' }}">
                                    {{ $branch->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown actions-dropdown">
                                    <button class="btn-icon" aria-label="الإجراءات" aria-expanded="false">
                                        <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu--left">
                                        <a href="{{ route('branches.show', $branch->id) }}" class="dropdown-item">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            عرض التفاصيل
                                        </a>
                                        <a href="#" class="dropdown-item edit-branch"
                                            data-branch="{{ json_encode([
                                                'id' => $branch->id,
                                                'name' => $branch->name,
                                                'city_id' => $branch->city_id,
                                                'address' => $branch->address,
                                                'manager_id' => $branch->manager_id,
                                                'is_active' => $branch->is_active,
                                            ]) }}">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            تعديل
                                        </a>
                                        <a href="#" class="dropdown-item manage-users"
                                            data-branch-id="{{ $branch->id }}" data-branch-name="{{ $branch->name }}">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                            </svg>
                                            إدارة المستخدمين
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('branches.toggle-status', $branch->id) }}" method="POST"
                                            class="toggle-status-form">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="dropdown-item toggle-status">
                                                <svg width="16" height="16" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $branch->is_active ? 'إيقاف' : 'تفعيل' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <button class="pagination__btn" id="prevPage" disabled>
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
                السابق
            </button>
            <div class="pagination__pages" id="paginationPages">
                <button class="pagination__page active">1</button>
                <button class="pagination__page">2</button>
            </div>
            <button class="pagination__btn" id="nextPage">
                التالي
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Add/Edit Branch Modal -->
    <div class="modal" id="branchModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title" id="modalTitle">إضافة فرع جديد</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <form class="modal__body" id="branchForm" method="POST" action="{{ route('branches.store') }}">
                @csrf
                <input type="hidden" id="branchMethodField" name="_method" value="POST">
                <input type="hidden" id="branchId" name="id">

                <div class="form-group">
                    <label for="branchName" class="form-label">اسم الفرع <span class="required">*</span></label>
                    <input type="text" id="branchName" name="name" class="form-input" required>
                    <span class="form-error" id="branchNameError"></span>
                </div>

                <div class="form-group">
                    <label for="branchCity" class="form-label">المدينة <span class="required">*</span></label>
                    <select id="branchCity" name="city_id" class="form-input" required>
                        <option value="">اختر المدينة</option>


                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error" id="branchCityError"></span>
                </div>

                <div class="form-group">
                    <label for="branchAddress" class="form-label">العنوان</label>
                    <textarea id="branchAddress" name="address" class="form-input" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="branchManager" class="form-label">المدير</label>
                    <select id="branchManager" name="manager_id" class="form-input">
                        <option value="">اختر المدير</option>
                        @foreach ($managers as $manager)
                            <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="branchStatus" name="is_active" checked>
                        <span>فرع نشط</span>
                    </label>
                </div>

                <div class="modal__footer">
                    <button type="button" class="btn btn--outline" id="cancelBtn">إلغاء</button>
                    <button type="submit" class="btn btn--primary" id="saveBtn">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Manage Users Drawer -->
    <div class="drawer" id="usersDrawer">
        <div class="drawer__overlay"></div>
        <div class="drawer__content">
            <div class="drawer__header">
                <h3 class="drawer__title">مستخدمو الفرع: <span id="drawerBranchName"></span></h3>
                <button class="drawer__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="drawer__body">
                <div class="drawer__search">
                    <svg class="search-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" placeholder="ابحث عن مستخدم..." class="drawer__input" id="userSearchInput">
                </div>

                <div class="users-list" id="usersList">


                    @foreach ($managers as $user)
                        <label class="user-item">
                            <input type="checkbox">
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
                <button class="btn btn--primary btn--block" id="saveUsersBtn">حفظ التغييرات</button>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal modal--small" id="confirmModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title" id="confirmTitle">تأكيد الإجراء</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <p id="confirmMessage"></p>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline" id="confirmCancelBtn">إلغاء</button>
                <button class="btn btn--primary" id="confirmActionBtn">تأكيد</button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
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



