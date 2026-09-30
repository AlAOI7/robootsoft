@extends('layouts.app')

@section('title', 'عملاؤنا | Robotsoft ERP')
@section('meta_description', 'شركاء النجاح وقصص التعاون المثمرة مع كبرى المؤسسات والشركات.')

@section('content')
<section class="page-hero">
    <div class="container page-hero-container">
        <h1 class="page-hero-title reveal">عملاؤنا وشركاء النجاح</h1>
        <div class="page-hero-breadcrumbs">
            <a href="{{ route('home') }}">الرئيسية</a><span>/</span><span>العملاء</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">شهادات نعتز بها</span>
            <h2 class="section-title">ماذا يقول <span>عملاؤنا عنا؟</span></h2>
            <p class="section-desc">فخورون بالثقة التي منحنا إياها مئات رواد الأعمال وقادة المنشآت في مختلف القطاعات.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
            @forelse($clients as $client)
                <div class="feature-card reveal" style="padding: 2rem; background: var(--bg-card); border-radius: 12px; box-shadow: var(--shadow-sm); display:flex; flex-direction:column; justify-content:space-between;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 1.25rem;">
                            <img src="{{ asset('assets/logo.jpeg') }}" alt="{{ $client->name }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            <div>
                                <h3 style="font-size: 1.1rem; font-weight: 700; margin: 0;">{{ $client->name }}</h3>
                                <span style="font-size: 0.82rem; color: var(--text-muted);">{{ $client->industry ?? 'شريك نجاح' }}</span>
                            </div>
                        </div>
                        <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7; font-style: italic;">
                            "{{ $client->testimonial }}"
                        </p>
                    </div>
                    <div style="margin-top: 1.5rem; display:flex; justify-content:space-between; align-items:center; border-top: 1px solid var(--border-color); padding-top: 1rem;">
                        <div style="color: #f59e0b;">
                            @for($i = 0; $i < ($client->rating ?? 5); $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <span class="badge badge-success">تقييم موثق</span>
                    </div>
                </div>
            @empty
                <div style="text-align: center; grid-column: 1 / -1; padding: 4rem;">
                    <p style="color: var(--text-muted);">لا يوجد عملاء مضافين حالياً.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
