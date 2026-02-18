<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الدخول - النظام الداخلي</title>
    
    <!-- Google Fonts - Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pages/auth-login.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <!-- Logo -->
            <div class="auth-card__logo">
                <div class="logo-placeholder">
                    <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="30" fill="#2563eb"/>
                        <path d="M30 15C21.716 15 15 21.716 15 30C15 38.284 21.716 45 30 45C38.284 45 45 38.284 45 30C45 21.716 38.284 15 30 15ZM30 25C32.761 25 35 27.239 35 30C35 32.761 32.761 35 30 35C27.239 35 25 32.761 25 30C25 27.239 27.239 25 30 25Z" fill="white"/>
                    </svg>
                </div>
            </div>

            <!-- Header -->
            <div class="auth-card__header">
                <h1 class="auth-card__title">تسجيل الدخول</h1>
                <p class="auth-card__subtitle">أدخل بياناتك للوصول للنظام الداخلي</p>
            </div>

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

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert--success" role="alert">
                    <svg class="alert__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div class="alert__content">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="auth-form" id="loginForm">
                @csrf

                <!-- Login Field (Email/Username) -->
                <div class="form-group">
                    <label for="login" class="form-label">البريد الإلكتروني أو اسم المستخدم</label>
                    <input 
                        type="text" 
                        id="login" 
                        name="login" 
                        class="form-input @error('login') form-input--error @enderror" 
                        value="{{ old('login') }}"
                        placeholder="أدخل بريدك الإلكتروني أو اسم المستخدم"
                        autocomplete="username"
                        required
                        autofocus
                    >
                    @error('login')
                        <span class="form-error">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <div class="form-input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input form-input--password @error('password') form-input--error @enderror" 
                            placeholder="أدخل كلمة المرور"
                            autocomplete="current-password"
                            required
                        >
                        <button 
                            type="button" 
                            class="password-toggle" 
                            id="togglePassword"
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
                    @error('password')
                        <span class="form-error">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <div class="form-checkbox">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember" 
                            class="checkbox-input"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <label for="remember" class="checkbox-label">تذكرني</label>
                    </div>

                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link link--primary">نسيت كلمة المرور؟</a>
                    @else
                        <a href="#" class="link link--primary">نسيت كلمة المرور؟</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn--primary btn--block" id="submitBtn">
                    <span class="btn__text" id="btnText">تسجيل الدخول</span>
                    <span class="btn__loader" id="btnLoader" style="display: none;">
                        <svg class="spinner" width="20" height="20" viewBox="0 0 50 50">
                            <circle class="spinner__path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                        </svg>
                        جارٍ تسجيل الدخول...
                    </span>
                </button>
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

