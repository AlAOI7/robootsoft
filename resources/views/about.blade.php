@extends('layouts.app')

@section('title', 'من نحن | Robotsoft ERP')
@section('meta_description', 'تعرف على قصة نجاح Robotsoft ERP وفريق العمل المتخصص في بناء حلول إدارة المؤسسات والتحول الرقمي.')

@section('content')
<section class="page-hero">
    <div class="container page-hero-container">
        <h1 class="page-hero-title reveal">من نحن</h1>
        <div class="page-hero-breadcrumbs">
            <a href="{{ route('home') }}">الرئيسية</a><span>/</span><span>من نحن</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem; align-items: center;">
            <div class="reveal">
                <span class="section-tag">رؤيتنا ورسالتنا</span>
                <h2 class="section-title">نبني أنظمة تقنية تصنع <span>الفارق الحقيقي</span> في مؤسستك</h2>
                <p style="color: var(--text-secondary); margin-bottom: 1.25rem; line-height: 1.8;">
                    تأسست Robotsoft لتكون الشريك الاستراتيجي الأول للشركات والمؤسسات الطامحة للريادة والتحول الرقمي الشامل. نبتكر ونطور أنظمة تخطيط موارد المؤسسات (ERP) بمعايير عالمية ولمسة محلية تفهم احتياجات السوق والأنظمة والتشريعات المحلية مثل متطلبات هيئة الزكاة والضريبة والجمارك (ZATCA).
                </p>
                <p style="color: var(--text-secondary); line-height: 1.8;">
                    نعتمد على تقنيات برمجية حديثة وبنية تحتية سحابية عالية الأمان لنضمن لك استقراراً تاماً وسرعة استجابة فائقة تدعم نمو أعمالك بلا قيود.
                </p>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1.5rem;">
                    <div style="background: var(--bg-card); padding: 1.25rem; border-radius: 8px; border: 1px solid var(--border-color);">
                        <h4 style="color: var(--primary); font-size: 1.5rem; font-weight: 800; margin-bottom: 0.25rem;">+10 أعوام</h4>
                        <span style="font-size: 0.85rem; color: var(--text-secondary);">خبرة متراكمة في قطاع تقنية المعلومات</span>
                    </div>
                    <div style="background: var(--bg-card); padding: 1.25rem; border-radius: 8px; border: 1px solid var(--border-color);">
                        <h4 style="color: var(--accent); font-size: 1.5rem; font-weight: 800; margin-bottom: 0.25rem;">24/7</h4>
                        <span style="font-size: 0.85rem; color: var(--text-secondary);">دعم فني واستشاري متواصل</span>
                    </div>
                </div>
            </div>

            <div class="reveal" style="text-align: center;">
                <img src="{{ asset('assets/about_team.png') }}" alt="فريق عمل روبوت سوفت" style="border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); width: 100%;">
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section section-bg-alt">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">قيمنا الجوهرية</span>
            <h2 class="section-title">المبادئ التي تقود <span>كل خطوة نخطوها</span></h2>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal">
                <div class="feature-icon-wrapper"><i class="fas fa-shield-alt" style="font-size: 24px; color: var(--primary);"></i></div>
                <h3 class="feature-title">الأمان والخصوصية</h3>
                <p class="feature-desc">تشفير متطور للبيانات ونسخ احتياطي متعدد الطبقات لحماية معلوماتك الحساسة ومطابقة المعايير القياسية.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon-wrapper"><i class="fas fa-bolt" style="font-size: 24px; color: var(--primary);"></i></div>
                <h3 class="feature-title">السرعة والأداء</h3>
                <p class="feature-desc">أنظمة مبنية لتحمل ملايين السجلات والعمليات اليومية دون أي تباطؤ بفضل معمارية برمجية متقدمة.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon-wrapper"><i class="fas fa-hands-helping" style="font-size: 24px; color: var(--primary);"></i></div>
                <h3 class="feature-title">الشراكة الدائمة</h3>
                <p class="feature-desc">لا ينتهي دورنا بتسليم النظام، بل نبقى بجانبك بالتدريب والتحسين المستمر لمواكبة تطور أعمالك.</p>
            </div>
        </div>
    </div>
</section>
@endsection
