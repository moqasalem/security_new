@extends('layouts.app')

@section('title', 'المستخدمون')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/users-index.css') }}">
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">المستخدمون</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <span>المستخدمون</span>
            </nav>
        </div>
        <div class="page-header__right">
            <!-- Add User Button (opens modal) -->
            <details class="modal-details" id="addUserDetails">
                <summary class="btn btn--primary">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    إضافة مستخدم
                </summary>
                <div class="modal">
                    <div class="modal__overlay" onclick="this.closest('details').removeAttribute('open')"></div>
                    <div class="modal__content">
                        <div class="modal__header">
                            <h3 class="modal__title">إضافة مستخدم جديد</h3>
                            <button type="button" class="modal__close"
                                onclick="this.closest('details').removeAttribute('open')" aria-label="إغلاق">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <form class="modal__body" method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="addUserName" class="form-label">الاسم <span class="required">*</span></label>
                                <input type="text" id="addUserName" name="name" class="form-input" required
                                    value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label for="addUserEmail" class="form-label">البريد الإلكتروني <span
                                        class="required">*</span></label>
                                <input type="email" id="addUserEmail" name="email" class="form-input" required
                                    value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <label for="addUserPassword" class="form-label">كلمة المرور <span
                                        class="required">*</span></label>
                                <input type="password" id="addUserPassword" name="password" class="form-input" required
                                    minlength="6">
                            </div>

                            <div class="form-group">
                                <label for="addUserMobile" class="form-label">الجوال</label>
                                <input type="tel" id="addUserMobile" name="mobile" class="form-input" dir="ltr"
                                    value="{{ old('mobile') }}">
                            </div>

                            <div class="form-group">
                                <label for="addUserBranch" class="form-label">الفرع</label>
                                <select id="addUserBranch" name="branch_id" class="form-input">
                                    <option value="">بدون فرع</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_active" checked>
                                    <span>مستخدم نشط</span>
                                </label>
                            </div>

                            <div class="modal__footer">
                                <button type="button" class="btn btn--outline"
                                    onclick="this.closest('details').removeAttribute('open')">إلغاء</button>
                                <button type="submit" class="btn btn--primary">حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </details>
        </div>
    </div>

    <!-- Toolbar: Search & Filters -->
    <form class="toolbar" method="GET" action="{{ route('users') }}">
        <div class="toolbar__search">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd" />
            </svg>
            <input type="text" class="toolbar__input" name="search" placeholder="ابحث بالاسم أو البريد أو الجوال..."
                value="{{ request('search') }}">
            @if (request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            @if (request('branch_id'))
                <input type="hidden" name="branch_id" value="{{ request('branch_id') }}">
            @endif
        </div>

        <div class="toolbar__filters">
            <!-- Status Filter -->
            <div class="filter-group">
                <span class="filter-label">الحالة:</span>
                <div class="filter-pills">
                    <a href="{{ route('users', array_merge(request()->except('status'), ['status' => 'all'])) }}"
                        class="filter-pill {{ !request('status') || request('status') === 'all' ? 'filter-pill--active' : '' }}">الكل</a>
                    <a href="{{ route('users', array_merge(request()->except('status'), ['status' => 'active'])) }}"
                        class="filter-pill {{ request('status') === 'active' ? 'filter-pill--active' : '' }}">نشط</a>
                    <a href="{{ route('users', array_merge(request()->except('status'), ['status' => 'inactive'])) }}"
                        class="filter-pill {{ request('status') === 'inactive' ? 'filter-pill--active' : '' }}">موقوف</a>
                </div>
            </div>

            <!-- Branch Filter -->
            <div class="filter-group">
                <span class="filter-label">الفرع:</span>
                <select class="filter-select" onchange="window.location.href=this.value">
                    <option value="{{ route('users', array_merge(request()->except('branch_id'), [])) }}"
                        {{ !request('branch_id') ? 'selected' : '' }}>الكل</option>
                    @foreach ($branches as $branch)
                        <option
                            value="{{ route('users', array_merge(request()->except('branch_id'), ['branch_id' => $branch->id])) }}"
                            {{ request('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            @if (request('search') || request('status') || request('branch_id'))
                <a href="{{ route('users') }}" class="btn btn--text">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    مسح الفلاتر
                </a>
            @endif
        </div>
    </form>

    <!-- Results Count -->
    @if (request('search') || request('status') || request('branch_id'))
        <div class="results-info">
            <span>عدد النتائج: <strong>{{ count($users) }}</strong></span>
        </div>
    @endif

    <!-- Users Table -->
    <div class="table-card">
        <div class="table-wrapper">
            <table class="data-table" id="usersTable">
                <thead>
                    <tr>
                        <th>المستخدم</th>
                        <th>البريد</th>
                        <th>الجوال</th>
                        <th>الفرع</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar">{{ mb_substr($user->name, 0, 1) }}</div>
                                    <span>{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile ?? '-' }}</td>
                            <td>{{ $user->branch->name ?? 'غير محدد' }}</td>
                            <td>
                                <span class="status-badge status-badge--{{ $user->is_active ? 'success' : 'secondary' }}">
                                    {{ $user->is_active ? 'نشط' : 'موقوف' }}
                                </span>
                            </td>
                            <td class="actions-cell">
                                <!-- Actions Dropdown -->
                                <details class="dropdown actions-dropdown">
                                    <summary class="btn-icon" aria-label="الإجراءات">
                                        <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                        </svg>
                                    </summary>
                                    <div class="dropdown-menu dropdown-menu--left">
                                        <!-- Edit -->
                                        <button type="button" class="dropdown-item"
                                            onclick="document.getElementById('editUserModal{{ $user->id }}').setAttribute('open','')">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            تعديل
                                        </button>

                                        <!-- Toggle Status -->
                                        <form action="{{ route('users.toggle-status', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="dropdown-item">
                                                <svg width="16" height="16" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $user->is_active ? 'إيقاف' : 'تفعيل' }}
                                            </button>
                                        </form>

                                        <div class="dropdown-divider"></div>

                                        <!-- Delete -->
                                        <button type="button" class="dropdown-item dropdown-item--danger"
                                            onclick="document.getElementById('deleteUserModal{{ $user->id }}').setAttribute('open','')">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            حذف
                                        </button>
                                    </div>
                                </details>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                <div class="empty-state__content">
                                    <svg width="48" height="48" viewBox="0 0 20 20" fill="#94a3b8">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                    <p>لا يوجد مستخدمون</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modals (rendered outside the table for proper layering) -->
    @foreach ($users as $user)
        <details class="modal-details" id="editUserModal{{ $user->id }}">
            <summary style="display:none"></summary>
            <div class="modal">
                <div class="modal__overlay" onclick="this.closest('details').removeAttribute('open')"></div>
                <div class="modal__content">
                    <div class="modal__header">
                        <h3 class="modal__title">تعديل المستخدم</h3>
                        <button type="button" class="modal__close"
                            onclick="this.closest('details').removeAttribute('open')" aria-label="إغلاق">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <form class="modal__body" method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-label">الاسم <span class="required">*</span></label>
                            <input type="text" name="name" class="form-input" required
                                value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">البريد الإلكتروني <span class="required">*</span></label>
                            <input type="email" name="email" class="form-input" required
                                value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">كلمة المرور <small>(اتركه فارغاً للإبقاء على الحالية)</small></label>
                            <input type="password" name="password" class="form-input" minlength="6">
                        </div>

                        <div class="form-group">
                            <label class="form-label">الجوال</label>
                            <input type="tel" name="mobile" class="form-input" dir="ltr"
                                value="{{ $user->mobile }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">الفرع</label>
                            <select name="branch_id" class="form-input">
                                <option value="">بدون فرع</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ $user->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="is_active" {{ $user->is_active ? 'checked' : '' }}>
                                <span>مستخدم نشط</span>
                            </label>
                        </div>

                        <div class="modal__footer">
                            <button type="button" class="btn btn--outline"
                                onclick="this.closest('details').removeAttribute('open')">إلغاء</button>
                            <button type="submit" class="btn btn--primary">تحديث</button>
                        </div>
                    </form>
                </div>
            </div>
        </details>
    @endforeach

    <!-- Delete Confirmation Modals -->
    @foreach ($users as $user)
        <details class="modal-details" id="deleteUserModal{{ $user->id }}">
            <summary style="display:none"></summary>
            <div class="modal">
                <div class="modal__overlay" onclick="this.closest('details').removeAttribute('open')"></div>
                <div class="modal__content modal__content--sm">
                    <div class="modal__header">
                        <h3 class="modal__title">تأكيد الحذف</h3>
                        <button type="button" class="modal__close"
                            onclick="this.closest('details').removeAttribute('open')" aria-label="إغلاق">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="modal__body">
                        <p class="delete-warning">هل أنت متأكد من حذف المستخدم <strong>{{ $user->name }}</strong>؟ لا
                            يمكن التراجع عن هذا الإجراء.</p>
                    </div>
                    <div class="modal__footer">
                        <button type="button" class="btn btn--outline"
                            onclick="this.closest('details').removeAttribute('open')">إلغاء</button>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn--danger">حذف</button>
                        </form>
                    </div>
                </div>
            </div>
        </details>
    @endforeach
@endsection

@push('scripts')
    <script>
        // Close action dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            document.querySelectorAll('details.dropdown[open]').forEach(function(d) {
                if (!d.contains(e.target)) d.removeAttribute('open');
            });
        });
    </script>
@endpush
