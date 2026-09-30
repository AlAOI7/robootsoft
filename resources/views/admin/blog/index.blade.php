@extends('layouts.admin')

@section('title', 'إدارة المدونة والمقالات')

@section('content')
<div class="page-header">
    <div class="page-title-box">
        <h1>إدارة المدونة والمقالات</h1>
        <p>نشر وإدارة المحتوى المعرفي والمقالات التقنية لتعزيز ظهور الموقع في محركات البحث (SEO)</p>
    </div>
    <div>
        <button class="btn btn-primary" onclick="openModal('addBlogModal')">
            <i class="fas fa-plus"></i> نشر مقال جديد
        </button>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <i class="fas fa-newspaper"></i> المقالات المنشورة ({{ $posts->total() }})
        </div>
        <div class="table-actions">
            <div class="table-search">
                <input type="text" placeholder="بحث في المقالات..." data-table-search="blogTable">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="blogTable">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>عنوان المقال</th>
                    <th>التصنيف</th>
                    <th>الكاتب</th>
                    <th>تاريخ النشر</th>
                    <th>المشاهدات</th>
                    <th style="text-align: center;">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $index => $post)
                    <tr>
                        <td>{{ $posts->firstItem() + $index }}</td>
                        <td>
                            <strong>{{ $post->title }}</strong><br>
                            <small style="color: var(--text-muted);">{{ Str::limit($post->summary ?? strip_tags($post->content), 60) }}</small>
                        </td>
                        <td><span class="badge badge-info">{{ $post->category }}</span></td>
                        <td>{{ $post->author }}</td>
                        <td>{{ $post->published_at ? $post->published_at->format('Y/m/d') : '-' }}</td>
                        <td><i class="far fa-eye"></i> {{ $post->views_count }}</td>
                        <td style="text-align: center;">
                            <div style="display: inline-flex; gap: 6px;">
                                <a href="{{ route('blog.single', $post->slug) }}" target="_blank" class="btn btn-secondary btn-icon" title="معاينة">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <button class="btn btn-secondary btn-icon" onclick="openModal('editBlogModal_{{ $post->id }}')" title="تعديل">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال؟');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-icon" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Blog Modal -->
                    <div class="admin-modal-overlay" id="editBlogModal_{{ $post->id }}">
                        <div class="admin-modal" style="max-width: 800px;">
                            <div class="admin-modal-header">
                                <h3 class="admin-modal-title">تعديل المقال: {{ Str::limit($post->title, 40) }}</h3>
                                <button type="button" class="admin-modal-close" onclick="closeModal('editBlogModal_{{ $post->id }}')">&times;</button>
                            </div>
                            <div class="admin-modal-body">
                                <form action="{{ route('admin.blog.update', $post->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="form-label">عنوان المقال *</label>
                                        <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div class="form-group">
                                            <label class="form-label">التصنيف</label>
                                            <input type="text" name="category" class="form-control" value="{{ $post->category }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">اسم الكاتب</label>
                                            <input type="text" name="author" class="form-control" value="{{ $post->author }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">الملخص الموجز (يظهر في البطاقة ومحركات البحث)</label>
                                        <textarea name="summary" class="form-control" rows="2">{{ $post->summary }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">محتوى المقال الكامل *</label>
                                        <textarea name="content" class="form-control" rows="8" required>{{ $post->content }}</textarea>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                        <button type="button" class="btn btn-secondary" onclick="closeModal('editBlogModal_{{ $post->id }}')">إلغاء</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 3rem;">لا توجد مقالات منشورة حتى الآن.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($posts->hasPages())
        <div style="padding: 1.25rem; display: flex; justify-content: center; border-top: 1px solid var(--border-color);">
            {{ $posts->links() }}
        </div>
    @endif
</div>

<!-- Add Blog Modal -->
<div class="admin-modal-overlay" id="addBlogModal">
    <div class="admin-modal" style="max-width: 800px;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">نشر مقال جديد</h3>
            <button type="button" class="admin-modal-close" onclick="closeModal('addBlogModal')">&times;</button>
        </div>
        <div class="admin-modal-body">
            <form action="{{ route('admin.blog.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">عنوان المقال *</label>
                    <input type="text" name="title" class="form-control" required placeholder="مثال: أهمية الربط مع الفاتورة الإلكترونية">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">التصنيف</label>
                        <input type="text" name="category" class="form-control" placeholder="استشارات تقنية / الفوترة / ERP" value="أنظمة ERP">
                    </div>
                    <div class="form-group">
                        <label class="form-label">اسم الكاتب</label>
                        <input type="text" name="author" class="form-control" value="فريق Robotsoft">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">الملخص الموجز</label>
                    <textarea name="summary" class="form-control" rows="2" placeholder="مقدمة سريعة للمقال تجذب القارئ..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">المحتوى الكامل للمقال *</label>
                    <textarea name="content" class="form-control" rows="8" required placeholder="اكتب نص المقال بالتفصيل هنا..."></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">نشر المقال الآن</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addBlogModal')">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
