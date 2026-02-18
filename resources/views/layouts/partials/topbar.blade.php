<header class="topbar">
    <div class="topbar__left">
        <label class="hamburger" for="sidebarToggle" aria-label="فتح/إغلاق القائمة">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>




    <div class="topbar__right">
        <!-- Notifications -->
        <div class="topbar__item">
            <a href="{{ route('notifications') }}" class="icon-btn" aria-label="الإشعارات">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
                <span class="badge">3</span>
            </a>
        </div>

        <!-- User Menu -->
        <div class="topbar__item">
            <details class="dropdown" id="userDropdown">
                <summary class="dropdown-toggle user-toggle">
                    <div class="user-avatar">{{ mb_substr(Auth::user()->name ?? 'م', 0, 1) }}</div>
                    <span class="user-name">{{ Auth::user()->name ?? 'مستخدم' }}</span>
                    <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor" class="dropdown-arrow">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </summary>
                <div class="dropdown-menu">
                    <a href="{{ route('profile') }}" class="dropdown-item">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        الملف الشخصي
                    </a>
                    <a href="{{ route('settings') }}" class="dropdown-item">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd" />
                        </svg>
                        الإعدادات
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                clip-rule="evenodd" />
                        </svg>
                        تسجيل الخروج
                    </a>
                </div>
            </details>
        </div>
    </div>
</header>
