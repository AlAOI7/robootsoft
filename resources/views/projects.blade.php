@extends('layouts.app')

@section('title', 'معرض المشاريع | Robotsoft ERP')
@section('meta_description', 'استعرض سجل نجاحات Robotsoft في تطبيق أنظمة تخطيط الموارد ونقاط البيع لدى شركائنا.')

@section('content')
<section class="page-hero">
    <div class="container page-hero-container">
        <h1 class="page-hero-title reveal">المشاريع وقصص النجاح</h1>
        <div class="page-hero-breadcrumbs">
            <a href="{{ route('home') }}">الرئيسية</a><span>/</span><span>المشاريع</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <!-- Filter Tabs -->
        <div class="portfolio-filter-container reveal" style="display: flex; justify-content: center; gap: 0.5rem; margin-bottom: 2.5rem; flex-wrap: wrap;">
            <a href="{{ route('projects') }}" class="btn {{ !request('category') || request('category') == 'all' ? 'btn-primary' : 'btn-secondary' }} btn-sm">الكل</a>
            <a href="{{ route('projects', ['category' => 'erp']) }}" class="btn {{ request('category') == 'erp' ? 'btn-primary' : 'btn-secondary' }} btn-sm">أنظمة ERP</a>
            <a href="{{ route('projects', ['category' => 'pos']) }}" class="btn {{ request('category') == 'pos' ? 'btn-primary' : 'btn-secondary' }} btn-sm">نقاط البيع POS</a>
            <a href="{{ route('projects', ['category' => 'web']) }}" class="btn {{ request('category') == 'web' ? 'btn-primary' : 'btn-secondary' }} btn-sm">تطبيقات ويب</a>
            <a href="{{ route('projects', ['category' => 'bi']) }}" class="btn {{ request('category') == 'bi' ? 'btn-primary' : 'btn-secondary' }} btn-sm">تقارير BI</a>
        </div>

        <div class="portfolio-grid">
            @forelse($projects as $project)
                <div class="portfolio-card reveal">
                    <div class="portfolio-img-wrapper" style="background: linear-gradient(135deg, #1e40af, #0d9488); display:flex; align-items:center; justify-content:center; height: 180px;">
                        <i class="fas fa-project-diagram" style="font-size: 54px; color: rgba(255,255,255,0.7);"></i>
                    </div>
                    <div class="portfolio-info" style="padding: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <span class="badge badge-primary">{{ strtoupper($project->category ?? 'ERP') }}</span>
                            @if($project->completion_date)
                                <span style="font-size: 0.75rem; color: var(--text-muted);"><i class="far fa-calendar-alt"></i> {{ $project->completion_date->format('Y/m') }}</span>
                            @endif
                        </div>
                        <h3 class="portfolio-title" style="margin-bottom: 0.5rem;">{{ $project->title }}</h3>
                        @if($project->client_name)
                            <div style="font-size: 0.82rem; color: var(--primary); font-weight: 600; margin-bottom: 0.5rem;">
                                <i class="fas fa-building" style="margin-left: 4px;"></i> {{ $project->client_name }}
                            </div>
                        @endif
                        <p class="portfolio-desc" style="font-size: 0.875rem; color: var(--text-secondary); line-height: 1.6;">{{ $project->description }}</p>
                    </div>
                </div>
            @empty
                <div style="text-align: center; grid-column: 1 / -1; padding: 4rem;">
                    <i class="fas fa-folder-open" style="font-size: 48px; color: var(--text-muted); margin-bottom: 1rem;"></i>
                    <p style="color: var(--text-muted);">لا توجد مشاريع مضافة في هذا القسم حالياً.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
