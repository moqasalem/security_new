@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/profile-index.css') }}">
@endpush

@section('content')
    <div class="profile-page">

        {{-- Header --}}
        <div class="page-header">
            <div class="page-header__right">
                <h1 class="page-title">الملف الشخصي</h1>
                <nav class="breadcrumb" aria-label="breadcrumb"><a
                        href="{{ route('dashboard') }}">الرئيسية</a><span>/</span><span>الملف الشخصي</span></nav>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="alert alert--success">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert--danger">
                <ul style="margin:0;padding:0 16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Main Layout --}}
        <div class="profile-layout">

            {{-- Profile Card (read-only sidebar) --}}
            <aside class="profile-card">
                <div class="avatar-wrap">
                    <div class="avatar">
                        <span class="avatar__initials">{{ mb_substr($user->name, 0, 2) }}</span>
                    </div>
                </div>
                <h2 class="profile-card__name">{{ $user->name }}</h2>
                <p class="profile-card__email">{{ $user->email }}</p>
                <div class="profile-card__chips">
                    <span class="chip chip--branch">{{ $user->branch->name ?? '—' }}</span>
                </div>
                <div class="profile-card__meta">
                    <div class="meta-row"><span class="meta-label">الجوال:</span><span
                            class="ltr-text">{{ $user->mobile ?? '—' }}</span></div>
                    <div class="meta-row"><span
                            class="meta-label">الحالة:</span><span>{{ $user->is_active ? 'نشط' : 'غير نشط' }}</span></div>
                    <div class="meta-row"><span class="meta-label">تاريخ
                            الإنشاء:</span><span>{{ $user->created_at?->format('Y-m-d') ?? '—' }}</span></div>
                </div>
            </aside>

            {{-- Edit Form --}}
            <div class="profile-main">
                <div class="section-card">
                    <h3 class="section-title">تعديل البيانات الشخصية</h3>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">الاسم الكامل <span class="req">*</span></label>
                                <input type="text" class="form-input" name="name"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">البريد الإلكتروني <span class="req">*</span></label>
                                <input type="email" class="form-input" name="email"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">رقم الجوال</label>
                                <input type="tel" class="form-input" name="mobile"
                                    value="{{ old('mobile', $user->mobile) }}" dir="ltr">
                            </div>
                            <div class="form-group">
                                <label class="form-label">الفرع</label>
                                <select class="form-select" disabled>
                                    @foreach ($branches as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ $id == $user->branch_id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">الحالة</label>
                                <input type="text" class="form-input" value="{{ $user->is_active ? 'نشط' : 'غير نشط' }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn--primary">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                </svg>
                                حفظ التغييرات
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Password Change Form --}}
                <div class="section-card" style="margin-top:20px;">
                    <h3 class="section-title">تغيير كلمة المرور</h3>
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-grid form-grid--narrow">
                            <div class="form-group">
                                <label class="form-label">كلمة المرور الحالية <span class="req">*</span></label>
                                <input type="password" class="form-input" name="current_password"
                                    autocomplete="current-password" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">كلمة المرور الجديدة <span class="req">*</span></label>
                                <input type="password" class="form-input" name="new_password" autocomplete="new-password"
                                    required minlength="8">
                            </div>
                            <div class="form-group">
                                <label class="form-label">تأكيد كلمة المرور <span class="req">*</span></label>
                                <input type="password" class="form-input" name="new_password_confirmation"
                                    autocomplete="new-password" required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn--primary">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                                </svg>
                                تغيير كلمة المرور
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
