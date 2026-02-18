<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تعيين كلمة المرور - النظام الداخلي</title>
    
    <!-- Google Fonts - Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pages/auth-first-time-password.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <!-- Logo -->
            <div class="auth-card__logo">
                <div class="logo-placeholder">
                    <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="30" fill="#2563eb"/>
                        <path d="M35 27.5C35 24.4624 32.5376 22 29.5 22H23V38H29.5C32.5376 38 35 35.5376 35 32.5V27.5Z" fill="white"/>
                        <rect x="25" y="24" width="4" height="14" fill="#2563eb"/>
                    </svg>
                </div>
            </div>

            <!-- Header -->
            <div class="auth-card__header">
                <h1 class="auth-card__title">تعيين كلمة المرور</h1>
                <p class="auth-card__subtitle">يرجى إنشاء كلمة مرور جديدة لحسابك لمتابعة الدخول إلى النظام</p>
            </div>

            <!-- Success Message -->
            @if(session('success') || session('status'))
                <div class="alert alert--success" role="alert">
                    <svg class="alert__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div class="alert__content">
                        {{ session('success') ?? session('status') }}
                    </div>
                </div>
            @endif

            <!-- General Error Message -->
            @if(session('error') || $errors->any())
                <div class="alert alert--error" role="alert">
                    <svg class="alert__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div class="alert__content">
                        @if(session('error'))
                            {{ session('error') }}
                        @else
                            يوجد أخطاء في البيانات المدخلة. يرجى التحقق والمحاولة مرة أخرى.
                        @endif
                    </div>
                </div>
            @endif

            <!-- Password Requirements -->
            <div class="password-requirements">
                <h3 class="password-requirements__title">متطلبات كلمة المرور:</h3>
                <ul class="password-requirements__list">
                    <li class="requirement" data-requirement="length">
                        <svg class="requirement__icon" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        8 أحرف على الأقل
                    </li>
                    <li class="requirement" data-requirement="uppercase">
                        <svg class="requirement__icon" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        حرف كبير واحد على الأقل
                    </li>
                    <li class="requirement" data-requirement="number">
                        <svg class="requirement__icon" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        رقم واحد على الأقل
                    </li>
                    <li class="requirement" data-requirement="special">
                        <svg class="requirement__icon" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        رمز خاص واحد على الأقل (!@#$%^&*)
                    </li>
                </ul>
            </div>

            <!-- Password Setup Form -->
            <form action="{{ route('password.setup') }}" method="POST" class="auth-form" id="passwordForm">
                @csrf

                <!-- Hidden Fields -->
                <input type="hidden" name="token" value="{{ request('token') ?? $token ?? '' }}">
                <input type="hidden" name="email" value="{{ request('email') ?? $email ?? '' }}">

                <!-- New Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">كلمة المرور الجديدة</label>
                    <div class="form-input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input form-input--password @error('password') form-input--error @enderror" 
                            placeholder="أدخل كلمة المرور الجديدة"
                            autocomplete="new-password"
                            required
                            autofocus
                        >
                        <button 
                            type="button" 
                            class="password-toggle" 
                            data-target="password"
                            aria-label="إظهار/إخفاء كلمة المرور"
                        >
                            <svg class="password-toggle__icon password-toggle__icon--hide" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            <svg class="password-toggle__icon password-toggle__icon--show" width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/>
                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Password Strength Meter -->
                    <div class="password-strength" id="passwordStrength" style="display: none;">
                        <div class="password-strength__bar">
                            <div class="password-strength__fill" id="strengthBar"></div>
                        </div>
                        <span class="password-strength__text" id="strengthText">ضعيف</span>
                    </div>

                    @error('password')
                        <span class="form-error" data-server-error>
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                    <div class="form-input-wrapper">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="form-input form-input--password @error('password_confirmation') form-input--error @enderror" 
                            placeholder="أعد إدخال كلمة المرور"
                            autocomplete="new-password"
                            required
                        >
                        <button 
                            type="button" 
                            class="password-toggle" 
                            data-target="password_confirmation"
                            aria-label="إظهار/إخفاء تأكيد كلمة المرور"
                        >
                            <svg class="password-toggle__icon password-toggle__icon--hide" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            <svg class="password-toggle__icon password-toggle__icon--show" width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/>
                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Password Match Indicator -->
                    <span class="password-match" id="passwordMatch" aria-live="polite" style="display: none;"></span>

                    @error('password_confirmation')
                        <span class="form-error" data-server-error>
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn--primary btn--block" id="submitBtn">
                    <span class="btn__text" id="btnText">حفظ كلمة المرور</span>
                    <span class="btn__loader" id="btnLoader" style="display: none;">
                        <svg class="spinner" width="20" height="20" viewBox="0 0 50 50">
                            <circle class="spinner__path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                        </svg>
                        جارٍ الحفظ...
                    </span>
                </button>

                <!-- Back to Login Link -->
                <div class="form-footer">
                    @if(Route::has('login'))
                        <a href="{{ route('login') }}" class="link link--secondary">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                            </svg>
                            العودة لتسجيل الدخول
                        </a>
                    @else
                        <a href="#" class="link link--secondary">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                            </svg>
                            العودة لتسجيل الدخول
                        </a>
                    @endif
                </div>
            </form>

            <!-- Footer -->
            <div class="auth-card__footer">
                <p class="footer-text">© {{ date('Y') }} جميع الحقوق محفوظة</p>
            </div>
        </div>
    </div>

    <!-- Custom JS -->
</body>
</html>

