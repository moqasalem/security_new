<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardProfileController;
use App\Http\Controllers\Dashboard\DashboardBranchController;

Route::prefix('dashboard')->middleware('userMiddleware')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // Branches
    Route::get('/branches', [DashboardBranchController::class, 'index'])->name('branches');
    Route::get('/branches/{id}', [DashboardBranchController::class, 'show'])->name('branches.show');
    Route::post('/branches', [DashboardBranchController::class, 'store'])->name('branches.store');
    Route::put('/branches/{id}', [DashboardBranchController::class, 'update'])->name('branches.update');
    Route::patch('/branches/{id}/toggle-status', [DashboardBranchController::class, 'toggleStatus'])->name('branches.toggle-status');
    Route::post('/branches/{id}/assign-users', [DashboardBranchController::class, 'assignUsers'])->name('branches.assign-users');


    // Customers
    Route::get('/customers', function () {
        return view('customers.index');
    })->name('customers');

    Route::get('/customers/{id}', function ($id) {
        return view('customers.show');
    })->name('customers.show');

    // Quotations
    Route::get('/quotations', function () {
        return view('quotations.index');
    })->name('quotations');

    Route::get('/quotations/create', function () {
        return view('quotations.create');
    })->name('quotations.create');

    Route::get('/quotations/{id}', function ($id) {
        return view('quotations.show');
    })->name('quotations.show');

    Route::get('/quotations/{id}/edit', function ($id) {
        return view('quotations.edit');
    })->name('quotations.edit');

    // Item Templates
    Route::get('/item-templates', function () {
        return view('item-templates.index');
    })->name('item-templates');

    // Templates
    Route::get('/templates/quotation-print', function () {
        return view('templates.quotation-print');
    })->name('templates.quotation-print');

    // Approvals Inbox
    Route::get('/approvals', function () {
        return view('approvals.index');
    })->name('approvals');

    // Contracts
    Route::get('/contracts', function () {
        return view('contracts.index');
    })->name('contracts');

    Route::get('/contracts/{id}', function ($id) {
        return view('contracts.show');
    })->name('contracts.show');

    // Employee Contracts
    Route::get('/employee-contracts', function () {
        return view('employee-contracts.index');
    })->name('employee-contracts');

    Route::get('/employee-contracts/create', function () {
        return view('employee-contracts.create');
    })->name('employee-contracts.create');

    // Tasks
    Route::get('/tasks', function () {
        return view('tasks.index');
    })->name('tasks');

    // Attendance
    Route::get('/attendance', function () {
        return view('attendance.index');
    })->name('attendance');

    // Reports
    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports');

    // Users & Roles
    Route::get('/users', function () {
        return view('users.index');
    })->name('users');

    // Settings
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings');

    // Notifications
    Route::get('/notifications', function () {
        return view('notifications.index');
    })->name('notifications');

    // Profile
    Route::get('/profile', [DashboardProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [DashboardProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [DashboardProfileController::class, 'changePassword'])->name('profile.password');

});

