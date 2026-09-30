@extends('layouts.app')

@section('title', $post->title . ' | Robotsoft ERP')
@section('meta_description', Str::limit($post->summary ?? strip_tags($post->content), 150))

@section('content')
<section class="page-hero">
    <div class="container page-hero-container">
        <h1 class="page-hero-title reveal" style="font-size: 2rem;">{{ $post->title }}</h1>
        <div class="page-hero-breadcrumbs">
            <a href="{{ route('home') }}">الرئيسية</a><span>/</span><a href="{{ route('blog') }}">المدونة</a><span>/</span><span>{{ Str::limit($post->title, 25) }}</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container" style="max-width: 900px;">
        <article class="reveal" style="background: var(--bg-card); padding: 2.5rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
            <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1.25rem; flex-wrap: wrap;">
                <span class="badge badge-primary">{{ $post->category }}</span>
                <span style="font-size: 0.85rem; color: var(--text-muted);"><i class="far fa-user"></i> {{ $post->author }}</span>
                <span style="font-size: 0.85rem; color: var(--text-muted);"><i class="far fa-calendar-alt"></i> {{ $post->published_at ? $post->published_at->format('Y/m/d') : '' }}</span>
                <span style="font-size: 0.85rem; color: var(--text-muted);"><i class="far fa-eye"></i> {{ $post->views_count }} مشاهدة</span>
            </div>

            @if($post->summary)
                <div style="background: var(--primary-light); border-right: 4px solid var(--primary); padding: 1.25rem; border-radius: 8px; margin-bottom: 2rem; font-weight: 600; line-height: 1.8; color: var(--text-primary);">
                    {{ $post->summary }}
                </div>
            @endif

            <div style="font-size: 1.1rem; line-height: 2; color: var(--text-primary); margin-bottom: 2.5rem;">
                {!! nl2br(e($post->content)) !!}
            </div>

            <div style="border-top: 1px solid var(--border-color); padding-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <a href="{{ route('blog') }}" class="btn btn-secondary"><i class="fas fa-arrow-right"></i> العودة للمدونة</a>
                <a href="{{ route('request-service') }}" class="btn btn-primary">اطلب استشارة متعلقة بالمقال</a>
            </div>
        </article>

        @if($relatedPosts->isNotEmpty())
            <div style="margin-top: 4rem;">
                <h3 style="font-size: 1.4rem; font-weight: 800; margin-bottom: 1.5rem;">مقالات ذات صلة</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
                    @foreach($relatedPosts as $related)
                        <div style="background: var(--bg-card); padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color);">
                            <span class="badge badge-info" style="margin-bottom: 0.5rem;">{{ $related->category }}</span>
                            <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.5rem;">
                                <a href="{{ route('blog.single', $related->slug) }}" style="color: var(--text-primary);">{{ $related->title }}</a>
                            </h4>
                            <a href="{{ route('blog.single', $related->slug) }}" style="color: var(--primary); font-size: 0.82rem; font-weight: 700;">اقرأ المزيد ←</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
