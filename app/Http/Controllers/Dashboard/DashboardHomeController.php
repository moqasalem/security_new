<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DashboardHomeController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'login.required' => 'يرجى إدخال البريد الإلكتروني أو اسم المستخدم',
            'password.required' => 'يرجى إدخال كلمة المرور',
            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
        ]);

        $remember = $request->filled('remember');
        $loginField = $credentials['login'];

        // Attempt login with email
        if (filter_var($loginField, FILTER_VALIDATE_EMAIL)) {
            $attemptCredentials = [
                'email' => $loginField,
                'password' => $credentials['password']
            ];
        } else {
            // Attempt login with username (if you have username field)
            $attemptCredentials = [
                'name' => $loginField, // or 'username' if you have that field
                'password' => $credentials['password']
            ];
        }

        if (Auth::attempt($attemptCredentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')
                ->with('success', 'تم تسجيل الدخول بنجاح!');
        }

        // If authentication fails
        return back()->withErrors([
            'login' => 'بيانات الدخول غير صحيحة.',
        ])->withInput($request->only('login', 'remember'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
