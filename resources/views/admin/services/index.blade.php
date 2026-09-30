@extends('layouts.admin')

@section('title', 'إدارة الخدمات')

@section('content')
<div class="page-header">
    <div class="page-title-box">
        <h1>إدارة الخدمات التقنية</h1>
        <p>إضافة وتعديل وحذف الخدمات المعروضة في موقع Robotsoft ERP</p>
    </div>
    <div>
        <button class="btn btn-primary" onclick="openModal('addServiceModal')">
            <i class="fas fa-plus"></i> إضافة خدمة جديدة
        </button>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <i class="fas fa-cubes"></i> قائمة الخدمات ({{ $services->count() }})
        </div>
        <div class="table-actions">
            <div class="table-search">
                <input type="text" placeholder="بحث في الخدمات..." data-table-search="servicesTable">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="servicesTable">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>الأيقونة</th>
                    <th>اسم الخدمة</th>
                    <th>التصنيف</th>
                    <th>الوصف</th>
                    <th>الترتيب</th>
                    <th>الحالة</th>
                    <th style="text-align: center;">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $index => $service)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div style="width: 36px; height: 36px; border-radius: 8px; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center;">
                                <i class="{{ $service->icon ?? 'fas fa-cog' }}"></i>
                            </div>
                        </td>
                        <td><strong>{{ $service->title }}</strong></td>
                        <td><span class="badge badge-info">{{ $service->category ?? 'عام' }}</span></td>
                        <td>{{ Str::limit($service->description, 60) }}</td>
                        <td>{{ $service->sort_order }}</td>
                        <td>
                            <span class="badge {{ $service->is_active ? 'badge-success' : 'badge-danger' }}">
                                {{ $service->is_active ? 'نشط' : 'معطل' }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <div style="display: inline-flex; gap: 6px;">
                                <button class="btn btn-secondary btn-icon" onclick="openModal('editServiceModal_{{ $service->id }}')" title="تعديل">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الخدمة؟');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-icon" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Modal for each service -->
                    <div class="admin-modal-overlay" id="editServiceModal_{{ $service->id }}">
                        <div class="admin-modal">
                            <div class="admin-modal-header">
                                <h3 class="admin-modal-title">تعديل الخدمة: {{ $service->title }}</h3>
                                <button type="button" class="admin-modal-close" onclick="closeModal('editServiceModal_{{ $service->id }}')">&times;</button>
                            </div>
                            <div class="admin-modal-body">
                                <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="form-label">عنوان الخدمة *</label>
                                        <input type="text" name="title" class="form-control" value="{{ $service->title }}" required>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div class="form-group">
                                            <label class="form-label">التصنيف</label>
                                            <input type="text" name="category" class="form-control" value="{{ $service->category }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">رمز الأيقونة (FontAwesome)</label>
                                            <input type="text" name="icon" class="form-control" value="{{ $service->icon }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">وصف الخدمة *</label>
                                        <textarea name="description" class="form-control" rows="3" required>{{ $service->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">المميزات (ميزة واحدة في كل سطر)</label>
                                        <textarea name="features" class="form-control" rows="3">{{ is_array($service->features) ? implode("\n", $service->features) : '' }}</textarea>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <div class="form-group" style="width: 120px;">
                                            <label class="form-label">الترتيب</label>
                                            <input type="number" name="sort_order" class="form-control" value="{{ $service->sort_order }}">
                                        </div>
                                        <label class="form-check" style="margin-top: 1rem;">
                                            <input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}>
                                            <span>الخدمة نشطة وظاهرة للجمهور</span>
                                        </label>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                        <button type="button" class="btn btn-secondary" onclick="closeModal('editServiceModal_{{ $service->id }}')">إلغاء</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 3rem;">لا توجد خدمات مضافة حتى الآن.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Service Modal -->
<div class="admin-modal-overlay" id="addServiceModal">
    <div class="admin-modal">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">إضافة خدمة تقنية جديدة</h3>
            <button type="button" class="admin-modal-close" onclick="closeModal('addServiceModal')">&times;</button>
        </div>
        <div class="admin-modal-body">
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">عنوان الخدمة *</label>
                    <input type="text" name="title" class="form-control" required placeholder="مثال: التدريب والتأهيل الميداني">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">التصنيف</label>
                        <input type="text" name="category" class="form-control" placeholder="consulting / setup / training">
                    </div>
                    <div class="form-group">
                        <label class="form-label">رمز الأيقونة (FontAwesome)</label>
                        <input type="text" name="icon" class="form-control" placeholder="fas fa-graduation-cap" value="fas fa-cog">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">وصف الخدمة *</label>
                    <textarea name="description" class="form-control" rows="3" required placeholder="تفاصيل الخدمة التي ستقدمها للعميل..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">المميزات (ميزة واحدة في كل سطر)</label>
                    <textarea name="features" class="form-control" rows="3" placeholder="ميزة 1&#10;ميزة 2&#10;ميزة 3"></textarea>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="form-group" style="width: 120px;">
                        <label class="form-label">الترتيب</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>
                    <label class="form-check" style="margin-top: 1rem;">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>الخدمة نشطة وظاهرة للجمهور</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">إضافة الخدمة</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addServiceModal')">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
