@extends('layouts.admin')

@section('title', 'طلبات الخدمات والأنظمة')

@section('content')
<div class="page-header">
    <div class="page-title-box">
        <h1>طلبات الخدمات والأنظمة</h1>
        <p>متابعة وإدارة طلبات عروض الأسعار والأنظمة الواردة من الشركات والمؤسسات</p>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <i class="fas fa-clipboard-list"></i> جميع الطلبات ({{ $requests->total() }})
        </div>
        <div class="table-actions">
            <div class="table-search">
                <input type="text" placeholder="بحث في الطلبات..." data-table-search="requestsTable">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="requestsTable">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>المنشأة</th>
                    <th>المسؤول والتواصل</th>
                    <th>نوع الخدمة</th>
                    <th>حجم المنشأة</th>
                    <th>تاريخ الطلب</th>
                    <th>الحالة</th>
                    <th style="text-align: center;">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $index => $req)
                    <tr>
                        <td>{{ $requests->firstItem() + $index }}</td>
                        <td><strong>{{ $req->company_name }}</strong></td>
                        <td>
                            <div>{{ $req->contact_person }}</div>
                            <small style="color: var(--text-muted);" dir="ltr">{{ $req->phone }} | {{ $req->email }}</small>
                        </td>
                        <td><span class="badge badge-info">{{ $req->service_type }}</span></td>
                        <td><small>{{ $req->system_size ?? '-' }}</small></td>
                        <td>{{ $req->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.service-requests.status', $req->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="form-select" style="padding: 0.2rem 0.5rem; font-size: 0.75rem; width: auto; font-weight: 700;">
                                    <option value="جديد" {{ $req->status === 'جديد' ? 'selected' : '' }}>جديد</option>
                                    <option value="قيد المتابعة" {{ $req->status === 'قيد المتابعة' ? 'selected' : '' }}>قيد المتابعة</option>
                                    <option value="مكتمل" {{ $req->status === 'مكتمل' ? 'selected' : '' }}>مكتمل</option>
                                    <option value="ملغي" {{ $req->status === 'ملغي' ? 'selected' : '' }}>ملغي</option>
                                </select>
                            </form>
                        </td>
                        <td style="text-align: center;">
                            <div style="display: inline-flex; gap: 6px;">
                                <button class="btn btn-secondary btn-icon" onclick="openModal('viewReqModal_{{ $req->id }}')" title="عرض التفاصيل">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('admin.service-requests.destroy', $req->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطلب؟');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-icon" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- View Request Modal -->
                    <div class="admin-modal-overlay" id="viewReqModal_{{ $req->id }}">
                        <div class="admin-modal">
                            <div class="admin-modal-header">
                                <h3 class="admin-modal-title">تفاصيل طلب: {{ $req->company_name }}</h3>
                                <button type="button" class="admin-modal-close" onclick="closeModal('viewReqModal_{{ $req->id }}')">&times;</button>
                            </div>
                            <div class="admin-modal-body">
                                <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1.5rem;">
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">اسم المنشأة:</span>
                                            <div style="font-weight: 700;">{{ $req->company_name }}</div>
                                        </div>
                                        <div>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">الشخص المسؤول:</span>
                                            <div style="font-weight: 700;">{{ $req->contact_person }}</div>
                                        </div>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">البريد الإلكتروني:</span>
                                            <div><a href="mailto:{{ $req->email }}" style="color: var(--primary);">{{ $req->email }}</a></div>
                                        </div>
                                        <div>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">الهاتف:</span>
                                            <div dir="ltr"><a href="tel:{{ $req->phone }}" style="color: var(--primary);">{{ $req->phone }}</a></div>
                                        </div>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">نوع الخدمة / النظام:</span>
                                            <div style="font-weight: 700; color: var(--primary);">{{ $req->service_type }}</div>
                                        </div>
                                        <div>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">حجم المنشأة التقريبي:</span>
                                            <div>{{ $req->system_size ?? '-' }}</div>
                                        </div>
                                    </div>
                                    @if($req->notes)
                                        <div>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">ملاحظات العميل:</span>
                                            <div style="background: var(--bg-surface-hover); padding: 1rem; border-radius: 8px; line-height: 1.7; margin-top: 0.4rem;">{{ $req->notes }}</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-actions" style="justify-content: space-between;">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $req->phone) }}" target="_blank" class="btn btn-success">
                                        <i class="fab fa-whatsapp"></i> تواصل عبر واتساب
                                    </a>
                                    <button type="button" class="btn btn-secondary" onclick="closeModal('viewReqModal_{{ $req->id }}')">إغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 3rem;">لا توجد أي طلبات خدمات واردة حتى الآن.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($requests->hasPages())
        <div style="padding: 1.25rem; display: flex; justify-content: center; border-top: 1px solid var(--border-color);">
            {{ $requests->links() }}
        </div>
    @endif
</div>
@endsection
