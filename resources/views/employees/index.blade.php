@extends('layouts.app')

@section('title', 'الموظفين')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/employees-index.css') }}">
@endpush

@section('content')
    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert--success">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert--danger">
            <ul style="margin:0; padding-right: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">الموظفين</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <span>الموظفين</span>
            </nav>
        </div>
        <div class="page-header__right">
            <!-- Add Employee Button (opens modal) -->
            <details class="modal-details" id="addEmployeeDetails">
                <summary class="btn btn--primary">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    إضافة موظف
                </summary>
                <div class="modal">
                    <div class="modal__overlay" onclick="this.closest('details').removeAttribute('open')"></div>
                    <div class="modal__content">
                        <div class="modal__header">
                            <h3 class="modal__title">إضافة موظف جديد</h3>
                            <button type="button" class="modal__close"
                                onclick="this.closest('details').removeAttribute('open')" aria-label="إغلاق">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <form class="modal__body" method="POST" action="{{ route('employees.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="addEmpName" class="form-label">اسم الموظف <span
                                        class="required">*</span></label>
                                <input type="text" id="addEmpName" name="name" class="form-input" required
                                    value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label for="addEmpEmail" class="form-label">البريد الإلكتروني <span
                                        class="required">*</span></label>
                                <input type="email" id="addEmpEmail" name="email" class="form-input" required
                                    value="{{ old('email') }}">
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="addEmpMobile" class="form-label">رقم الجوال</label>
                                    <input type="text" id="addEmpMobile" name="mobile" class="form-input"
                                        value="{{ old('mobile') }}">
                                </div>

                                <div class="form-group">
                                    <label for="addEmpIdentity" class="form-label">رقم الهوية <span
                                            class="required">*</span></label>
                                    <input type="text" id="addEmpIdentity" name="identity_number" class="form-input"
                                        required value="{{ old('identity_number') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addEmpPassword" class="form-label">كلمة المرور <span
                                        class="required">*</span></label>
                                <input type="password" id="addEmpPassword" name="password" class="form-input" required>
                            </div>

                            <div class="form-group">
                                <label for="addEmpBranch" class="form-label">الفرع <span class="required">*</span></label>
                                <select id="addEmpBranch" name="branch_id" class="form-input" required>
                                    <option value="">اختر الفرع</option>
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
                                    <span>موظف نشط</span>
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
    <form class="toolbar" method="GET" action="{{ route('employees') }}">
        <div class="toolbar__search">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd" />
            </svg>
            <input type="text" class="toolbar__input" name="search"
                placeholder="ابحث بالاسم أو البريد أو رقم الهوية..." value="{{ request('search') }}">
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
                    <a href="{{ route('employees', array_merge(request()->except('status'), ['status' => 'all'])) }}"
                        class="filter-pill {{ !request('status') || request('status') === 'all' ? 'filter-pill--active' : '' }}">الكل</a>
                    <a href="{{ route('employees', array_merge(request()->except('status'), ['status' => 'active'])) }}"
                        class="filter-pill {{ request('status') === 'active' ? 'filter-pill--active' : '' }}">نشط</a>
                    <a href="{{ route('employees', array_merge(request()->except('status'), ['status' => 'inactive'])) }}"
                        class="filter-pill {{ request('status') === 'inactive' ? 'filter-pill--active' : '' }}">غير
                        نشط</a>
                </div>
            </div>

            <!-- Branch Filter -->
            <div class="filter-group">
                <span class="filter-label">الفرع:</span>
                <select class="filter-select" onchange="window.location.href=this.value">
                    <option value="{{ route('employees', array_merge(request()->except('branch_id'), [])) }}"
                        {{ !request('branch_id') ? 'selected' : '' }}>الكل</option>
                    @foreach ($branches as $branch)
                        <option
                            value="{{ route('employees', array_merge(request()->except('branch_id'), ['branch_id' => $branch->id])) }}"
                            {{ request('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            @if (request('search') || request('status') || request('branch_id'))
                <a href="{{ route('employees') }}" class="btn btn--text">
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
            <span>عدد النتائج: <strong>{{ $employees->count() }}</strong></span>
        </div>
    @endif

    <!-- Employees Table -->
    <div class="table-card">
        <div class="table-wrapper">
            <table class="employees-table" id="employeesTable">
                <thead>
                    <tr>
                        <th>الكود</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الجوال</th>
                        <th>رقم الهوية</th>
                        <th>الفرع</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="employeesTableBody">
                    @forelse ($employees as $employee)
                        <tr>
                            <td>EMP-{{ str_pad($employee->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <span class="employee-name">{{ $employee->name }}</span>
                            </td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->mobile ?? '-' }}</td>
                            <td>{{ $employee->identity_number }}</td>
                            <td>{{ $employee->branch->name ?? '-' }}</td>
                            <td>
                                <span
                                    class="status-badge status-badge--{{ $employee->is_active ? 'success' : 'secondary' }}">
                                    {{ $employee->is_active ? 'نشط' : 'غير نشط' }}
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
                                        <!-- Edit Employee -->
                                        <button type="button" class="dropdown-item"
                                            onclick="document.getElementById('editModal{{ $employee->id }}').setAttribute('open','')">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            تعديل
                                        </button>

                                        <div class="dropdown-divider"></div>

                                        <!-- Toggle Status -->
                                        <form action="{{ route('employees.toggle-status', $employee->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="dropdown-item toggle-status">
                                                <svg width="16" height="16" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $employee->is_active ? 'إيقاف' : 'تفعيل' }}
                                            </button>
                                        </form>

                                        <div class="dropdown-divider"></div>

                                        <!-- Delete -->
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                            onsubmit="return confirm('هل أنت متأكد من حذف هذا الموظف؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item dropdown-item--danger">
                                                <svg width="16" height="16" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                حذف
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
                                        <path
                                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                    </svg>
                                    <p>لا يوجد موظفين</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modals (rendered outside the table for proper layering) -->
    @foreach ($employees as $employee)
        <details class="modal-details edit-employee-details" id="editModal{{ $employee->id }}">
            <summary style="display:none"></summary>
            <div class="modal">
                <div class="modal__overlay" onclick="this.closest('details').removeAttribute('open')"></div>
                <div class="modal__content">
                    <div class="modal__header">
                        <h3 class="modal__title">تعديل بيانات الموظف</h3>
                        <button type="button" class="modal__close"
                            onclick="this.closest('details').removeAttribute('open')" aria-label="إغلاق">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <form class="modal__body" method="POST" action="{{ route('employees.update', $employee->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-label">اسم الموظف <span class="required">*</span></label>
                            <input type="text" name="name" class="form-input" required
                                value="{{ $employee->name }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">البريد الإلكتروني <span class="required">*</span></label>
                            <input type="email" name="email" class="form-input" required
                                value="{{ $employee->email }}">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">رقم الجوال</label>
                                <input type="text" name="mobile" class="form-input"
                                    value="{{ $employee->mobile }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">رقم الهوية <span class="required">*</span></label>
                                <input type="text" name="identity_number" class="form-input" required
                                    value="{{ $employee->identity_number }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">كلمة المرور <small>(اتركها فارغة إذا لا تريد التغيير)</small></label>
                            <input type="password" name="password" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">الفرع <span class="required">*</span></label>
                            <select name="branch_id" class="form-input" required>
                                <option value="">اختر الفرع</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ $employee->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="is_active" {{ $employee->is_active ? 'checked' : '' }}>
                                <span>موظف نشط</span>
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
