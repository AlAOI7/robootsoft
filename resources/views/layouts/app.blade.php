<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Robotsoft ERP | حلول ذكية لإدارة المال والأعمال والتطبيقات')</title>
    <meta name="description" content="@yield('meta_description', 'شركة Robotsoft ERP تقدم أنظمة سحابية ومحلية متكاملة للمحاسبة والمخازن والموارد البشرية ونقاط البيع وحلول التحول الرقمي للشركات الكبرى والمتوسطة.')">
    <meta name="keywords" content="ERP, نظام محاسبي, إدارة المستودعات, الموارد البشرية, نقاط البيع, CRM, التحول الرقمي, أرشفة إلكترونية, Robotsoft, روبوت سوفت">
    <meta name="author" content="Robotsoft ERP">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Metadata -->
    <meta property="og:title" content="@yield('title', 'Robotsoft ERP | حلول ذكية لإدارة المال والأعمال')">
    <meta property="og:description" content="@yield('meta_description', 'أنظمة إدارة موارد المؤسسات المتكاملة للتحول الرقمي والأعمال.')">
    <meta property="og:type" content="website">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/logo.jpeg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body>

    <!-- Loading Screen -->
    <div id="loader">
        <div class="loader-logo">
            <div class="loader-circle"></div>
            <div class="loader-circle-inner"></div>
            <img src="{{ asset('assets/logo.jpeg') }}" alt="Robotsoft Logo" class="loader-icon-img">
        </div>
        <h2 data-ar="روبوت سوفت للأنظمة" data-en="Robotsoft Systems" style="font-weight: 800; font-size: 1.5rem; letter-spacing: 1px; color: var(--primary);">روبوت سوفت للأنظمة</h2>
        <div class="loader-bar-container">
            <div class="loader-bar"></div>
        </div>
    </div>

    <!-- Header & Navigation -->
    <header class="header">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('assets/logo.jpeg') }}" alt="Robotsoft Logo" class="logo-img">
                <span data-ar="روبوت سوفت" data-en="Robotsoft ERP">روبوت سوفت</span>
            </a>
            
            <nav class="nav-menu">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" data-ar="الرئيسية" data-en="Home">الرئيسية</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" data-ar="من نحن" data-en="About">من نحن</a>
                <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services*') ? 'active' : '' }}" data-ar="الخدمات" data-en="Services">الخدمات</a>
                <a href="{{ route('projects') }}" class="nav-link {{ request()->routeIs('projects*') ? 'active' : '' }}" data-ar="المشاريع" data-en="Projects">المشاريع</a>
                <a href="{{ route('clients') }}" class="nav-link {{ request()->routeIs('clients*') ? 'active' : '' }}" data-ar="العملاء" data-en="Clients">العملاء</a>
                <a href="{{ route('blog') }}" class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}" data-ar="المدونة" data-en="Blog">المدونة</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" data-ar="اتصل بنا" data-en="Contact">اتصل بنا</a>
            </nav>

            <div class="nav-controls">
                <button class="control-btn" id="theme-toggle" title="تغيير المظهر">
                    <svg class="sun-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                    <svg class="moon-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>
                <button class="control-btn" id="lang-toggle" title="تغيير اللغة">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 11.37 7.363 16.5 3 19"></path></svg>
                </button>

                @auth
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
                        <a href="{{ route('admin.dashboard') }}" class="nav-cta" style="background:linear-gradient(135deg,#7c3aed,#2563eb);">لوحة الإدارة</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="control-btn" title="تسجيل الخروج"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="control-btn" title="تسجيل الدخول"><i class="fas fa-user"></i></a>
                    <a href="{{ route('request-service') }}" class="nav-cta" data-ar="طلب خدمة" data-en="Request Service">طلب خدمة</a>
                @endauth

                <button class="menu-toggle" id="menu-toggle" aria-label="Toggle Navigation">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </header>

    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.9); color: #fff; padding: 1rem; text-align: center; font-weight: 700; position: sticky; top: 70px; z-index: 999; backdrop-filter: blur(10px);">
            <i class="fas fa-check-circle" style="margin-left: 8px;"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: rgba(239, 68, 68, 0.9); color: #fff; padding: 1rem; text-align: center; font-weight: 700; position: sticky; top: 70px; z-index: 999; backdrop-filter: blur(10px);">
            <i class="fas fa-exclamation-circle" style="margin-left: 8px;"></i> {{ session('error') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-grid">
            <div class="footer-logo-panel">
                <a href="{{ route('home') }}" class="logo" style="margin-bottom:1rem;">
                    <img src="{{ asset('assets/logo.jpeg') }}" alt="Robotsoft Logo" class="logo-img">
                    <span data-ar="روبوت سوفت" data-en="Robotsoft ERP">روبوت سوفت</span>
                </a>
                <p data-ar="شريكك التقني الموثوق نحو التحول الرقمي الشامل وحلول تخطيط الموارد المتطورة." data-en="Your trusted technology partner for digital transformation and advanced ERP systems.">
                    شريكك التقني الموثوق نحو التحول الرقمي الشامل وحلول تخطيط الموارد المتطورة.
                </p>
                <div style="margin-top: 1rem; display: flex; gap: 10px;">
                    <a href="{{ \App\Models\Setting::get('twitter', 'https://twitter.com') }}" target="_blank" class="control-btn"><i class="fab fa-twitter"></i></a>
                    <a href="{{ \App\Models\Setting::get('linkedin', 'https://linkedin.com') }}" target="_blank" class="control-btn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="{{ \App\Models\Setting::get('facebook', 'https://facebook.com') }}" target="_blank" class="control-btn"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>

            <div class="footer-nav-panel">
                <h4 data-ar="روابط سريعة" data-en="Quick Links">روابط سريعة</h4>
                <ul class="footer-list">
                    <li><a href="{{ route('home') }}" data-ar="الرئيسية" data-en="Home">الرئيسية</a></li>
                    <li><a href="{{ route('about') }}" data-ar="من نحن" data-en="About">من نحن</a></li>
                    <li><a href="{{ route('projects') }}" data-ar="المشاريع" data-en="Projects">المشاريع</a></li>
                    <li><a href="{{ route('clients') }}" data-ar="العملاء" data-en="Clients">العملاء</a></li>
                    <li><a href="{{ route('faq') }}" data-ar="الأسئلة الشائعة" data-en="FAQ">الأسئلة الشائعة</a></li>
                    <li><a href="{{ route('privacy') }}" data-ar="سياسة الخصوصية" data-en="Privacy">سياسة الخصوصية</a></li>
                </ul>
            </div>

            <div class="footer-nav-panel">
                <h4 data-ar="الخدمات الرئيسية" data-en="Our Services">الخدمات الرئيسية</h4>
                <ul class="footer-list">
                    <li><a href="{{ route('services') }}" data-ar="الاستشارات التقنية" data-en="Consulting">الاستشارات التقنية</a></li>
                    <li><a href="{{ route('services') }}" data-ar="التركيب والتهيئة" data-en="Installation">التركيب والتهيئة</a></li>
                    <li><a href="{{ route('services') }}" data-ar="التطوير والتخصيص" data-en="Development">التطوير والتخصيص</a></li>
                    <li><a href="{{ route('services') }}" data-ar="التدريب والتأهيل" data-en="Training">التدريب والتأهيل</a></li>
                    <li><a href="{{ route('services') }}" data-ar="الدعم الفني 24/7" data-en="Support">الدعم الفني 24/7</a></li>
                </ul>
            </div>

            <div class="footer-newsletter-panel">
                <h4 data-ar="معلومات التواصل" data-en="Contact Info">معلومات التواصل</h4>
                <p style="margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt" style="margin-left: 6px; color: var(--primary);"></i> {{ \App\Models\Setting::get('address', 'الرياض، المملكة العربية السعودية') }}</p>
                <p style="margin-bottom: 0.5rem;"><i class="fas fa-phone" style="margin-left: 6px; color: var(--primary);"></i> {{ \App\Models\Setting::get('contact_phone', '+966 50 123 4567') }}</p>
                <p style="margin-bottom: 1rem;"><i class="fas fa-envelope" style="margin-left: 6px; color: var(--primary);"></i> {{ \App\Models\Setting::get('contact_email', 'info@robotsoft.com') }}</p>
                <a href="{{ route('contact') }}" class="btn btn-primary" style="display:inline-block; padding: 0.5rem 1rem; border-radius: 8px;">تواصل معنا الآن</a>
            </div>
        </div>

        <div class="container footer-bottom">
            <span data-ar="© {{ date('Y') }} Robotsoft ERP. جميع الحقوق محفوظة." data-en="© {{ date('Y') }} Robotsoft ERP. All rights reserved.">
                © {{ date('Y') }} Robotsoft ERP. جميع الحقوق محفوظة.
            </span>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <div class="back-to-top-btn" id="back-to-top" title="الرجوع للأعلى">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"></path></svg>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
