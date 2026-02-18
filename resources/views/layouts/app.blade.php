<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'النظام الداخلي')</title>

    <!-- Google Fonts - Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Layout CSS (Shared) -->
    <link rel="stylesheet" href="{{ asset('css/layout/tokens.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/app-shell.css') }}">

    <!-- CSS-only interactivity -->
    <style>
        /* --- Sidebar toggle via checkbox --- */
        #sidebarToggle {
            display: none;
        }

        @media (min-width: 969px) {
            #sidebarToggle:checked~.app-main {
                margin-right: 70px;
            }

            #sidebarToggle:checked~.sidebar {
                width: 70px;
            }

            #sidebarToggle:checked~.sidebar .sidebar__text,
            #sidebarToggle:checked~.sidebar .logo__text,
            #sidebarToggle:checked~.sidebar .sidebar__help {
                display: none;
            }
        }

        @media (max-width: 968px) {
            .sidebar {
                transform: translateX(100%);
            }

            #sidebarToggle:checked~.sidebar {
                transform: translateX(0);
            }

            #sidebarToggle:checked~.sidebar-overlay {
                display: block;
                opacity: 1;
                pointer-events: auto;
            }
        }

        /* --- Details/summary dropdown --- */
        details>summary {
            list-style: none;
            cursor: pointer;
        }

        details>summary::-webkit-details-marker {
            display: none;
        }

        details>summary::marker {
            display: none;
        }

        details .dropdown-menu {
            display: none;
        }

        details[open] .dropdown-menu {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* --- Tabs via radio buttons --- */
        .tab-radio {
            display: none;
        }

        /* --- Flash messages auto-hide --- */
        .flash-toast {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 12px 24px;
            border-radius: 8px;
            color: #fff;
            z-index: 9999;
            animation: flashFade 4s ease forwards;
        }

        .flash-toast--success {
            background: #10b981;
        }

        .flash-toast--error {
            background: #ef4444;
        }

        @keyframes flashFade {

            0%,
            70% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
                pointer-events: none;
            }
        }

        /* --- Modal via details --- */
        .modal-details {
            position: relative;
            display: inline;
        }

        .modal-details[open] .modal {
            display: flex;
        }

        .modal-details[open] .modal__overlay {
            display: block;
        }
    </style>

    <!-- Page-specific styles -->
    @stack('styles')
</head>

<body class="app-shell">
    <!-- Flash Messages -->
    @if (session('success'))
        <div class="flash-toast flash-toast--success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="flash-toast flash-toast--error">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="flash-toast flash-toast--error">{{ $errors->first() }}</div>
    @endif

    <!-- Sidebar Toggle (CSS-only) -->
    <input type="checkbox" id="sidebarToggle">

    <!-- Sidebar Overlay (Mobile) -->
    <label class="sidebar-overlay" for="sidebarToggle" id="sidebarOverlay"></label>

    <!-- Sidebar -->
    @include('layouts.partials.sidebar')

    <!-- Main Wrapper -->
    <div class="app-main">
        <!-- Topbar -->
        @include('layouts.partials.topbar')

        <!-- Main Content Area -->
        <main class="app-content">
            @yield('content')
        </main>
    </div>

    <!-- Hidden logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- No external JS files - all interactions handled by CSS -->
    @stack('scripts')
</body>

</html>
