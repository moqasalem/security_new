@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/settings-index.css') }}">
@endpush



@section('content')
    @php
        $branches = ['الرياض', 'جدة', 'الدمام', 'مكة', 'المدينة'];

        $pdfTemplates = [
            ['id' => 1, 'name' => 'قالب عرض سعر افتراضي', 'type' => 'quotation', 'scope' => 'عام', 'branch' => null],
            [
                'id' => 2,
                'name' => 'قالب عرض سعر - الرياض',
                'type' => 'quotation',
                'scope' => 'فرع',
                'branch' => 'الرياض',
            ],
            ['id' => 3, 'name' => 'قالب عقد افتراضي', 'type' => 'contract', 'scope' => 'عام', 'branch' => null],
            [
                'id' => 4,
                'name' => 'قالب عقد موظف افتراضي',
                'type' => 'employee_contract',
                'scope' => 'عام',
                'branch' => null,
            ],
        ];

        $branchPolicies = [
            ['id' => 1, 'branch' => 'الرياض', 'template' => 'قالب عرض سعر - الرياض'],
            ['id' => 2, 'branch' => 'جدة', 'template' => 'قالب عقد افتراضي'],
        ];

        $auditLogs = [
            [
                'time' => '2026-02-12 14:30',
                'user' => 'عبدالله الراشد',
                'section' => 'عام',
                'change' => 'تغيير اسم النظام إلى "النظام الداخلي v2"',
            ],
            [
                'time' => '2026-02-12 13:15',
                'user' => 'محمد العتيبي',
                'section' => 'البريد',
                'change' => 'تحديث إعدادات SMTP',
            ],
            [
                'time' => '2026-02-11 16:45',
                'user' => 'عبدالله الراشد',
                'section' => 'الأمان',
                'change' => 'تفعيل المصادقة الثنائية',
            ],
            [
                'time' => '2026-02-11 10:20',
                'user' => 'فهد القحطاني',
                'section' => 'الهوية',
                'change' => 'تحديث شعار النظام',
            ],
            [
                'time' => '2026-02-10 09:00',
                'user' => 'عبدالله الراشد',
                'section' => 'PDF',
                'change' => 'إضافة قالب عرض سعر جديد',
            ],
            [
                'time' => '2026-02-09 14:30',
                'user' => 'محمد العتيبي',
                'section' => 'عام',
                'change' => 'تغيير المنطقة الزمنية',
            ],
            [
                'time' => '2026-02-08 11:10',
                'user' => 'عبدالله الراشد',
                'section' => 'الأمان',
                'change' => 'تدوير مفتاح API',
            ],
            [
                'time' => '2026-02-07 15:40',
                'user' => 'فهد القحطاني',
                'section' => 'الإشعارات',
                'change' => 'تفعيل إشعارات انتهاء العقود',
            ],
        ];

        $sessions = [
            ['device' => 'Chrome - Windows', 'ip' => '192.168.1.50', 'date' => 'منذ 5 دقائق', 'active' => true],
            ['device' => 'Safari - iPhone', 'ip' => '10.0.0.12', 'date' => 'منذ ساعة', 'active' => false],
            ['device' => 'Firefox - macOS', 'ip' => '192.168.1.63', 'date' => 'أمس', 'active' => false],
            ['device' => 'Edge - Windows', 'ip' => '172.16.0.5', 'date' => 'منذ 3 أيام', 'active' => false],
            ['device' => 'Chrome - Android', 'ip' => '192.168.1.80', 'date' => 'منذ أسبوع', 'active' => false],
        ];
    @endphp

    <div class="settings-page">

        {{-- Header --}}
        <div class="page-header">
            <div class="page-header__left">
                <h1 class="page-title">الإعدادات</h1>
                <nav class="breadcrumb" aria-label="breadcrumb"><a
                        href="{{ route('dashboard') }}">الرئيسية</a><span>/</span><span>الإعدادات</span></nav>
            </div>
            <div class="page-header__right">
                <div class="dirty-badge" id="dirtyBadge" style="display:none;"><span class="dirty-dot"></span> لديك تغييرات
                    غير محفوظة</div>
                {{-- <button class="btn btn--primary" id="btnSaveAll" aria-label="حفظ الكل"><svg width="16" height="16"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                    </svg> حفظ الكل</button> --}}
                {{-- <button class="btn btn--outline" id="btnResetAll" aria-label="إعادة ضبط"><svg width="16" height="16"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                            clip-rule="evenodd" />
                    </svg> إعادة ضبط</button> --}}
                <button class="btn btn--outline" id="btnOpenAuditLog" aria-label="سجل التغييرات"><svg width="16"
                        height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd" />
                    </svg> سجل التغييرات</button>
                <div class="dropdown-wrap">
                    <button class="btn btn--outline" id="btnExportSettings" aria-label="تصدير الإعدادات"
                        aria-expanded="false"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg> تصدير</button>
                    <div class="dropdown-menu" id="exportMenu">
                        <button class="dropdown-item" data-export="json">تصدير JSON</button>
                        <button class="dropdown-item" data-export="pdf">تصدير PDF</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Two-column layout --}}
        <div class="settings-layout">
            {{-- Settings sidebar --}}
            <aside class="settings-sidebar" id="settingsSidebar">
                <nav class="settings-nav">
                    <button class="settings-nav__item active" data-section="general"><svg width="18" height="18"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd" />
                        </svg> عام</button>
                    {{-- <button class="settings-nav__item" data-section="branding"><svg width="18" height="18"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2.121 2.121 0 00-3-3L7 11.243V14h2.243z"
                                clip-rule="evenodd" />
                        </svg> الهوية البصرية</button>
                    <button class="settings-nav__item" data-section="pdf"><svg width="18" height="18"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                clip-rule="evenodd" />
                        </svg> قوالب PDF</button>
                    <button class="settings-nav__item" data-section="email"><svg width="18" height="18"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg> البريد والإشعارات</button>
                    <button class="settings-nav__item" data-section="security"><svg width="18" height="18"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg> الأمان و API</button> --}}
                    <button class="settings-nav__item" data-section="audit"><svg width="18" height="18"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg> سجل التغييرات</button>
                </nav>
            </aside>

            {{-- Sections content --}}
            <div class="settings-content">

                {{-- ===== SECTION: GENERAL ===== --}}
                <div class="settings-section active" id="section-general">
                    <div class="section-card">
                        <h2 class="section-card__title">معلومات النظام</h2>
                        <div class="form-grid">
                            <div class="form-group"><label class="form-label">اسم النظام</label><input type="text"
                                    class="form-input settings-field" data-key="system_name" value="النظام الداخلي">
                            </div>
                            {{--                             
                            <div class="form-group"><label class="form-label">المنطقة الزمنية</label><select
                                    class="form-select settings-field" data-key="timezone">
                                    <option value="Asia/Riyadh" selected>Asia/Riyadh (UTC+3)</option>
                                    <option value="Asia/Dubai">Asia/Dubai (UTC+4)</option>
                                    <option value="Asia/Kuwait">Asia/Kuwait (UTC+3)</option>
                                </select></div> 
                            <div class="form-group"><label class="form-label">اللغة</label><select
                                    class="form-select settings-field" data-key="language">
                                    <option value="ar" selected>العربية</option>
                                    <option value="en">English</option>
                                </select></div>
                            <div class="form-group"><label class="form-label">عملة العرض</label><select
                                    class="form-select settings-field" data-key="currency">
                                    <option value="SAR" selected>ريال سعودي (SAR)</option>
                                    <option value="USD">دولار أمريكي (USD)</option>
                                    <option value="AED">درهم إماراتي (AED)</option>
                                </select></div>
                                --}}
                        </div>
                    </div>
                    <div class="section-card">

                        <div class="form-grid">

                            <div class="form-group form-group--full"></div>
                            <div class="form-group"><label class="form-label">بادئة ترقيم العروض</label><input
                                    type="text" class="form-input settings-field" data-key="quote_prefix" value="QT-"
                                    dir="ltr"></div>

                            <div class="form-group"><label class="form-label">بادئة ترقيم العقود</label><input
                                    type="text" class="form-input settings-field" data-key="contract_prefix"
                                    value="CT-" dir="ltr"></div>

                        </div>
                    </div>
                    <div class="section-actions"><button class="btn btn--primary" data-action="save-section"
                            data-section="general">حفظ القسم</button></div>
                </div>

                {{-- ===== SECTION: BRANDING ===== --}}
                <div class="settings-section" id="section-branding">
                    <div class="section-card">
                        <h2 class="section-card__title">الشعار</h2>
                        <div class="logo-upload">
                            <div class="logo-preview" id="logoPreview">
                                <svg width="48" height="48" viewBox="0 0 40 40" fill="none">
                                    <circle cx="20" cy="20" r="20" fill="#2563eb" />
                                    <path d="M20 10L28 16V24L20 30L12 24V16L20 10Z" fill="white" />
                                </svg>
                                <img id="logoImg" src="" alt="شعار النظام" style="display:none;">
                            </div>
                            <div class="logo-actions">
                                <button class="btn btn--outline btn--sm" id="btnUploadLogo" aria-label="رفع شعار"><svg
                                        width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg> رفع شعار</button>
                                <button class="btn btn--outline btn--sm btn--muted" id="btnRemoveLogo"
                                    aria-label="إزالة الشعار">إزالة</button>
                                <input type="file" id="logoFileInput" accept="image/*" style="display:none;">
                                <span class="text-muted">PNG أو SVG، بحد أقصى 500×500</span>
                            </div>
                        </div>
                    </div>
                    <div class="section-card">
                        <h2 class="section-card__title">الألوان</h2>
                        <div class="form-grid">
                            <div class="form-group"><label class="form-label">اللون الأساسي</label>
                                <div class="color-picker-wrap"><input type="color" class="color-input settings-field"
                                        data-key="primary_color" value="#2563eb"><span class="color-value"
                                        id="primaryVal">#2563eb</span></div>
                            </div>
                            <div class="form-group"><label class="form-label">اللون الثانوي</label>
                                <div class="color-picker-wrap"><input type="color" class="color-input settings-field"
                                        data-key="secondary_color" value="#0f172a"><span class="color-value"
                                        id="secondaryVal">#0f172a</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="section-card">
                        <h2 class="section-card__title">الترويسة والتذييل</h2>
                        <div class="form-grid form-grid--full">
                            <div class="form-group"><label class="form-label">نص الترويسة</label>
                                <textarea class="form-textarea settings-field" data-key="header_text" rows="2">شركة الأمان للحراسات الأمنية</textarea>
                            </div>
                            <div class="form-group"><label class="form-label">نص التذييل</label>
                                <textarea class="form-textarea settings-field" data-key="footer_text" rows="2">جميع الحقوق محفوظة © 2026</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="section-actions"><button class="btn btn--primary" data-action="save-section"
                            data-section="branding">حفظ القسم</button></div>
                </div>

                {{-- ===== SECTION: PDF TEMPLATES ===== --}}
                <div class="settings-section" id="section-pdf">
                    <div class="section-card">
                        <div class="section-card__header">
                            <h2 class="section-card__title">قوالب PDF</h2>
                            <div class="section-card__actions">
                                <button class="btn btn--outline btn--sm" id="btnAddPdfTemplate">إضافة قالب</button>
                                <button class="btn btn--outline btn--sm" id="btnPreviewPdfTemplate">معاينة</button>
                            </div>
                        </div>
                        <div class="pdf-tabs" id="pdfTabs">
                            <button class="pdf-tab active" data-ptype="quotation">عرض أسعار</button>
                            <button class="pdf-tab" data-ptype="contract">عقد</button>
                            <button class="pdf-tab" data-ptype="employee_contract">عقد موظف</button>
                        </div>
                        <div class="pdf-scope">
                            <label class="radio-option"><input type="radio" name="pdfScope" value="global" checked
                                    class="settings-field" data-key="pdf_scope"> استخدام قالب عام</label>
                            <label class="radio-option"><input type="radio" name="pdfScope" value="branch"
                                    class="settings-field" data-key="pdf_scope"> قالب حسب الفرع</label>
                        </div>
                        <div class="branch-policies" id="branchPolicies" style="display:none;">
                            <div class="mini-table-wrap">
                                <table class="mini-table">
                                    <thead>
                                        <tr>
                                            <th>الفرع</th>
                                            <th>القالب</th>
                                            <th>إجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="policiesBody">
                                        @foreach ($branchPolicies as $bp)
                                            <tr data-policy-id="{{ $bp['id'] }}">
                                                <td>{{ $bp['branch'] }}</td>
                                                <td>{{ $bp['template'] }}</td>
                                                <td><button class="btn btn--xs btn--outline"
                                                        data-remove-policy="{{ $bp['id'] }}">حذف</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn--outline btn--sm" id="btnAddBranchPolicy">إضافة سياسة فرع</button>
                        </div>
                        <div class="form-group" style="margin-top:16px"><label class="form-label">شروط وملاحظات
                                ثابتة</label>
                            <textarea class="form-textarea settings-field" data-key="pdf_terms" rows="4">- الأسعار المذكورة لا تشمل ضريبة القيمة المضافة.
- صلاحية العرض 30 يوماً من تاريخ الإصدار.
- يبدأ العقد من تاريخ التوقيع.</textarea>
                        </div>
                        <div class="toggle-row"><label class="toggle-label">إظهار ختم/توقيع</label><label
                                class="toggle-switch"><input type="checkbox" class="settings-field"
                                    data-key="pdf_show_stamp" checked><span class="toggle-track"></span></label></div>
                    </div>
                    <div class="section-actions">
                        <button class="btn btn--primary" id="btnSavePdfTemplate">حفظ القالب</button>
                        <button class="btn btn--primary" data-action="save-section" data-section="pdf">حفظ القسم</button>
                    </div>
                </div>

                {{-- ===== SECTION: EMAIL & NOTIFICATIONS ===== --}}
                <div class="settings-section" id="section-email">
                    <div class="section-card">
                        <h2 class="section-card__title">إعدادات SMTP / البريد</h2>
                        <div class="form-grid">
                            <div class="form-group"><label class="form-label">Host</label><input type="text"
                                    class="form-input settings-field" data-key="smtp_host" value="smtp.gmail.com"
                                    dir="ltr"></div>
                            <div class="form-group"><label class="form-label">Port</label><input type="number"
                                    class="form-input settings-field" data-key="smtp_port" value="587"
                                    dir="ltr"></div>
                            <div class="form-group"><label class="form-label">Username</label><input type="text"
                                    class="form-input settings-field" data-key="smtp_user" value="system@company.sa"
                                    dir="ltr"></div>
                            <div class="form-group"><label class="form-label">Password</label><input type="password"
                                    class="form-input settings-field" data-key="smtp_pass" value="••••••••"
                                    dir="ltr"></div>
                            <div class="form-group"><label class="form-label">From Name</label><input type="text"
                                    class="form-input settings-field" data-key="smtp_from_name" value="النظام الداخلي">
                            </div>
                            <div class="form-group"><label class="form-label">From Email</label><input type="email"
                                    class="form-input settings-field" data-key="smtp_from_email"
                                    value="noreply@company.sa" dir="ltr"></div>
                        </div>
                        <div class="toggle-row" style="margin-top:12px"><label class="toggle-label">تشفير
                                TLS/SSL</label><label class="toggle-switch"><input type="checkbox" class="settings-field"
                                    data-key="smtp_tls" checked><span class="toggle-track"></span></label></div>
                        <div style="margin-top:16px"><button class="btn btn--outline btn--sm" id="btnTestEmail">اختبار
                                إرسال</button></div>
                    </div>
                    <div class="section-card">
                        <h2 class="section-card__title">إشعارات النظام</h2>
                        <div class="notif-list">
                            <label class="notif-option"><input type="checkbox" class="settings-field"
                                    data-key="notif_quote_submit" checked> إشعار عند إرسال عرض للاعتماد</label>
                            <label class="notif-option"><input type="checkbox" class="settings-field"
                                    data-key="notif_quote_approve" checked> إشعار عند الاعتماد / الرفض</label>
                            <label class="notif-option"><input type="checkbox" class="settings-field"
                                    data-key="notif_contract_expiry" checked> إشعار قرب انتهاء عقد</label>
                            <label class="notif-option"><input type="checkbox" class="settings-field"
                                    data-key="notif_emp_sign"> إشعار توقيع عقد موظف</label>
                        </div>
                        <div class="form-group" style="margin-top:16px"><label class="form-label">قناة
                                الإشعار</label><select class="form-select settings-field" data-key="notif_channel">
                                <option value="email" selected>البريد الإلكتروني</option>
                                <option value="inapp">داخل النظام</option>
                                <option value="both">كلاهما</option>
                            </select></div>
                    </div>
                    <div class="section-actions"><button class="btn btn--primary" data-action="save-section"
                            data-section="email">حفظ القسم</button></div>
                </div>

                {{-- ===== SECTION: SECURITY & API ===== --}}
                <div class="settings-section" id="section-security">
                    <div class="section-card">
                        <h2 class="section-card__title">سياسات الأمان</h2>
                        <div class="form-grid">
                            <div class="form-group"><label class="form-label">مدة الجلسة (بالدقائق)</label><input
                                    type="number" class="form-input settings-field" data-key="session_timeout"
                                    value="120" dir="ltr"></div>
                            <div class="form-group"><label class="form-label">قفل بعد محاولات فاشلة</label><input
                                    type="number" class="form-input settings-field" data-key="max_attempts"
                                    value="5" dir="ltr"></div>
                            <div class="form-group"><label class="form-label">الحد الأدنى لطول كلمة المرور</label><input
                                    type="number" class="form-input settings-field" data-key="min_password"
                                    value="8" dir="ltr"></div>
                        </div>
                        <div class="toggle-row"><label class="toggle-label">تفعيل المصادقة الثنائية (2FA)</label><label
                                class="toggle-switch"><input type="checkbox" class="settings-field"
                                    data-key="enable_2fa"><span class="toggle-track"></span></label></div>
                        <div class="toggle-row"><label class="toggle-label">اشتراط رموز خاصة في كلمة المرور</label><label
                                class="toggle-switch"><input type="checkbox" class="settings-field"
                                    data-key="require_symbols" checked><span class="toggle-track"></span></label></div>
                        <div style="margin-top:16px"><button class="btn btn--primary btn--sm" id="btnSaveSecurity">حفظ
                                سياسات الأمان</button></div>
                    </div>
                    <div class="section-card">
                        <h2 class="section-card__title">API Keys</h2>
                        <div class="api-key-wrap">
                            <div class="api-key-display"><code
                                    id="apiKeyValue">sk-****************************a3f9</code><button
                                    class="btn btn--xs btn--outline" id="btnCopyApiKey" aria-label="نسخ المفتاح">📋
                                    نسخ</button></div>
                            <button class="btn btn--outline btn--sm" id="btnRotateApiKey" aria-label="تدوير المفتاح">🔄
                                تدوير المفتاح</button>
                        </div>
                    </div>
                    <div class="section-card">
                        <h2 class="section-card__title">سجل الجلسات</h2>
                        <div class="mini-table-wrap">
                            <table class="mini-table">
                                <thead>
                                    <tr>
                                        <th>الجهاز</th>
                                        <th>عنوان IP</th>
                                        <th>التاريخ</th>
                                        <th>الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sessions as $s)
                                        <tr>
                                            <td>{{ $s['device'] }}</td>
                                            <td dir="ltr">{{ $s['ip'] }}</td>
                                            <td>{{ $s['date'] }}</td>
                                            <td><span
                                                    class="badge {{ $s['active'] ? 'badge--active' : 'badge--muted' }}">{{ $s['active'] ? 'نشط' : 'منتهية' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="section-actions"><button class="btn btn--primary" data-action="save-section"
                            data-section="security">حفظ القسم</button></div>
                </div>

                {{-- ===== SECTION: AUDIT LOG ===== --}}
                <div class="settings-section" id="section-audit">
                    <div class="section-card">
                        <div class="section-card__header">
                            <h2 class="section-card__title">سجل التغييرات</h2>
                            <button class="btn btn--outline btn--sm" data-export-audit>تصدير</button>
                        </div>
                        <div class="filter-row">
                            <input type="text" class="form-input form-input--sm" id="auditSearchUser"
                                placeholder="المستخدم...">
                            <select class="form-select form-select--sm" id="auditFilterSection">
                                <option value="">كل الأقسام</option>
                                <option value="عام">عام</option>
                                <option value="الهوية">الهوية</option>
                                <option value="PDF">PDF</option>
                                <option value="البريد">البريد</option>
                                <option value="الأمان">الأمان</option>
                                <option value="الإشعارات">الإشعارات</option>
                            </select>
                        </div>
                        <div class="mini-table-wrap">
                            <table class="mini-table" id="auditTable">
                                <thead>
                                    <tr>
                                        <th>الوقت</th>
                                        <th>المستخدم</th>
                                        <th>القسم</th>
                                        <th>التغيير</th>
                                    </tr>
                                </thead>
                                <tbody id="auditBody">
                                    @foreach ($auditLogs as $log)
                                        <tr>
                                            <td class="text-muted">{{ $log['time'] }}</td>
                                            <td>{{ $log['user'] }}</td>
                                            <td><span class="chip chip--audit">{{ $log['section'] }}</span></td>
                                            <td>{{ $log['change'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ==================== MODALS ==================== --}}

    {{-- Modal: Reset All Confirmation --}}
    {{-- <div class="modal" id="resetModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--sm">
            <div class="modal__header">
                <h2 class="modal__title">إعادة ضبط الإعدادات</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <p>هل أنت متأكد من إعادة ضبط جميع الإعدادات إلى القيم الافتراضية؟ لا يمكن التراجع عن هذا الإجراء.</p>
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--danger" id="resetConfirm">إعادة ضبط</button></div>
        </div>
    </div> --}}

    {{-- Modal: Add PDF Template --}}
    <div class="modal" id="pdfTemplateModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">إضافة قالب PDF</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <div class="form-group"><label class="form-label">اسم القالب <span class="req">*</span></label><input
                        type="text" class="form-input" id="newTplName"></div>
                <div class="form-group"><label class="form-label">النوع</label><select class="form-select"
                        id="newTplType">
                        <option value="quotation">عرض أسعار</option>
                        <option value="contract">عقد</option>
                        <option value="employee_contract">عقد موظف</option>
                    </select></div>
                <div class="form-group"><label class="form-label">النطاق</label><select class="form-select"
                        id="newTplScope">
                        <option value="عام">عام</option>
                        <option value="فرع">فرع</option>
                    </select></div>
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--primary" id="savePdfTplBtn">حفظ</button></div>
        </div>
    </div>

    {{-- Modal: Preview PDF (A4) --}}
    <div class="modal" id="pdfPreviewModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--a4">
            <div class="modal__header">
                <h2 class="modal__title">معاينة القالب</h2>
                <div style="display:flex;gap:8px"><button class="btn btn--outline btn--sm"
                        id="printPreview">طباعة</button><button class="modal__close" aria-label="إغلاق">&times;</button>
                </div>
            </div>
            <div class="modal__body" id="pdfPreviewBody">
                <div class="a4-page">
                    <div class="a4-header">
                        <div class="a4-logo"><svg width="36" height="36" viewBox="0 0 40 40" fill="none">
                                <circle cx="20" cy="20" r="20" fill="#2563eb" />
                                <path d="M20 10L28 16V24L20 30L12 24V16L20 10Z" fill="white" />
                            </svg></div>
                        <h2>شركة الأمان للحراسات الأمنية</h2>
                    </div>
                    <hr>
                    <h3 style="text-align:center;color:#2563eb;">عرض سعر</h3>
                    <table class="a4-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>البند</th>
                                <th>الكمية</th>
                                <th>السعر</th>
                                <th>الإجمالي</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>خدمة حراسة أمنية</td>
                                <td>10</td>
                                <td>3,500</td>
                                <td>35,000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>كاميرات مراقبة</td>
                                <td>20</td>
                                <td>800</td>
                                <td>16,000</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="a4-total"><strong>الإجمالي: 51,000 ريال</strong></div>
                    <hr>
                    <div class="a4-footer">
                        <p>جميع الحقوق محفوظة © 2026</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Add Branch Policy --}}
    <div class="modal" id="branchPolicyModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--sm">
            <div class="modal__header">
                <h2 class="modal__title">إضافة سياسة فرع</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <div class="form-group"><label class="form-label">الفرع</label><select class="form-select"
                        id="policyBranch">
                        @foreach ($branches as $b)
                            <option value="{{ $b }}">{{ $b }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group"><label class="form-label">القالب</label><select class="form-select"
                        id="policyTemplate">
                        @foreach ($pdfTemplates as $t)
                            <option value="{{ $t['name'] }}">{{ $t['name'] }}</option>
                        @endforeach
                    </select></div>
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--primary" id="savePolicyBtn">حفظ</button></div>
        </div>
    </div>

    {{-- Modal: Test Email --}}
    <div class="modal" id="testEmailModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--sm">
            <div class="modal__header">
                <h2 class="modal__title">اختبار إرسال بريد</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <div class="form-group"><label class="form-label">البريد التجريبي</label><input type="email"
                        class="form-input" id="testEmailAddr" placeholder="test@example.com" dir="ltr"></div>
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--primary" id="sendTestEmail">إرسال</button></div>
        </div>
    </div>

    {{-- Modal: Rotate API Key Confirmation --}}
    <div class="modal" id="rotateKeyModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--sm">
            <div class="modal__header">
                <h2 class="modal__title">تدوير مفتاح API</h2><button class="modal__close"
                    aria-label="إغلاق">&times;</button>
            </div>
            <div class="modal__body">
                <p>سيتم إلغاء المفتاح الحالي وتوليد مفتاح جديد. هل أنت متأكد؟</p>
            </div>
            <div class="modal__footer"><button class="btn btn--outline modal-close-btn">إلغاء</button><button
                    class="btn btn--danger" id="rotateKeyConfirm">تأكيد التدوير</button></div>
        </div>
    </div>

    {{-- Drawer: Audit Log --}}
    <div class="drawer" id="auditDrawer">
        <div class="drawer__overlay"></div>
        <div class="drawer__panel">
            <div class="drawer__header">
                <h2>سجل التغييرات</h2><button class="drawer__close" aria-label="إغلاق">&times;</button>
            </div>
            <div class="drawer__body">
                <div class="filter-row" style="margin-bottom:12px">
                    <input type="text" class="form-input form-input--sm" id="drawerAuditSearch" placeholder="بحث...">
                </div>
                <div class="audit-timeline" id="drawerAuditList">
                    @foreach ($auditLogs as $log)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content"><strong>{{ $log['user'] }}</strong><span
                                    class="chip chip--audit">{{ $log['section'] }}</span>
                                <p>{{ $log['change'] }}</p><time class="text-muted">{{ $log['time'] }}</time>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <div class="toast" id="toast" role="status" aria-live="polite"><span class="toast__message"
            id="toastMessage"></span></div>

    <script>
        window.__SETTINGS_DATA = {
            branches: @json($branches),
            pdfTemplates: @json($pdfTemplates),
            branchPolicies: @json($branchPolicies),
            auditLogs: @json($auditLogs)
        };
    </script>
@endsection

