@extends('layouts.app')

@section('title', 'Robotsoft ERP | حلول ذكية لإدارة المال والأعمال والتطبيقات')

@section('content')
    <!-- Main Hero Section -->
    <section class="hero-wrapper">
        <canvas id="hero-canvas"></canvas>
        <div class="container hero-container">
            <div class="hero-content reveal">
                <div class="hero-tag">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 113.536 0V21h2v-2.243a5 5 0 013.536 0V21h-2v-1"></path></svg>
                    <span data-ar="الجيل الجديد من أنظمة الـ ERP" data-en="Next-Generation Intelligent ERP Systems">الجيل الجديد من أنظمة الـ ERP</span>
                </div>
                <h1 class="hero-title">
                    <span data-ar="Robotsoft ERP" data-en="Robotsoft ERP">Robotsoft ERP</span>
                    <span data-ar="حلول ذكية لإدارة" data-en="Smart Solutions for">حلول ذكية لإدارة</span>
                    <span id="typing-text" style="color: var(--primary);">المؤسسات والشركات</span>
                </h1>
                <p class="hero-desc" data-ar="منظومة متكاملة لربط وأتمتة العمليات المالية، الموارد البشرية، المبيعات، والخدمات اللوجستية في منصة موحدة فائقة الأداء لتسريع نمو أعمالك وتحقيق التحول الرقمي الشامل." data-en="A highly integrated platform to coordinate and automate your financial records, human capital, distributions, and operations inside a single, world-class database built for expansion.">
                    منظومة متكاملة لربط وأتمتة العمليات المالية، الموارد البشرية، المبيعات، والخدمات اللوجستية في منصة موحدة فائقة الأداء لتسريع نمو أعمالك وتحقيق التحول الرقمي الشامل.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('request-service') }}" class="btn btn-primary">
                        <span data-ar="اطلب نسختك الآن" data-en="Request System">اطلب نسختك الآن</span>
                    </a>
                    <a href="#systems" class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <span data-ar="مشاهدة الأنظمة" data-en="Explore Modules">مشاهدة الأنظمة</span>
                    </a>
                </div>
                
                <!-- Counter Numbers -->
                <div class="hero-stats">
                    <div class="stat-card">
                        <div class="stat-number" data-target="1500" data-suffix="+">1500+</div>
                        <div class="stat-label" data-ar="مستخدم نشط" data-en="Active Users">مستخدم نشط</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" data-target="250" data-suffix="+">250+</div>
                        <div class="stat-label" data-ar="منشأة شريكة" data-en="Corporate Partners">منشأة شريكة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" data-target="99" data-suffix="%">99.8%</div>
                        <div class="stat-label" data-ar="استقرار النظام" data-en="Uptime SLA">استقرار النظام</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" data-target="100" data-suffix="%">100%</div>
                        <div class="stat-label" data-ar="توافق مع ZATCA" data-en="ZATCA Compliance">توافق مع ZATCA</div>
                    </div>
                </div>
            </div>
            
            <div class="hero-visual reveal">
                <div class="visual-bg-glow"></div>
                <div class="visual-card">
                    <img src="{{ asset('assets/hero_dashboard.png') }}" alt="Robotsoft BI Dashboard" style="border-radius: 12px; width: 100%; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                </div>
            </div>
        </div>
    </section>

    <!-- Systems Catalog Grid -->
    <section class="section" id="systems">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-tag" data-ar="تطبيقات متكاملة" data-en="Integrated Modules">تطبيقات متكاملة</span>
                <h2 class="section-title"><span data-ar="منظومة تطبيقات" data-en="Modular Systems Designed">منظومة تطبيقات</span> <span data-ar="Robotsoft ERP" data-en="for Modern Scale">Robotsoft ERP</span></h2>
                <p class="section-desc" data-ar="أنظمة مستقلة ولكنها مترابطة بشكل مطلق لتنظيم أعمالك ورفع كفاءة عملياتك في مختلف القطاعات." data-en="Stand-alone applications that function perfectly together, enabling you to coordinate and audit various components of your enterprise.">
                    أنظمة مستقلة ولكنها مترابطة بشكل مطلق لتنظيم أعمالك ورفع كفاءة عملياتك في مختلف القطاعات.
                </p>
            </div>
            
            <div class="systems-grid">
                <!-- Accounting -->
                <div class="system-card reveal">
                    <div class="system-card-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="system-card-title">النظام المحاسبي والمالي</h3>
                    <p class="system-card-desc">إدارة الحسابات العامة وضرائب القيمة المضافة ومطابقات البنوك مع ربط ZATCA للمرحلة الثانية بدقة فائقة.</p>
                </div>

                <!-- Sales -->
                <div class="system-card reveal">
                    <div class="system-card-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="system-card-title">إدارة المبيعات والعملاء</h3>
                    <p class="system-card-desc">أتمتة عروض الأسعار وفواتير العملاء وصلاحيات الائتمان وتتبع عمولات مندوبي المبيعات لحظة بلحظة.</p>
                </div>

                <!-- Purchases -->
                <div class="system-card reveal">
                    <div class="system-card-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="system-card-title">إدارة المشتريات والموردين</h3>
                    <p class="system-card-desc">إدارة مقارنات عروض أسعار الموردين، أوامر الشراء، الدفعات، وأرصدة الموردين الدائنة بسلاسة.</p>
                </div>

                <!-- Inventory -->
                <div class="system-card reveal">
                    <div class="system-card-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="system-card-title">إدارة المخازن والمستودعات</h3>
                    <p class="system-card-desc">تتبع الأصناف، متوسطات التكلفة، الجرد بالباركود، التحويل بين المستودعات بمرونة وأمان كامل.</p>
                </div>

                <!-- HR -->
                <div class="system-card reveal">
                    <div class="system-card-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="system-card-title">الموارد البشرية وشؤون الموظفين</h3>
                    <p class="system-card-desc">مسيرات الرواتب المتوافقة مع نظام حماية الأجور، متابعة الإجازات، التأمينات والتقييم الدوري.</p>
                </div>

                <!-- POS -->
                <div class="system-card reveal">
                    <div class="system-card-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="system-card-title">نقاط البيع السحابية POS</h3>
                    <p class="system-card-desc">واجهات كاشير سريعة تعمل دون انقطاع، ربط أجهزة الباركود والموازين والطابعات الحرارية.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Dynamic Section -->
    <section class="section section-bg-alt">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-tag" data-ar="خدماتنا التقنية" data-en="Our Services">خدماتنا التقنية</span>
                <h2 class="section-title">خدمات متكاملة <span>لدعم نجاحك</span></h2>
                <p class="section-desc">من التخطيط والاستشارة وحتى التدريب والدعم المستمر على مدار الساعة.</p>
            </div>

            <div class="features-grid">
                @foreach($services as $service)
                    <div class="feature-card reveal">
                        <div class="feature-icon-wrapper">
                            <i class="{{ $service->icon ?? 'fas fa-check-circle' }}" style="font-size: 24px; color: var(--primary);"></i>
                        </div>
                        <h3 class="feature-title">{{ $service->title }}</h3>
                        <p class="feature-desc">{{ $service->description }}</p>
                        @if(!empty($service->features))
                            <ul style="list-style: none; padding: 0; margin-top: 1rem; font-size: 0.85rem; color: var(--text-secondary);">
                                @foreach(array_slice($service->features, 0, 3) as $feat)
                                    <li style="margin-bottom: 0.4rem;"><i class="fas fa-check" style="color: var(--primary); margin-left: 6px;"></i> {{ $feat }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>

            <div style="text-align: center; margin-top: 2.5rem;">
                <a href="{{ route('services') }}" class="btn btn-primary">عرض جميع الخدمات</a>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="section">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-tag">قصص النجاح</span>
                <h2 class="section-title">مشاريع <span>نفخر بإنجازها</span></h2>
                <p class="section-desc">نماذج من أعمالنا وتطبيق أنظمتنا لدى كبرى الشركات والمؤسسات.</p>
            </div>

            <div class="portfolio-grid">
                @foreach($projects as $project)
                    <div class="portfolio-card reveal">
                        <div class="portfolio-img-wrapper" style="background: linear-gradient(135deg, #1e3a8a, #0d9488); display:flex; align-items:center; justify-content:center; height: 180px;">
                            <i class="fas fa-layer-group" style="font-size: 54px; color: rgba(255,255,255,0.7);"></i>
                        </div>
                        <div class="portfolio-info" style="padding: 1.5rem;">
                            <span class="badge badge-primary" style="margin-bottom: 0.5rem;">{{ strtoupper($project->category ?? 'ERP') }}</span>
                            <h3 class="portfolio-title">{{ $project->title }}</h3>
                            <p class="portfolio-desc">{{ Str::limit($project->description, 110) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="text-align: center; margin-top: 2.5rem;">
                <a href="{{ route('projects') }}" class="btn btn-secondary">تصفح معرض المشاريع</a>
            </div>
        </div>
    </section>

    <!-- Clients / Testimonials Section -->
    <section class="section section-bg-alt">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-tag">شركاء النجاح</span>
                <h2 class="section-title">عملاء <span>يثقون بروبوت سوفت</span></h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
                @foreach($clients as $client)
                    <div class="feature-card reveal" style="padding: 1.5rem; border-radius: 12px; background: var(--bg-card);">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1rem;">
                            <img src="{{ asset('assets/logo.jpeg') }}" alt="{{ $client->name }}" style="width: 44px; height: 44px; border-radius: 50%;">
                            <div>
                                <h4 style="font-weight: 700; margin: 0; font-size: 1rem;">{{ $client->name }}</h4>
                                <span style="font-size: 0.8rem; color: var(--text-muted);">{{ $client->industry ?? 'شريك استراتيجي' }}</span>
                            </div>
                        </div>
                        <p style="font-size: 0.9rem; color: var(--text-secondary); font-style: italic;">"{{ $client->testimonial }}"</p>
                        <div style="color: #f59e0b; margin-top: 0.75rem;">
                            @for($i = 0; $i < ($client->rating ?? 5); $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section class="section">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-tag">المدونة التقنية</span>
                <h2 class="section-title">أحدث <span>المقالات والتحليلات</span></h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
                @foreach($posts as $post)
                    <div class="feature-card reveal" style="padding: 0; overflow: hidden; border-radius: 12px; background: var(--bg-card);">
                        <div style="background: linear-gradient(135deg, #2563eb, #1e293b); height: 160px; display:flex; align-items:center; justify-content:center;">
                            <i class="fas fa-newspaper" style="font-size: 48px; color: rgba(255,255,255,0.6);"></i>
                        </div>
                        <div style="padding: 1.5rem;">
                            <span class="badge badge-info" style="margin-bottom: 0.5rem;">{{ $post->category }}</span>
                            <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 0.5rem;">
                                <a href="{{ route('blog.single', $post->slug) }}" style="color: var(--text-primary);">{{ $post->title }}</a>
                            </h3>
                            <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 1rem;">{{ Str::limit($post->summary, 120) }}</p>
                            <a href="{{ route('blog.single', $post->slug) }}" style="color: var(--primary); font-weight: 700; font-size: 0.85rem;">اقرأ المزيد ←</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section section-bg-alt" style="text-align: center;">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-tag">ابدأ اليوم</span>
                <h2 class="section-title">جاهز لإحداث نقلة نوعية في <span>إدارة أعمالك؟</span></h2>
                <p class="section-desc">تواصل معنا اليوم واحصل على استشارة مجانية وعرض تجريبي مخصص لاحتياجات مؤسستك.</p>
            </div>
            <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('request-service') }}" class="btn btn-primary" style="padding: 0.85rem 2rem; font-size: 1rem;">طلب عرض سعر مجاني</a>
                <a href="{{ route('contact') }}" class="btn btn-secondary" style="padding: 0.85rem 2rem; font-size: 1rem;">اتصل بفريق المبيعات</a>
            </div>
        </div>
    </section>
@endsection
