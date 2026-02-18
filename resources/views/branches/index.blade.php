@extends('layouts.app')

@section('title', 'الفروع')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/branches-index.css') }}">
@endpush

@section('content')
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
            <!-- Add Branch Button (opens modal) -->
            <details class="modal-details" id="addBranchDetails">
                <summary class="btn btn--primary">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    إضافة فرع
                </summary>
                <div class="modal">
                    <div class="modal__overlay" onclick="this.closest('details').removeAttribute('open')"></div>
                    <div class="modal__content">
                        <div class="modal__header">
                            <h3 class="modal__title">إضافة فرع جديد</h3>
                            <button type="button" class="modal__close"
                                onclick="this.closest('details').removeAttribute('open')" aria-label="إغلاق">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <form class="modal__body" method="POST" action="{{ route('branches.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="addBranchName" class="form-label">اسم الفرع <span
                                        class="required">*</span></label>
                                <input type="text" id="addBranchName" name="name" class="form-input" required
                                    value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label for="addBranchCity" class="form-label">المدينة <span
                                        class="required">*</span></label>
                                <select id="addBranchCity" name="city_id" class="form-input" required>
                                    <option value="">اختر المدينة</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="addBranchAddress" class="form-label">العنوان</label>
                                <textarea id="addBranchAddress" name="address" class="form-input" rows="3">{{ old('address') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="addBranchManager" class="form-label">المدير</label>
                                <select id="addBranchManager" name="manager_id" class="form-input">
                                    <option value="">اختر المدير</option>
                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->id }}"
                                            {{ old('manager_id') == $manager->id ? 'selected' : '' }}>{{ $manager->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="addMainBranch" class="form-label">الفرع الرئيسي</label>
                                <select id="addMainBranch" name="main_branch_id" class="form-input">
                                    <option value="">بدون فرع رئيسي</option>
                                    @foreach ($mainBranches as $mb)
                                        <option value="{{ $mb->id }}"
                                            {{ old('main_branch_id') == $mb->id ? 'selected' : '' }}>{{ $mb->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_active" checked>
                                    <span>فرع نشط</span>
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
    <form class="toolbar" method="GET" action="{{ route('branches') }}">
        <div class="toolbar__search">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd" />
            </svg>
            <input type="text" class="toolbar__input" name="search" placeholder="ابحث باسم الفرع أو المدينة..."
                value="{{ request('search') }}">
            @if (request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            @if (request('city_id'))
                <input type="hidden" name="city_id" value="{{ request('city_id') }}">
            @endif
        </div>

        <div class="toolbar__filters">
            <!-- Status Filter -->
            <div class="filter-group">
                <span class="filter-label">الحالة:</span>
                <div class="filter-pills">
                    <a href="{{ route('branches', array_merge(request()->except('status'), ['status' => 'all'])) }}"
                        class="filter-pill {{ !request('status') || request('status') === 'all' ? 'filter-pill--active' : '' }}">الكل</a>
                    <a href="{{ route('branches', array_merge(request()->except('status'), ['status' => 'active'])) }}"
                        class="filter-pill {{ request('status') === 'active' ? 'filter-pill--active' : '' }}">نشط</a>
                    <a href="{{ route('branches', array_merge(request()->except('status'), ['status' => 'inactive'])) }}"
                        class="filter-pill {{ request('status') === 'inactive' ? 'filter-pill--active' : '' }}">غير
                        نشط</a>
                </div>
            </div>

            <!-- City Filter -->
            <div class="filter-group">
                <span class="filter-label">المدينة:</span>
                <select class="filter-select" onchange="window.location.href=this.value">
                    <option value="{{ route('branches', array_merge(request()->except('city_id'), [])) }}"
                        {{ !request('city_id') ? 'selected' : '' }}>الكل</option>
                    @foreach ($cities as $city)
                        <option
                            value="{{ route('branches', array_merge(request()->except('city_id'), ['city_id' => $city->id])) }}"
                            {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Main Branch Filter -->
            <div class="filter-group">
                <span class="filter-label">الفرع الرئيسي:</span>
                <select class="filter-select" onchange="window.location.href=this.value">
                    <option value="{{ route('branches', array_merge(request()->except('main_branch_id'), [])) }}"
                        {{ !request('main_branch_id') ? 'selected' : '' }}>الكل</option>
                    @foreach ($mainBranches as $mb)
                        <option
                            value="{{ route('branches', array_merge(request()->except('main_branch_id'), ['main_branch_id' => $mb->id])) }}"
                            {{ request('main_branch_id') == $mb->id ? 'selected' : '' }}>{{ $mb->name }}</option>
                    @endforeach
                </select>
            </div>

            @if (request('search') || request('status') || request('city_id') || request('main_branch_id'))
                <a href="{{ route('branches') }}" class="btn btn--text">
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
    @if (request('search') || request('status') || request('city_id') || request('main_branch_id'))
        <div class="results-info">
            <span>عدد النتائج: <strong>{{ $branches->count() }}</strong></span>
        </div>
    @endif

    <!-- Branches Table -->
    <div class="table-card">
        <div class="table-wrapper">
            <table class="branches-table" id="branchesTable">
                <thead>
                    <tr>
                        <th>الكود</th>
                        <th>اسم الفرع</th>
                        <th>الفرع الرئيسي</th>
                        <th>المدينة</th>
                        <th>المدير</th>
                        <th>المستخدمون</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="branchesTableBody">
                    @forelse ($branches as $branch)
                        <tr>
                            <td>BR-{{ str_pad($branch->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <a href="{{ route('branches.show', $branch->id) }}"
                                    class="branch-name">{{ $branch->name }}</a>
                            </td>
                            <td>{{ $branch->main_branch->name ?? '-' }}</td>
                            <td>{{ $branch->city->name ?? '-' }}</td>
                            <td>{{ $branch->manager->name ?? '-' }}</td>
                            <td>{{ $branch->users_count }}</td>
                            <td>
                                <span
                                    class="status-badge status-badge--{{ $branch->is_active ? 'success' : 'secondary' }}">
                                    {{ $branch->is_active ? 'نشط' : 'غير نشط' }}
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
                                        <a href="{{ route('branches.show', $branch->id) }}" class="dropdown-item">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            عرض التفاصيل
                                        </a>

                                        <!-- Edit Branch - opens modal outside table -->
                                        <button type="button" class="dropdown-item"
                                            onclick="document.getElementById('editModal{{ $branch->id }}').setAttribute('open','')">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            تعديل
                                        </button>

                                        <a href="{{ route('branches.show', $branch->id) }}" class="dropdown-item">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                            </svg>
                                            إدارة المستخدمين
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <form action="{{ route('branches.toggle-status', $branch->id) }}" method="POST">
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
                                </details>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-state">
                                <div class="empty-state__content">
                                    <svg width="48" height="48" viewBox="0 0 20 20" fill="#94a3b8">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p>لا توجد فروع مطابقة للبحث</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Edit Modals (rendered outside the table for proper layering) -->
    @foreach ($branches as $branch)
        <details class="modal-details edit-branch-details" id="editModal{{ $branch->id }}">
            <summary style="display:none"></summary>
            <div class="modal">
                <div class="modal__overlay" onclick="this.closest('details').removeAttribute('open')"></div>
                <div class="modal__content">
                    <div class="modal__header">
                        <h3 class="modal__title">تعديل الفرع</h3>
                        <button type="button" class="modal__close"
                            onclick="this.closest('details').removeAttribute('open')" aria-label="إغلاق">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <form class="modal__body" method="POST" action="{{ route('branches.update', $branch->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-label">اسم الفرع <span class="required">*</span></label>
                            <input type="text" name="name" class="form-input" required
                                value="{{ $branch->name }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">المدينة <span class="required">*</span></label>
                            <select name="city_id" class="form-input" required>
                                <option value="">اختر المدينة</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ $branch->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">العنوان</label>
                            <textarea name="address" class="form-input" rows="3">{{ $branch->address }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">المدير</label>
                            <select name="manager_id" class="form-input">
                                <option value="">اختر المدير</option>
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}"
                                        {{ $branch->manager_id == $manager->id ? 'selected' : '' }}>{{ $manager->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">الفرع الرئيسي</label>
                            <select name="main_branch_id" class="form-input">
                                <option value="">بدون فرع رئيسي</option>
                                @foreach ($mainBranches as $mb)
                                    @if ($mb->id !== $branch->id)
                                        <option value="{{ $mb->id }}"
                                            {{ $branch->main_branch_id == $mb->id ? 'selected' : '' }}>{{ $mb->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="is_active" {{ $branch->is_active ? 'checked' : '' }}>
                                <span>فرع نشط</span>
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
