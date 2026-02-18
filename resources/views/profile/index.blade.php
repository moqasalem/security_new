@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/profile-index.css') }}">
@endpush



@section('content')
    @php
        // $user and $branches are passed from ProfileController

        $sessions = [
            [
                'id' => 1,
                'device' => 'Windows PC',
                'browser' => 'Chrome 120',
                'ip' => '192.168.1.45',
                'location' => 'الرياض',
                'last_active' => 'الآن',
                'status' => 'active',
            ],
            [
                'id' => 2,
                'device' => 'iPhone 15',
                'browser' => 'Safari 17',
                'ip' => '10.0.0.12',
                'location' => 'الرياض',
                'last_active' => 'منذ 30 دقيقة',
                'status' => 'active',
            ],
        ];

        $activity = [['action' => 'سجّل دخول', 'ref' => '—', 'time' => 'الآن', 'icon' => 'login']];
    @endphp

    <div class="profile-page">

        {{-- Header --}}
        <div class="page-header">
            <div class="page-header__right">
                <h1 class="page-title">الملف الشخصي</h1>
                <nav class="breadcrumb" aria-label="breadcrumb"><a
                        href="{{ route('dashboard') }}">الرئيسية</a><span>/</span><span>الملف الشخصي</span></nav>
            </div>
            <div class="page-header__left">
                <button class="btn btn--primary" id="btnSaveProfile" aria-label="حفظ التغييرات"><svg width="16"
                        height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                    </svg> حفظ التغييرات</button>
                <button class="btn btn--outline" id="btnResetForm" aria-label="إعادة ضبط">↩️ إعادة ضبط</button>
                <button class="btn btn--outline" id="btnDownloadMyData" aria-label="تنزيل بياناتي"><svg width="16"
                        height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg> تنزيل بياناتي</button>
                <span class="dirty-badge" id="dirtyBadge" style="display:none;">تغييرات غير محفوظة</span>
            </div>
        </div>

        {{-- Main Layout --}}
        <div class="profile-layout">

            {{-- Profile Card --}}
            <aside class="profile-card">
                <div class="avatar-wrap">
                    <div class="avatar" id="avatarPreview">
                        <span class="avatar__initials" id="avatarInitials">{{ mb_substr($user->name, 0, 2) }}</span>
                        <img src="" alt="" class="avatar__img" id="avatarImg" style="display:none;">
                    </div>
                    <div class="avatar-actions">
                        <button class="btn btn--sm btn--primary" id="btnUploadAvatar" aria-label="رفع صورة">📷 رفع
                            صورة</button>
                        <button class="btn btn--sm btn--outline" id="btnRemoveAvatar" aria-label="إزالة">🗑️ إزالة</button>
                        <input type="file" id="avatarInput" accept="image/*" style="display:none;">
                    </div>
                </div>
                <h2 class="profile-card__name">{{ $user->name }}</h2>
                <p class="profile-card__email">{{ $user->email }}</p>
                <div class="profile-card__chips">
                    <span class="chip chip--branch">{{ $user->branch_name }}</span>
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

            {{-- Tabs Content --}}
            <div class="profile-main">
                <div class="tabs" role="tablist">
                    <button class="tab active" data-tab="personal" role="tab" aria-selected="true">البيانات
                        الشخصية</button>
                    <button class="tab" data-tab="preferences" role="tab" aria-selected="false">تفضيلات
                        الحساب</button>
                    <button class="tab" data-tab="security" role="tab" aria-selected="false">الأمان</button>
                    <button class="tab" data-tab="sessions" role="tab" aria-selected="false">الجلسات
                        والأجهزة</button>
                    <button class="tab" data-tab="activity" role="tab" aria-selected="false">النشاط</button>
                </div>

                {{-- Tab A: Personal --}}
                <div class="tab-panel active" id="tab-personal" role="tabpanel">
                    <div class="section-card">
                        <h3 class="section-title">البيانات الشخصية</h3>
                        <div class="form-grid">
                            <div class="form-group"><label class="form-label">الاسم الكامل <span
                                        class="req">*</span></label><input type="text"
                                    class="form-input profile-field" data-field="name" value="{{ $user->name }}"
                                    required><span class="field-error" id="err-name"></span></div>
                            <div class="form-group"><label class="form-label">اسم المستخدم</label><input type="text"
                                    class="form-input profile-field" data-field="username" value="{{ $user->email }}"
                                    readonly></div>
                            <div class="form-group"><label class="form-label">البريد الإلكتروني <span
                                        class="req">*</span></label><input type="email"
                                    class="form-input profile-field" data-field="email" value="{{ $user->email }}"
                                    required><span class="field-error" id="err-email"></span></div>
                            <div class="form-group"><label class="form-label">رقم الجوال</label><input type="tel"
                                    class="form-input profile-field" data-field="mobile" value="{{ $user->mobile }}"
                                    dir="ltr"></div>
                            <div class="form-group"><label class="form-label">الفرع</label><select
                                    class="form-select profile-field" data-field="branch" disabled>
                                    @foreach ($branches as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ $id == $user->branch_id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group"><label class="form-label">الحالة</label><input type="text"
                                    class="form-input profile-field" data-field="status"
                                    value="{{ $user->is_active ? 'نشط' : 'غير نشط' }}" readonly>
                            </div>
                        </div>
                        <div class="form-group form-group--full"><label class="form-label">ملاحظات</label>
                            <textarea class="form-textarea profile-field" data-field="notes" rows="3" placeholder="ملاحظات إضافية..."></textarea>
                        </div>
                    </div>
                </div>

                {{-- Tab B: Preferences --}}
                <div class="tab-panel" id="tab-preferences" role="tabpanel">
                    <div class="section-card">
                        <h3 class="section-title">الواجهة</h3>
                        <div class="toggle-row"><label class="toggle-label">اللغة</label><select
                                class="form-select form-select--sm pref-field" data-pref="language">
                                <option value="ar" selected>العربية</option>
                                <option value="en">English</option>
                            </select></div>
                        <div class="toggle-row"><label class="toggle-label">نمط العرض</label><label
                                class="toggle-switch"><input type="checkbox" class="pref-field"
                                    data-pref="dark_mode"><span class="toggle-track"></span></label><span
                                class="toggle-hint" id="themeHint">فاتح</span></div>
                        <div class="toggle-row"><label class="toggle-label">اتجاه الواجهة</label><span
                                class="chip chip--branch">RTL</span></div>
                        <div class="toggle-row"><label class="toggle-label">أصوات الإشعارات</label><label
                                class="toggle-switch"><input type="checkbox" class="pref-field" data-pref="notif_sound"
                                    checked><span class="toggle-track"></span></label></div>
                    </div>
                    <div class="section-card">
                        <h3 class="section-title">الإشعارات</h3>
                        <div class="toggle-row"><label class="toggle-label">إشعارات البريد</label><label
                                class="toggle-switch"><input type="checkbox" class="pref-field" data-pref="email_notif"
                                    checked><span class="toggle-track"></span></label></div>
                        <div class="toggle-row"><label class="toggle-label">إشعارات داخل النظام</label><label
                                class="toggle-switch"><input type="checkbox" class="pref-field" data-pref="inapp_notif"
                                    checked><span class="toggle-track"></span></label></div>
                        <div class="toggle-row"><label class="toggle-label">ملخص يومي</label><label
                                class="toggle-switch"><input type="checkbox" class="pref-field"
                                    data-pref="daily_digest"><span class="toggle-track"></span></label></div>
                    </div>
                </div>

                {{-- Tab C: Security --}}
                <div class="tab-panel" id="tab-security" role="tabpanel">
                    <div class="section-card">
                        <h3 class="section-title">تغيير كلمة المرور</h3>
                        <div class="form-grid form-grid--narrow">
                            <div class="form-group"><label class="form-label">كلمة المرور الحالية</label><input
                                    type="password" class="form-input" id="currentPassword"
                                    autocomplete="current-password"></div>
                            <div class="form-group"><label class="form-label">كلمة المرور الجديدة</label><input
                                    type="password" class="form-input" id="newPassword" autocomplete="new-password">
                                <div class="pw-meter" id="pwMeter">
                                    <div class="pw-meter__bar" id="pwMeterBar"></div>
                                </div>
                                <div class="pw-rules" id="pwRules"><span data-rule="length">8 أحرف على
                                        الأقل</span><span data-rule="number">رقم واحد</span><span data-rule="special">رمز
                                        خاص</span><span data-rule="upper">حرف كبير</span></div>
                            </div>
                            <div class="form-group"><label class="form-label">تأكيد كلمة المرور</label><input
                                    type="password" class="form-input" id="confirmPassword"
                                    autocomplete="new-password"><span class="field-error" id="err-confirm"></span></div>
                        </div>
                        <button class="btn btn--primary btn--sm" id="btnChangePassword">تغيير كلمة المرور</button>
                    </div>
                    <div class="section-card">
                        <h3 class="section-title">التحقق الثنائي (2FA)</h3>
                        <div class="twofa-status">
                            <div class="twofa-info"><span class="badge badge--inactive" id="twofaBadge">غير مفعل</span>
                                <p class="twofa-desc">أضف طبقة حماية إضافية لحسابك عبر تطبيق المصادقة.</p>
                            </div>
                            <div class="twofa-actions"><button class="btn btn--primary btn--sm" id="btnEnable2FA">تفعيل
                                    2FA</button><button class="btn btn--outline btn--sm btn--danger-outline"
                                    id="btnDisable2FA" style="display:none;">تعطيل 2FA</button></div>
                        </div>
                    </div>
                </div>

                {{-- Tab D: Sessions --}}
                <div class="tab-panel" id="tab-sessions" role="tabpanel">
                    <div class="section-card">
                        <div class="section-header-row">
                            <h3 class="section-title">الجلسات النشطة</h3><button
                                class="btn btn--outline btn--sm btn--danger-outline" id="btnLogoutAll"
                                aria-label="تسجيل الخروج من الجميع">تسجيل الخروج من الجميع</button>
                        </div>
                        <div class="table-responsive">
                            <table class="data-table" id="sessionsTable">
                                <thead>
                                    <tr>
                                        <th>الجهاز</th>
                                        <th>المتصفح</th>
                                        <th>IP</th>
                                        <th>الموقع</th>
                                        <th>آخر نشاط</th>
                                        <th>الحالة</th>
                                        <th>إجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sessions as $i => $s)
                                        <tr data-session-id="{{ $s['id'] }}">
                                            <td><strong>{{ $s['device'] }}</strong></td>
                                            <td>{{ $s['browser'] }}</td>
                                            <td class="ltr-text">{{ $s['ip'] }}</td>
                                            <td>{{ $s['location'] }}</td>
                                            <td>{{ $s['last_active'] }}</td>
                                            <td><span
                                                    class="badge {{ $s['status'] === 'active' ? 'badge--active' : 'badge--inactive' }}">{{ $s['status'] === 'active' ? 'نشط' : 'غير نشط' }}</span>
                                            </td>
                                            <td>
                                                @if ($i === 0)
                                                <span class="current-tag">الجلسة الحالية</span>@else<button
                                                        class="btn btn--sm btn--outline btn--danger-outline"
                                                        data-action="terminate-session" data-id="{{ $s['id'] }}"
                                                        aria-label="إنهاء الجلسة">إنهاء</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Tab E: Activity --}}
                <div class="tab-panel" id="tab-activity" role="tabpanel">
                    <div class="section-card">
                        <div class="section-header-row">
                            <h3 class="section-title">سجل النشاط</h3>
                            <div class="activity-filters">
                                <button class="chip-filter active" data-afilter="all">الكل</button>
                                <button class="chip-filter" data-afilter="today">اليوم</button>
                                <button class="chip-filter" data-afilter="week">الأسبوع</button>
                            </div>
                        </div>
                        <div class="timeline" id="activityTimeline">
                            @foreach ($activity as $a)
                                <div class="timeline-item" data-activity-time="{{ $a['time'] }}">
                                    <div class="timeline-dot timeline-dot--{{ $a['icon'] }}"></div>
                                    <div class="timeline-line"></div>
                                    <div class="timeline-content">
                                        <strong>{{ $a['action'] }}</strong>
                                        <span class="timeline-ref">{{ $a['ref'] }}</span>
                                        <time>{{ $a['time'] }}</time>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============ MODALS ============ --}}

    {{-- Confirmation Modal --}}
    <div class="modal" id="confirmModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--sm">
            <div class="modal__header">
                <h2 class="modal__title" id="confirmTitle">تأكيد</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <p id="confirmMsg"></p><input type="hidden" id="confirmAction">
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--danger" id="confirmBtn">تأكيد</button></div>
        </div>
    </div>

    {{-- 2FA Enable Modal --}}
    <div class="modal" id="twofaModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">تفعيل التحقق الثنائي</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <div class="twofa-steps">
                    <p class="twofa-step-label">1. امسح رمز QR بتطبيق المصادقة:</p>
                    <div class="qr-placeholder"><svg width="120" height="120" viewBox="0 0 120 120">
                            <rect width="120" height="120" fill="#f1f5f9" rx="12" /><text x="50%" y="50%"
                                text-anchor="middle" dy=".3em" fill="#94a3b8" font-size="11">QR Code</text>
                        </svg></div>
                    <p class="twofa-step-label">2. أدخل رمز التحقق (6 أرقام):</p>
                    <div class="otp-inputs" id="otpGroup">
                        <input type="text" class="otp-input" maxlength="1" data-otp="0" inputmode="numeric"
                            autofocus>
                        <input type="text" class="otp-input" maxlength="1" data-otp="1" inputmode="numeric">
                        <input type="text" class="otp-input" maxlength="1" data-otp="2" inputmode="numeric">
                        <input type="text" class="otp-input" maxlength="1" data-otp="3" inputmode="numeric">
                        <input type="text" class="otp-input" maxlength="1" data-otp="4" inputmode="numeric">
                        <input type="text" class="otp-input" maxlength="1" data-otp="5" inputmode="numeric">
                    </div>
                    <span class="field-error" id="err-otp"></span>
                </div>
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--primary" id="confirmOTP">تأكيد التفعيل</button></div>
        </div>
    </div>

    {{-- Toast --}}
    <div class="toast" id="toast" role="status" aria-live="polite"><span class="toast__icon"
            id="toastIcon">✓</span><span class="toast__message" id="toastMessage"></span></div>

    @php
        $profileUser = $user->only(['id', 'name', 'email', 'mobile', 'branch_id', 'is_active']);
    @endphp
    <script>
        window.__PROFILE_DATA = {
            user: @json($profileUser),
            sessions: @json($sessions),
            activity: @json($activity),
            branches: @json($branches),
            updateUrl: '{{ route('profile.update') }}',
            passwordUrl: '{{ route('profile.password') }}',
            csrfToken: '{{ csrf_token() }}'
        };
    </script>
@endsection

