@extends('layouts.app')

@section('title', 'المدونة والتحليلات التقنية | Robotsoft ERP')
@section('meta_description', 'أحدث المقالات والإرشادات حول أنظمة ERP والفوترة الإلكترونية والتحول الرقمي للأعمال.')

@section('content')
<section class="page-hero">
    <div class="container page-hero-container">
        <h1 class="page-hero-title reveal">المدونة والتحليلات</h1>
        <div class="page-hero-breadcrumbs">
            <a href="{{ route('home') }}">الرئيسية</a><span>/</span><span>المدونة</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <!-- Search bar -->
        <div style="max-width: 500px; margin: 0 auto 3rem; text-align: center;">
            <form action="{{ route('blog') }}" method="GET" style="display: flex; gap: 8px;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث في المقالات والأدلة..." class="form-control" style="background: var(--bg-card); padding: 0.75rem 1rem; border-radius: 8px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
            @forelse($posts as $post)
                <article class="feature-card reveal" style="padding: 0; overflow: hidden; border-radius: 12px; background: var(--bg-card); display:flex; flex-direction:column; justify-content:space-between;">
                    <div>
                        <div style="background: linear-gradient(135deg, #1e40af, #3b82f6); height: 180px; display:flex; align-items:center; justify-content:center;">
                            <i class="fas fa-file-alt" style="font-size: 54px; color: rgba(255,255,255,0.7);"></i>
                        </div>
                        <div style="padding: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                <span class="badge badge-info">{{ $post->category }}</span>
                                <span style="font-size: 0.75rem; color: var(--text-muted);"><i class="far fa-clock"></i> {{ $post->published_at ? $post->published_at->format('Y/m/d') : '' }}</span>
                            </div>
                            <h2 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 0.75rem; line-height: 1.5;">
                                <a href="{{ route('blog.single', $post->slug) }}" style="color: var(--text-primary);">{{ $post->title }}</a>
                            </h2>
                            <p style="font-size: 0.9rem; color: var(--text-secondary); line-height: 1.7; margin-bottom: 1rem;">
                                {{ Str::limit($post->summary ?? strip_tags($post->content), 120) }}
                            </p>
                        </div>
                    </div>
                    <div style="padding: 0 1.5rem 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.8rem; color: var(--text-muted);"><i class="far fa-eye"></i> {{ $post->views_count }} مشاهدة</span>
                        <a href="{{ route('blog.single', $post->slug) }}" style="color: var(--primary); font-weight: 700; font-size: 0.9rem;">قراءة المقال ←</a>
                    </div>
                </article>
            @empty
                <div style="text-align: center; grid-column: 1 / -1; padding: 4rem;">
                    <p style="color: var(--text-muted);">لا توجد مقالات منشورة حالياً مطابقة لبحثك.</p>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 3rem; display: flex; justify-content: center;">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection
