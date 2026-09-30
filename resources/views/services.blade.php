@extends('layouts.app')

@section('title', 'خدماتنا | Robotsoft ERP')
@section('meta_description', 'تعرف على خدمات روبوت سوفت من الاستشارات والتهيئة والتطوير والتكامل مع ZATCA.')

@section('content')
<section class="page-hero">
    <div class="container page-hero-container">
        <h1 class="page-hero-title reveal">خدماتنا التقنية</h1>
        <div class="page-hero-breadcrumbs">
            <a href="{{ route('home') }}">الرئيسية</a><span>/</span><span>الخدمات</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">ما نقدمه</span>
            <h2 class="section-title">حلول متكاملة لتحقيق <span>التحول الرقمي الشامل</span></h2>
            <p class="section-desc">من الاستشارة الأولى وحتى ما بعد الإطلاق والتشغيل، نرافقك في كل خطوة لضمان أعلى عائد استثماري.</p>
        </div>

        <div class="features-grid">
            @forelse($services as $service)
                <div class="feature-card reveal">
                    <div class="feature-icon-wrapper">
                        <i class="{{ $service->icon ?? 'fas fa-cogs' }}" style="font-size: 26px; color: var(--primary);"></i>
                    </div>
                    <h3 class="feature-title">{{ $service->title }}</h3>
                    <p class="feature-desc">{{ $service->description }}</p>

                    @if(!empty($service->features))
                        <div style="margin-top: 1.25rem; border-top: 1px solid var(--border-color); padding-top: 1rem;">
                            <h5 style="font-size: 0.85rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-primary);">ما يشمله هذا الحل:</h5>
                            <ul style="list-style: none; padding: 0; margin: 0; font-size: 0.85rem; color: var(--text-secondary);">
                                @foreach($service->features as $item)
                                    <li style="margin-bottom: 0.4rem; display: flex; align-items: center; gap: 8px;">
                                        <i class="fas fa-check-circle" style="color: var(--success); font-size: 0.8rem;"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div style="margin-top: 1.5rem;">
                        <a href="{{ route('request-service') }}?service={{ urlencode($service->title) }}" class="btn btn-secondary btn-sm" style="width: 100%;">طلب هذه الخدمة</a>
                    </div>
                </div>
            @empty
                <div style="text-align: center; grid-column: 1 / -1; padding: 3rem;">
                    <p style="color: var(--text-muted);">لا توجد خدمات مضافة حالياً.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section section-bg-alt" style="text-align: center;">
    <div class="container">
        <h2 class="section-title">هل لديك متطلبات خاصة بنشاطك؟</h2>
        <p class="section-desc">فريقنا الهندسي مستعد لتصميم وتطوير وحدات برمجية مخصصة بالكامل لمنشأتك.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary" style="margin-top: 1rem;">تحدث مع مستشارنا الفني</a>
    </div>
</section>
@endsection
