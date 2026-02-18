<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعذر فتح الرابط</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/public-employee-contract-link-invalid.css') }}">
</head>
<body>
    @php
        $reason = request('reason', 'expired');
        $reasons = [
            'expired' => ['title' => 'انتهت صلاحية الرابط', 'desc' => 'الرابط الذي استخدمته لم يعد صالحاً لأن مدة صلاحيته قد انتهت.', 'icon' => 'clock'],
            'invalid' => ['title' => 'الرابط غير صالح', 'desc' => 'الرابط الذي فتحته غير موجود أو تالف. تأكد من نسخ الرابط كاملاً.', 'icon' => 'x'],
            'used'    => ['title' => 'تم استخدام الرابط سابقاً', 'desc' => 'هذا الرابط تم استخدامه والتوقيع عليه مسبقاً ولا يمكن استخدامه مرة أخرى.', 'icon' => 'check'],
        ];
        $current = $reasons[$reason] ?? $reasons['expired'];
    @endphp

    <div class="invalid-page">

        {{-- Header --}}
        <header class="pub-header">
            <div class="pub-header__logo">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"><rect width="40" height="40" rx="10" fill="#2563eb"/><path d="M12 28V12h6l4 6 4-6h6v16h-5V18l-5 7-5-7v10h-5z" fill="#fff"/></svg>
                <div class="pub-header__brand">
                    <span class="pub-header__name">نظام إدارة الأمن</span>
                    <span class="pub-header__sub">Security Management System</span>
                </div>
            </div>
        </header>

        {{-- Status Card --}}
        <div class="status-card">
            {{-- Icon --}}
            @if($current['icon'] === 'clock')
            <div class="status-card__icon status-card__icon--warning">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd"/></svg>
            </div>
            @elseif($current['icon'] === 'x')
            <div class="status-card__icon status-card__icon--danger">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd"/></svg>
            </div>
            @else
            <div class="status-card__icon status-card__icon--muted">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
            </div>
            @endif

            <h1 class="status-card__title">{{ $current['title'] }}</h1>
            <p class="status-card__desc">{{ $current['desc'] }}</p>

            {{-- Reason Tabs (for demo) --}}
            <div class="reason-tabs">
                <a href="?reason=expired" class="reason-tab {{ $reason === 'expired' ? 'active' : '' }}">منتهي</a>
                <a href="?reason=invalid" class="reason-tab {{ $reason === 'invalid' ? 'active' : '' }}">غير صالح</a>
                <a href="?reason=used" class="reason-tab {{ $reason === 'used' ? 'active' : '' }}">مُستخدم</a>
            </div>
        </div>

        {{-- Info List --}}
        <div class="info-card">
            <h2 class="info-card__title">ماذا يمكنك فعله؟</h2>
            <ul class="info-list">
                <li>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#2563eb"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                    تأكد من أنك فتحت أحدث رسالة وصلتك.
                </li>
                <li>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#2563eb"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                    إذا استمرت المشكلة، تواصل مع الدعم الفني.
                </li>
                <li>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#2563eb"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                    يمكنك طلب رابط جديد من خلال زر "طلب رابط جديد".
                </li>
            </ul>
        </div>

        {{-- Actions --}}
        <div class="actions-card">
            <button class="btn btn--primary btn--full" id="btnTryAgain" aria-label="محاولة مرة أخرى">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg>
                محاولة مرة أخرى
            </button>
            <button class="btn btn--outline btn--full" id="btnRequestNewLink" aria-label="طلب رابط جديد">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"/></svg>
                طلب رابط جديد
            </button>
            <button class="btn btn--outline btn--full" id="btnContactSupport" aria-label="التواصل مع الدعم">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                التواصل مع الدعم
            </button>
            <a href="#" class="link-home" id="btnGoHome">العودة للصفحة الرئيسية</a>
        </div>

        {{-- Footer --}}
        <footer class="pub-footer">
            <p>© {{ date('Y') }} نظام إدارة الأمن. جميع الحقوق محفوظة.</p>
        </footer>
    </div>

    {{-- Modal: Request New Link --}}
    <div class="modal" id="requestLinkModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">طلب رابط جديد</h2>
                <button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
            </div>
            <div class="modal__body">
                <div class="form-group">
                    <label class="form-label">طريقة الاستلام</label>
                    <div class="channel-options">
                        <label class="channel-opt active"><input type="radio" name="linkChannel" value="whatsapp" checked><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> واتساب</label>
                        <label class="channel-opt"><input type="radio" name="linkChannel" value="email"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg> بريد إلكتروني</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" id="contactFieldLabel">رقم الجوال</label>
                    <input type="text" id="contactFieldInput" class="form-input" placeholder="05XXXXXXXX">
                </div>
                <p class="modal-note">قد يستغرق وصول الرابط عدة دقائق.</p>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="confirmRequestLink">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
                    إرسال الطلب
                </button>
            </div>
        </div>
    </div>

    {{-- Modal: Contact Support --}}
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
                            <span class="support-item__value" id="supportPhone">920012345</span>
                        </div>
                        <button class="btn btn--text btn--xs" data-copy="supportPhone" aria-label="نسخ رقم الهاتف">نسخ</button>
                    </div>
                    <div class="support-item">
                        <div class="support-item__icon"><svg width="24" height="24" viewBox="0 0 20 20" fill="#2563eb"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg></div>
                        <div class="support-item__info">
                            <span class="support-item__label">البريد الإلكتروني</span>
                            <span class="support-item__value" id="supportEmail">support@security.sa</span>
                        </div>
                        <button class="btn btn--text btn--xs" data-copy="supportEmail" aria-label="نسخ البريد">نسخ</button>
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

