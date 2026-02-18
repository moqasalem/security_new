<aside class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar__logo">
        <div class="logo">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                <circle cx="20" cy="20" r="20" fill="#2563eb" />
                <path d="M20 10L28 16V24L20 30L12 24V16L20 10Z" fill="white" />
            </svg>
            <span class="logo__text">النظام الداخلي</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sidebar__nav">
        <a href="{{ route('dashboard') }}" class="sidebar__link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <span class="sidebar__text">لوحة التحكم</span>
        </a>
        <a href="{{ route('branches') }}" class="sidebar__link {{ request()->routeIs('branches*') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                    clip-rule="evenodd" />
            </svg>
            <span class="sidebar__text">الفروع</span>
        </a>
        <a href="{{ route('customers') }}" class="sidebar__link {{ request()->routeIs('customers*') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <span class="sidebar__text">العملاء</span>
        </a>
        <a href="{{ route('quotations') }}"
            class="sidebar__link {{ request()->routeIs('quotations*') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                    clip-rule="evenodd" />
            </svg>
            <span class="sidebar__text">عروض الأسعار</span>
        </a>
        <a href="{{ route('approvals') }}" class="sidebar__link {{ request()->routeIs('approvals') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>
            <span class="sidebar__text">الاعتمادات</span>
        </a>
        <a href="{{ route('contracts') }}"
            class="sidebar__link {{ request()->routeIs('contracts*') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                    clip-rule="evenodd" />
            </svg>
            <span class="sidebar__text">العقود</span>
        </a>
        <a href="{{ route('employee-contracts') }}"
            class="sidebar__link {{ request()->routeIs('employee-contracts*') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
            </svg>
            <span class="sidebar__text">عقود الموظفين</span>
        </a>
        <a href="{{ route('tasks') }}" class="sidebar__link {{ request()->routeIs('tasks') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                <path fill-rule="evenodd"
                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                    clip-rule="evenodd" />
            </svg>
            <span class="sidebar__text">المهام</span>
        </a>
        <a href="{{ route('attendance') }}"
            class="sidebar__link {{ request()->routeIs('attendance') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                    clip-rule="evenodd" />
            </svg>
            <span class="sidebar__text">الحضور والانصراف</span>
        </a>
        <a href="{{ route('reports') }}" class="sidebar__link {{ request()->routeIs('reports') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
            </svg>
            <span class="sidebar__text">التقارير</span>
        </a>
        <a href="{{ route('users') }}" class="sidebar__link {{ request()->routeIs('users') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
            </svg>
            <span class="sidebar__text">المستخدمون</span>
        </a>
        <a href="{{ route('permissions') }}"
            class="sidebar__link {{ request()->routeIs('permissions') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                    clip-rule="evenodd" />
            </svg>
            <span class="sidebar__text">الصلاحيات</span>
        </a>
        <a href="{{ route('settings') }}"
            class="sidebar__link {{ request()->routeIs('settings') ? 'active' : '' }}">
            <svg class="sidebar__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                    clip-rule="evenodd" />
            </svg>
            <span class="sidebar__text">الإعدادات</span>
        </a>
    </nav>

    <!-- Help Card -->
    <div class="sidebar__help">
        <div class="help-card">
            <svg width="32" height="32" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                    clip-rule="evenodd" />
            </svg>
            <h4>تحتاج مساعدة؟</h4>
            <a href="#" class="help-link">مركز الدعم</a>
        </div>
    </div>
</aside>
