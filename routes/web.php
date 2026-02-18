<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardHomeController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [DashboardHomeController::class, 'authenticate'])->name('login.post');

Route::post('/logout', [DashboardHomeController::class, 'logout'])->name('logout')->middleware('auth');


// Customer Quotation View (Public - No Auth)
Route::get('/quotations/{id}/customer-view', function ($id) {
    return view('quotations.customer-view');
})->name('quotations.customer-view');


// Public: Employee Contract Signing
Route::get('/employee-contracts/{id}/sign', function ($id) {
    return view('public.employee-contract.sign');
})->name('employee-contracts.sign');

// Public: Invalid/Expired Link
Route::get('/employee-contracts/link-invalid', function () {
    return view('public.employee-contract.link-invalid');
})->name('employee-contracts.link-invalid');

// Public: Signing Success
Route::get('/employee-contracts/success', function () {
    return view('public.employee-contract.success');
})->name('employee-contracts.success');

// Dashboard Routes (prefixed with /dashboard)
require __DIR__ . '/dashboard.php';
