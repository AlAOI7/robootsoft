@extends('layouts.admin')

@section('title', 'إدارة العملاء والشركاء')

@section('content')
<div class="page-header">
    <div class="page-title-box">
        <h1>إدارة العملاء وشهادات الثقة</h1>
        <p>إدارة سجل شركاء النجاح والآراء المعروضة في موقع Robotsoft ERP</p>
    </div>
    <div>
        <button class="btn btn-primary" onclick="openModal('addClientModal')">
            <i class="fas fa-plus"></i> إضافة عميل جديد
        </button>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <i class="fas fa-handshake"></i> قائمة العملاء والشركاء ({{ $clients->count() }})
        </div>
        <div class="table-actions">
            <div class="table-search">
                <input type="text" placeholder="بحث في العملاء..." data-table-search="clientsTable">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="clientsTable">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>العميل</th>
                    <th>مجال العمل / القطاع</th>
                    <th>رأي العميل (Testimonial)</th>
                    <th>التقييم</th>
                    <th style="text-align: center;">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $index => $client)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ asset('assets/logo.jpeg') }}" alt="{{ $client->name }}" style="width: 36px; height: 36px; border-radius: 50%;">
                                <strong>{{ $client->name }}</strong>
                            </div>
                        </td>
                        <td><span class="badge badge-info">{{ $client->industry ?? 'عام' }}</span></td>
                        <td>{{ Str::limit($client->testimonial, 70) }}</td>
                        <td style="color: #f59e0b;">
                            @for($i = 0; $i < ($client->rating ?? 5); $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </td>
                        <td style="text-align: center;">
                            <div style="display: inline-flex; gap: 6px;">
                                <button class="btn btn-secondary btn-icon" onclick="openModal('editClientModal_{{ $client->id }}')" title="تعديل">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا العميل؟');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-icon" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Client Modal -->
                    <div class="admin-modal-overlay" id="editClientModal_{{ $client->id }}">
                        <div class="admin-modal">
                            <div class="admin-modal-header">
                                <h3 class="admin-modal-title">تعديل بيانات العميل: {{ $client->name }}</h3>
                                <button type="button" class="admin-modal-close" onclick="closeModal('editClientModal_{{ $client->id }}')">&times;</button>
                            </div>
                            <div class="admin-modal-body">
                                <form action="{{ route('admin.clients.update', $client->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="form-label">اسم العميل / الشركة *</label>
                                        <input type="text" name="name" class="form-control" value="{{ $client->name }}" required>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div class="form-group">
                                            <label class="form-label">مجال العمل / القطاع</label>
                                            <input type="text" name="industry" class="form-control" value="{{ $client->industry }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">التقييم (1 إلى 5 نجوم)</label>
                                            <select name="rating" class="form-select">
                                                <option value="5" {{ $client->rating == 5 ? 'selected' : '' }}>5 نجوم ★★★★★</option>
                                                <option value="4" {{ $client->rating == 4 ? 'selected' : '' }}>4 نجوم ★★★★☆</option>
                                                <option value="3" {{ $client->rating == 3 ? 'selected' : '' }}>3 نجوم ★★★☆☆</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">رأي العميل (الشهادة)</label>
                                        <textarea name="testimonial" class="form-control" rows="3">{{ $client->testimonial }}</textarea>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                        <button type="button" class="btn btn-secondary" onclick="closeModal('editClientModal_{{ $client->id }}')">إلغاء</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 3rem;">لا يوجد عملاء مضافين حتى الآن.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Client Modal -->
<div class="admin-modal-overlay" id="addClientModal">
    <div class="admin-modal">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">إضافة عميل / شريك جديد</h3>
            <button type="button" class="admin-modal-close" onclick="closeModal('addClientModal')">&times;</button>
        </div>
        <div class="admin-modal-body">
            <form action="{{ route('admin.clients.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">اسم العميل / الشركة *</label>
                    <input type="text" name="name" class="form-control" required placeholder="مثال: شركة النماء التجارية">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">مجال العمل / القطاع</label>
                        <input type="text" name="industry" class="form-control" placeholder="التجارة / المطاعم / المقاولات">
                    </div>
                    <div class="form-group">
                        <label class="form-label">التقييم</label>
                        <select name="rating" class="form-select">
                            <option value="5">5 نجوم ★★★★★</option>
                            <option value="4">4 نجوم ★★★★☆</option>
                            <option value="3">3 نجوم ★★★☆☆</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">رأي العميل (الشهادة)</label>
                    <textarea name="testimonial" class="form-control" rows="3" placeholder="ماذا قال العميل عن تجربته مع روبوت سوفت؟"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">إضافة العميل</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addClientModal')">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
