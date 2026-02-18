<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>توقيع عقد الموظف</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/public-employee-contract-sign.css') }}">
</head>
<body>
    @php
        $contractPublic = [
            'number' => 'EC-2025-001',
            'employee_name' => 'عبدالله محمد الحربي',
            'masked_id' => '10****8901',
            'site' => 'مجمع الراشد - الرياض',
            'start_date' => '2025-03-01',
            'end_date' => '2026-02-28',
            'contact_masked' => '055***4567',
        ];
    @endphp

    <div class="sign-page">

        {{-- Public Header --}}
        <header class="pub-header">
            <div class="pub-header__logo">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"><rect width="40" height="40" rx="10" fill="#2563eb"/><path d="M12 28V12h6l4 6 4-6h6v16h-5V18l-5 7-5-7v10h-5z" fill="#fff"/></svg>
                <div class="pub-header__brand">
                    <span class="pub-header__name">نظام إدارة الأمن</span>
                    <span class="pub-header__sub">Security Management System</span>
                </div>
            </div>
            <div class="pub-header__title">
                <h1>توقيع عقد الموظف</h1>
                <p>يرجى إكمال الخطوات التالية لتوقيع العقد إلكترونياً</p>
            </div>
        </header>

        {{-- Contract Summary --}}
        <div class="summary-card">
            <h2 class="summary-card__title">ملخص العقد</h2>
            <div class="summary-grid">
                <div class="summary-item"><span class="summary-label">رقم العقد</span><span class="summary-value">{{ $contractPublic['number'] }}</span></div>
                <div class="summary-item"><span class="summary-label">اسم الموظف</span><span class="summary-value">{{ $contractPublic['employee_name'] }}</span></div>
                <div class="summary-item"><span class="summary-label">الهوية/الإقامة</span><span class="summary-value" dir="ltr" style="text-align:right">{{ $contractPublic['masked_id'] }}</span></div>
                <div class="summary-item"><span class="summary-label">موقع العمل</span><span class="summary-value">{{ $contractPublic['site'] }}</span></div>
                <div class="summary-item"><span class="summary-label">تاريخ البداية</span><span class="summary-value">{{ $contractPublic['start_date'] }}</span></div>
                <div class="summary-item"><span class="summary-label">تاريخ النهاية</span><span class="summary-value">{{ $contractPublic['end_date'] }}</span></div>
            </div>
            <div class="summary-footer">
                <span class="status-badge status-badge--pending" id="summaryBadge">بانتظار التوقيع</span>
                <button class="btn btn--outline btn--sm" id="btnViewContract" disabled aria-label="عرض العقد">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                    عرض العقد
                </button>
            </div>
        </div>

        {{-- Stepper --}}
        <div class="stepper">
            <div class="stepper__step active" data-step="1">
                <div class="stepper__circle">1</div>
                <span class="stepper__label">التحقق</span>
            </div>
            <div class="stepper__line"></div>
            <div class="stepper__step" data-step="2">
                <div class="stepper__circle">2</div>
                <span class="stepper__label">التوقيع</span>
            </div>
            <div class="stepper__line"></div>
            <div class="stepper__step" data-step="3">
                <div class="stepper__circle">3</div>
                <span class="stepper__label">التأكيد</span>
            </div>
        </div>

        {{-- Step 1: OTP --}}
        <div class="step-panel" id="step1" style="display:block;">
            <div class="step-card">
                <div class="step-card__icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="#2563eb"><path d="M12 1a5 5 0 00-5 5v2H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V10a2 2 0 00-2-2h-1V6a5 5 0 00-5-5zm-3 5a3 3 0 116 0v2H9V6zm3 7a2 2 0 00-1 3.732V18a1 1 0 002 0v-1.268A2 2 0 0012 13z"/></svg>
                </div>
                <h3 class="step-card__title">التحقق من الهوية</h3>
                <p class="step-card__desc">سنرسل رمز تحقق مكون من 6 أرقام إلى رقم الجوال المسجل <strong>{{ $contractPublic['contact_masked'] }}</strong></p>

                {{-- Pre-send state --}}
                <div id="otpPreSend">
                    <button class="btn btn--primary btn--full" id="btnStartVerify">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
                        إرسال رمز التحقق
                    </button>
                </div>

                {{-- Post-send state --}}
                <div id="otpPostSend" style="display:none;">
                    <div class="otp-inputs" id="otpInputs">
                        <input type="text" class="otp-box" maxlength="1" inputmode="numeric" aria-label="الرقم 1" data-idx="0">
                        <input type="text" class="otp-box" maxlength="1" inputmode="numeric" aria-label="الرقم 2" data-idx="1">
                        <input type="text" class="otp-box" maxlength="1" inputmode="numeric" aria-label="الرقم 3" data-idx="2">
                        <input type="text" class="otp-box" maxlength="1" inputmode="numeric" aria-label="الرقم 4" data-idx="3">
                        <input type="text" class="otp-box" maxlength="1" inputmode="numeric" aria-label="الرقم 5" data-idx="4">
                        <input type="text" class="otp-box" maxlength="1" inputmode="numeric" aria-label="الرقم 6" data-idx="5">
                    </div>
                    <input type="hidden" id="otpValue">

                    <div class="otp-actions">
                        <button class="btn btn--primary btn--full" id="btnVerifyOtp" disabled>تحقق</button>
                        <button class="btn btn--text btn--full" id="btnResendOtp" disabled aria-label="إعادة إرسال الرمز">
                            إعادة إرسال <span id="resendTimer">(60)</span>
                        </button>
                    </div>

                    <div class="otp-alert" id="otpAlert" style="display:none;"></div>
                    <p class="step-card__note">قد يستغرق وصول الرمز بضع دقائق</p>
                </div>
            </div>
        </div>

        {{-- Step 2: Signature --}}
        <div class="step-panel" id="step2" style="display:none;">
            <div class="step-card">
                <h3 class="step-card__title">التوقيع على العقد</h3>
                <p class="step-card__desc">بعد قراءة العقد، ارسم توقيعك في المربع أدناه</p>

                <label class="agree-check" id="agreeLabel">
                    <input type="checkbox" id="agreeCheckbox">
                    <span>أقرّ بأنني قرأت العقد وأوافق على جميع بنوده</span>
                </label>

                <div class="canvas-wrapper">
                    <div class="canvas-header">
                        <span>ارسم توقيعك هنا</span>
                        <button class="btn btn--text btn--xs" id="btnClearSignature" aria-label="مسح التوقيع">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                            مسح
                        </button>
                    </div>
                    <canvas id="signatureCanvas" width="500" height="200"></canvas>
                </div>

                <p class="step-card__note">سيتم تسجيل وقت التوقيع ومعلومات الجهاز إلكترونياً</p>

                <button class="btn btn--primary btn--full btn--lg" id="btnAcceptAndSign" disabled>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    توقيع وإرسال
                </button>
            </div>
        </div>

        {{-- Step 3: Confirmation --}}
        <div class="step-panel" id="step3" style="display:none;">
            <div class="step-card step-card--success">
                <div class="success-icon">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none"><circle cx="40" cy="40" r="40" fill="#dcfce7"/><path d="M24 40l10 10 22-22" stroke="#16a34a" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <h3 class="step-card__title step-card__title--success">تم توقيع العقد بنجاح!</h3>
                <p class="step-card__desc">شكراً لك. تم تسجيل توقيعك إلكترونياً.</p>

                <div class="confirm-details">
                    <div class="confirm-item"><span class="confirm-label">وقت التوقيع</span><span class="confirm-value" id="signedAt">—</span></div>
                    <div class="confirm-item"><span class="confirm-label">الرقم المرجعي</span><span class="confirm-value" id="refNumber">—</span></div>
                    <div class="confirm-item"><span class="confirm-label">رقم العقد</span><span class="confirm-value">{{ $contractPublic['number'] }}</span></div>
                </div>

                <div class="confirm-actions">
                    <button class="btn btn--primary btn--full" id="btnDownloadSignedPdf">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        تنزيل نسخة PDF
                    </button>
                    <button class="btn btn--outline btn--full" id="btnBackToStart">العودة</button>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="pub-footer">
            <p>© 2025 نظام إدارة الأمن. جميع الحقوق محفوظة.</p>
        </footer>
    </div>

    {{-- Preview Modal --}}
    <div class="modal" id="previewModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--lg">
            <div class="modal__header">
                <h2 class="modal__title">معاينة العقد</h2>
                <button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
            </div>
            <div class="modal__body print-area">
                <div class="a4-page">
                    <div class="a4-header">عقد عمل</div>
                    <div class="a4-company">شركة الحماية الأمنية المحدودة</div>
                    <div class="a4-line"><strong>رقم العقد:</strong> {{ $contractPublic['number'] }}</div>
                    <div class="a4-line"><strong>اسم الموظف:</strong> {{ $contractPublic['employee_name'] }}</div>
                    <div class="a4-line"><strong>رقم الهوية:</strong> {{ $contractPublic['masked_id'] }}</div>
                    <div class="a4-line"><strong>موقع العمل:</strong> {{ $contractPublic['site'] }}</div>
                    <div class="a4-line"><strong>تاريخ البداية:</strong> {{ $contractPublic['start_date'] }}</div>
                    <div class="a4-line"><strong>تاريخ النهاية:</strong> {{ $contractPublic['end_date'] }}</div>
                    <div class="a4-separator"></div>
                    <div class="a4-body">
                        <p>بناءً على نظام العمل السعودي، تم الاتفاق بين الطرف الأول (الشركة) والطرف الثاني (الموظف) على ما يلي:</p>
                        <p><strong>١.</strong> يلتزم الطرف الثاني بأداء العمل المتفق عليه وفقاً للمعايير المهنية.</p>
                        <p><strong>٢.</strong> يستحق الطرف الثاني الراتب المتفق عليه مقابل أداء مهامه.</p>
                        <p><strong>٣.</strong> يلتزم الطرفان بأحكام نظام العمل السعودي فيما لم يرد بشأنه نص في هذا العقد.</p>
                        <p><strong>٤.</strong> يسري هذا العقد من التاريخ المحدد أعلاه ولمدة العقد المتفق عليها.</p>
                    </div>
                    <div class="a4-signatures">
                        <div><strong>الطرف الأول (الشركة)</strong><div class="sig-line"></div></div>
                        <div><strong>الطرف الثاني (الموظف)</strong><div class="sig-line"></div></div>
                    </div>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إغلاق</button>
                <button class="btn btn--outline" id="btnPrintContract" aria-label="طباعة">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"/></svg>
                    طباعة
                </button>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <div class="toast" id="toast" role="status" aria-live="polite">
        <svg class="toast__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <span class="toast__message" id="toastMessage"></span>
    </div>

</body>
</html>

