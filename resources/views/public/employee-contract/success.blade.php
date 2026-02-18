<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم توقيع العقد بنجاح</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/public-employee-contract-success.css') }}">
</head>
<body>
    @php
        $signedInfo = [
            'contract_number' => 'EC-2025-001',
            'employee_name' => 'عبدالله محمد الحربي',
            'signed_at' => '2025-03-01 14:32:00',
            'reference_code' => 'REF-M2X9K7PQ',
        ];
    @endphp

    <div class="success-page">

        {{-- Header --}}
        <header class="pub-header">
            <div class="pub-header__logo">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"><rect width="40" height="40" rx="10" fill="#2563eb"/><path d="M12 28V12h6l4 6 4-6h6v16h-5V18l-5 7-5-7v10h-5z" fill="#fff"/></svg>
                <div class="pub-header__brand">
                    <span class="pub-header__name">نظام إدارة الأمن</span>
                    <span class="pub-header__sub">Security Management System</span>
                </div>
            </div>
            <h1 class="pub-header__title">تم توقيع العقد بنجاح</h1>
            <p class="pub-header__desc">شكراً لك. يمكنك الآن تنزيل نسخة من العقد أو طباعتها.</p>
        </header>

        {{-- Success Card --}}
        <div class="success-card print-area">
            <div class="success-card__icon">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                    <circle cx="40" cy="40" r="40" fill="#dcfce7"/>
                    <circle cx="40" cy="40" r="30" fill="#bbf7d0"/>
                    <path d="M24 40l10 10 22-22" stroke="#16a34a" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <span class="status-badge">موقّع</span>

            <div class="success-details">
                <div class="detail-row">
                    <span class="detail-label">رقم العقد</span>
                    <span class="detail-value">{{ $signedInfo['contract_number'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">اسم الموظف</span>
                    <span class="detail-value">{{ $signedInfo['employee_name'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">وقت التوقيع</span>
                    <span class="detail-value" id="signedTimeDisplay">{{ $signedInfo['signed_at'] }}</span>
                </div>
            </div>

            <div class="ref-box">
                <span class="ref-box__label">الرقم المرجعي</span>
                <span class="ref-box__value" id="referenceCode">{{ $signedInfo['reference_code'] }}</span>
            </div>
        </div>

        {{-- Primary Actions --}}
        <div class="actions-primary">
            <button class="btn btn--primary btn--full btn--lg" id="btnDownloadSignedPdf" aria-label="تنزيل نسخة PDF">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                تنزيل نسخة PDF
            </button>
            <div class="actions-row">
                <button class="btn btn--outline btn--half" id="btnPrintSigned" aria-label="طباعة">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"/></svg>
                    طباعة
                </button>
                <button class="btn btn--outline btn--half" id="btnCopyReference" aria-label="نسخ الرقم المرجعي">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"/><path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"/></svg>
                    نسخ المرجع
                </button>
            </div>
        </div>

        {{-- Secondary Cards --}}
        <div class="secondary-cards">
            <div class="sec-card">
                <div class="sec-card__header">
                    <svg width="24" height="24" viewBox="0 0 20 20" fill="#2563eb"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
                    <h3>إرسال نسخة</h3>
                </div>
                <p class="sec-card__desc">أرسل نسخة من العقد الموقّع إلى بريدك الإلكتروني أو واتساب.</p>
                <button class="btn btn--outline btn--full" id="btnSendCopy" aria-label="إرسال نسخة">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
                    إرسال نسخة
                </button>
                <p class="sec-card__note">قد تستغرق عملية الإرسال بضع دقائق.</p>
            </div>
            <div class="sec-card">
                <div class="sec-card__header">
                    <svg width="24" height="24" viewBox="0 0 20 20" fill="#2563eb"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                    <h3>هل تحتاج مساعدة؟</h3>
                </div>
                <p class="sec-card__desc">إذا كانت لديك أي استفسارات حول العقد أو التوقيع، لا تتردد في التواصل معنا.</p>
                <button class="btn btn--outline btn--full" id="btnOpenHelp" aria-label="التواصل مع الدعم">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                    التواصل مع الدعم
                </button>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="pub-footer">
            <a href="#" class="footer-link" id="btnGoHome">العودة للصفحة الرئيسية</a>
            <p>© {{ date('Y') }} نظام إدارة الأمن. جميع الحقوق محفوظة.</p>
        </footer>
    </div>

    {{-- Modal: Send Copy --}}
    <div class="modal" id="sendCopyModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">إرسال نسخة من العقد</h2>
                <button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
            </div>
            <div class="modal__body">
                <div class="form-group">
                    <label class="form-label">قناة الإرسال</label>
                    <div class="channel-options">
                        <label class="channel-opt active">
                            <input type="radio" name="copyChannel" value="email" checked>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            بريد إلكتروني
                        </label>
                        <label class="channel-opt">
                            <input type="radio" name="copyChannel" value="whatsapp">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            واتساب
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" id="sendFieldLabel">البريد الإلكتروني</label>
                    <input type="email" id="sendFieldInput" class="form-input" placeholder="example@email.com">
                </div>
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="sendAdminCopy">
                        إرسال نسخة للإدارة
                    </label>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="confirmSendCopy">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
                    إرسال
                </button>
            </div>
        </div>
    </div>

    {{-- Modal: Support --}}
    <div class="modal" id="supportModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">التواصل مع الدعم</h2>
                <button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
            </div>
            <div class="modal__body">
                <div class="support-items">
                    <div class="support-item">
                        <div class="support-item__icon"><svg width="24" height="24" viewBox="0 0 20 20" fill="#2563eb"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg></div>
                        <div class="support-item__info">
                            <span class="support-item__label">الهاتف</span>
                            <span class="support-item__value" id="helpPhone">920012345</span>
                        </div>
                        <button class="btn btn--text btn--xs" data-copy="helpPhone" aria-label="نسخ الهاتف">نسخ</button>
                    </div>
                    <div class="support-item">
                        <div class="support-item__icon"><svg width="24" height="24" viewBox="0 0 20 20" fill="#2563eb"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg></div>
                        <div class="support-item__info">
                            <span class="support-item__label">البريد الإلكتروني</span>
                            <span class="support-item__value" id="helpEmail">support@security.sa</span>
                        </div>
                        <button class="btn btn--text btn--xs" data-copy="helpEmail" aria-label="نسخ البريد">نسخ</button>
                    </div>
                    <div class="support-item">
                        <div class="support-item__icon"><svg width="24" height="24" viewBox="0 0 20 20" fill="#2563eb"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg></div>
                        <div class="support-item__info">
                            <span class="support-item__label">ساعات العمل</span>
                            <span class="support-item__value">الأحد - الخميس: 8 ص - 5 م</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline btn--full modal__close">إغلاق</button>
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

