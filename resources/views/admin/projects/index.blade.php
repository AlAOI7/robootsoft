@extends('layouts.admin')

@section('title', 'إدارة المشاريع')

@section('content')
<div class="page-header">
    <div class="page-title-box">
        <h1>إدارة معرض المشاريع</h1>
        <p>إدارة قصص النجاح والمشاريع المنجزة المعروضة في موقع Robotsoft ERP</p>
    </div>
    <div>
        <button class="btn btn-primary" onclick="openModal('addProjectModal')">
            <i class="fas fa-plus"></i> إضافة مشروع جديد
        </button>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <i class="fas fa-briefcase"></i> قائمة المشاريع ({{ $projects->count() }})
        </div>
        <div class="table-actions">
            <div class="table-search">
                <input type="text" placeholder="بحث في المشاريع..." data-table-search="projectsTable">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="projectsTable">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>عنوان المشروع</th>
                    <th>التصنيف</th>
                    <th>اسم العميل</th>
                    <th>تاريخ الإنجاز</th>
                    <th>مميز بالرئيسية</th>
                    <th style="text-align: center;">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $index => $project)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $project->title }}</strong><br>
                            <small style="color: var(--text-muted);">{{ Str::limit($project->description, 50) }}</small>
                        </td>
                        <td><span class="badge badge-info">{{ strtoupper($project->category ?? 'ERP') }}</span></td>
                        <td>{{ $project->client_name ?? '-' }}</td>
                        <td>{{ $project->completion_date ? $project->completion_date->format('Y/m/d') : '-' }}</td>
                        <td>
                            <span class="badge {{ $project->is_featured ? 'badge-success' : 'badge-warning' }}">
                                {{ $project->is_featured ? 'مميز' : 'عادي' }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <div style="display: inline-flex; gap: 6px;">
                                <button class="btn btn-secondary btn-icon" onclick="openModal('editProjectModal_{{ $project->id }}')" title="تعديل">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المشروع؟');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-icon" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Project Modal -->
                    <div class="admin-modal-overlay" id="editProjectModal_{{ $project->id }}">
                        <div class="admin-modal">
                            <div class="admin-modal-header">
                                <h3 class="admin-modal-title">تعديل المشروع: {{ $project->title }}</h3>
                                <button type="button" class="admin-modal-close" onclick="closeModal('editProjectModal_{{ $project->id }}')">&times;</button>
                            </div>
                            <div class="admin-modal-body">
                                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="form-label">عنوان المشروع *</label>
                                        <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div class="form-group">
                                            <label class="form-label">التصنيف</label>
                                            <select name="category" class="form-select">
                                                <option value="erp" {{ $project->category == 'erp' ? 'selected' : '' }}>أنظمة ERP</option>
                                                <option value="pos" {{ $project->category == 'pos' ? 'selected' : '' }}>نقاط البيع POS</option>
                                                <option value="web" {{ $project->category == 'web' ? 'selected' : '' }}>تطبيقات الويب</option>
                                                <option value="bi" {{ $project->category == 'bi' ? 'selected' : '' }}>تقارير وذكاء الأعمال BI</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">اسم العميل</label>
                                            <input type="text" name="client_name" class="form-control" value="{{ $project->client_name }}">
                                        </div>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div class="form-group">
                                            <label class="form-label">تاريخ الإنجاز</label>
                                            <input type="date" name="completion_date" class="form-control" value="{{ $project->completion_date ? $project->completion_date->format('Y-m-d') : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">رابط المشروع أو الاستعراض</label>
                                            <input type="text" name="link" class="form-control" value="{{ $project->link }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">تفاصيل ووصف المشروع</label>
                                        <textarea name="description" class="form-control" rows="3">{{ $project->description }}</textarea>
                                    </div>
                                    <label class="form-check" style="margin-top: 1rem;">
                                        <input type="checkbox" name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }}>
                                        <span>إظهار في الصفحة الرئيسية كمشروع مميز</span>
                                    </label>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                        <button type="button" class="btn btn-secondary" onclick="closeModal('editProjectModal_{{ $project->id }}')">إلغاء</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 3rem;">لا توجد مشاريع مضافة حتى الآن.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Project Modal -->
<div class="admin-modal-overlay" id="addProjectModal">
    <div class="admin-modal">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">إضافة مشروع جديد</h3>
            <button type="button" class="admin-modal-close" onclick="closeModal('addProjectModal')">&times;</button>
        </div>
        <div class="admin-modal-body">
            <form action="{{ route('admin.projects.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">عنوان المشروع *</label>
                    <input type="text" name="title" class="form-control" required placeholder="مثال: سلسلة مطاعم التميمي">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">التصنيف</label>
                        <select name="category" class="form-select">
                            <option value="erp">أنظمة ERP</option>
                            <option value="pos">نقاط البيع POS</option>
                            <option value="web">تطبيقات الويب</option>
                            <option value="bi">تقارير وذكاء الأعمال BI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">اسم العميل</label>
                        <input type="text" name="client_name" class="form-control" placeholder="اسم الشركة أو المؤسسة">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">تاريخ الإنجاز</label>
                        <input type="date" name="completion_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">رابط المشروع (اختياري)</label>
                        <input type="text" name="link" class="form-control" placeholder="https://...">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">تفاصيل ووصف المشروع</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="ما هي الأنظمة والوحدات التي تم تركيبها وتهيئتها للعميل؟"></textarea>
                </div>
                <label class="form-check" style="margin-top: 1rem;">
                    <input type="checkbox" name="is_featured" value="1" checked>
                    <span>إظهار في الصفحة الرئيسية كمشروع مميز</span>
                </label>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">إضافة المشروع</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addProjectModal')">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
