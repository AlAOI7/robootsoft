<!DOCTYPE html>
<html lang="ar" dir="rtl" data-admin-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم') | Robotsoft ERP</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/admin-style.css') }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/logo.jpeg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="admin-sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                <img src="{{ asset('assets/logo.jpeg') }}" alt="Robotsoft Logo">
                <span>Robotsoft ERP</span>
            </a>
        </div>

        <nav class="sidebar-menu">
            <div class="sidebar-section-label">الرئيسية</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie menu-icon"></i>
                <span class="menu-text">لوحة التحكم</span>
            </a>

            <div class="sidebar-section-label">إدارة المحتوى</div>
            <a href="{{ route('admin.services.index') }}" class="menu-item {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                <i class="fas fa-cubes menu-icon"></i>
                <span class="menu-text">الخدمات</span>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="menu-item {{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
                <i class="fas fa-briefcase menu-icon"></i>
                <span class="menu-text">المشاريع</span>
            </a>
            <a href="{{ route('admin.clients.index') }}" class="menu-item {{ request()->routeIs('admin.clients*') ? 'active' : '' }}">
                <i class="fas fa-handshake menu-icon"></i>
                <span class="menu-text">العملاء</span>
            </a>
            <a href="{{ route('admin.blog.index') }}" class="menu-item {{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
                <i class="fas fa-newspaper menu-icon"></i>
                <span class="menu-text">المدونة</span>
            </a>

            <div class="sidebar-section-label">الطلبات والمراسلات</div>
            @php
                $unreadMessagesCount = \App\Models\ContactMessage::where('is_read', false)->count();
                $pendingRequestsCount = \App\Models\ServiceRequest::where('status', 'جديد')->count();
            @endphp
            <a href="{{ route('admin.service-requests.index') }}" class="menu-item {{ request()->routeIs('admin.service-requests*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list menu-icon"></i>
                <span class="menu-text">طلبات الخدمات</span>
                @if($pendingRequestsCount > 0)
                    <span class="menu-badge">{{ $pendingRequestsCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.messages.index') }}" class="menu-item {{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
                <i class="fas fa-envelope menu-icon"></i>
                <span class="menu-text">رسائل التواصل</span>
                @if($unreadMessagesCount > 0)
                    <span class="menu-badge">{{ $unreadMessagesCount }}</span>
                @endif
            </a>

            <div class="sidebar-section-label">النظام</div>
            <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="fas fa-users-cog menu-icon"></i>
                <span class="menu-text">المستخدمين</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="menu-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="fas fa-sliders-h menu-icon"></i>
                <span class="menu-text">الإعدادات العامة</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" class="menu-item">
                <i class="fas fa-external-link-alt menu-icon"></i>
                <span class="menu-text">عرض الموقع</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-item" style="width: 100%; border: none; background: none; color: var(--danger);">
                    <i class="fas fa-sign-out-alt menu-icon"></i>
                    <span class="menu-text">تسجيل الخروج</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Layout -->
    <div class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <div class="header-left">
                <button class="action-btn" id="sidebar-toggle" title="طي القائمة الجانبية">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="header-search">
                    <i class="fas fa-search" style="color: var(--text-muted); margin-left: 8px;"></i>
                    <input type="text" placeholder="بحث سريع في النظام...">
                </div>
            </div>

            <div class="header-right">
                <!-- Theme Toggle -->
                <button class="theme-toggle" id="theme-toggle" title="تغيير المظهر">
                    <i class="fas fa-sun sun-icon"></i>
                    <i class="fas fa-moon moon-icon"></i>
                </button>

                <!-- Notifications -->
                <a href="{{ route('admin.messages.index') }}" class="action-btn" title="الرسائل">
                    <i class="fas fa-bell"></i>
                    @if($unreadMessagesCount > 0)
                        <span class="notification-dot"></span>
                    @endif
                </a>

                <!-- User Profile -->
                <div class="user-profile" id="user-profile-btn">
                    <img src="{{ asset('assets/logo.jpeg') }}" alt="{{ auth()->user()->name ?? 'Admin' }}">
                    <div class="user-info">
                        <span class="user-name">{{ auth()->user()->name ?? 'المدير العام' }}</span>
                        <span class="user-role">{{ auth()->user()->role === 'admin' ? 'مدير النظام' : 'مشرف' }}</span>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 0.75rem; color: var(--text-muted); margin-right: 4px;"></i>

                    <!-- Dropdown -->
                    <div class="user-dropdown" id="user-dropdown">
                        <a href="{{ route('admin.users.index') }}" class="dropdown-item">
                            <i class="fas fa-user-edit"></i> الحساب الشخصي
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="dropdown-item">
                            <i class="fas fa-cog"></i> الإعدادات
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item" style="color: var(--danger);">
                                <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="admin-content">
            @if(session('success'))
                <div class="flash-alert flash-alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="flash-alert flash-alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="flash-alert flash-alert-danger">
                    <i class="fas fa-times-circle"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admin-assets/js/admin-main.js') }}"></script>
    @stack('scripts')
</body>
</html>
