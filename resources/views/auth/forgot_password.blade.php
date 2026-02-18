<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>نسيت كلمة المرور - النظام الداخلي</title>
    
    <!-- Google Fonts - Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pages/auth-forgot-password.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <!-- Logo -->
            <div class="auth-card__logo">
                <div class="logo-placeholder">
                    <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="30" fill="#2563eb"/>
                        <path d="M30 20C27.239 20 25 22.239 25 25V27H23C21.895 27 21 27.895 21 29V38C21 39.105 21.895 40 23 40H37C38.105 40 39 39.105 39 38V29C39 27.895 38.105 27 37 27H35V25C35 22.239 32.761 20 30 20ZM30 22C31.657 22 33 23.343 33 25V27H27V25C27 23.343 28.343 22 30 22Z" fill="white"/>
                    </svg>
                </div>
            </div>

            <!-- Header -->
            <div class="auth-card__header">
                <h1 class="auth-card__title">نسيت كلمة المرور</h1>
                <p class="auth-card__subtitle">أدخل بريدك الإلكتروني وسنرسل لك رابطاً لإعادة تعيين كلمة المرور</p>
            </div>

            <!-- Success Message -->
            @if(session('status'))
                <div class="alert alert--success" role="alert">
                    <svg class="alert__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div class="alert__content">
                        {{ session('status') }}
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

            <!-- Info Alert -->
            <div class="alert alert--info" role="alert">
                <svg class="alert__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="alert__content">
                    قد يستغرق وصول البريد بضع دقائق، تحقق من مجلد الرسائل غير المرغوب فيها
                </div>
            </div>

            <!-- Forgot Password Form -->
            <form action="{{ route('password.email') }}" method="POST" class="auth-form" id="forgotPasswordForm">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <div class="form-input-wrapper">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input @error('email') form-input--error @enderror" 
                            value="{{ old('email') }}"
                            placeholder="أدخل بريدك الإلكتروني"
                            autocomplete="email"
                            required
                            autofocus
                        >
                        <button 
                            type="button" 
                            class="input-clear" 
                            id="clearEmail"
                            aria-label="مسح البريد الإلكتروني"
                            style="display: none;"
                        >
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Client-side email validation message -->
                    <span class="form-hint" id="emailHint" aria-live="polite" style="display: none;"></span>

                    @error('email')
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
                    <span class="btn__text" id="btnText">إرسال رابط الاستعادة</span>
                    <span class="btn__loader" id="btnLoader" style="display: none;">
                        <svg class="spinner" width="20" height="20" viewBox="0 0 50 50">
                            <circle class="spinner__path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                        </svg>
                        جارٍ الإرسال...
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

