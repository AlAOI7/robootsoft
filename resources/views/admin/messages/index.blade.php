@extends('layouts.admin')

@section('title', 'رسائل التواصل الواردة')

@section('content')
<div class="page-header">
    <div class="page-title-box">
        <h1>رسائل التواصل والاستفسارات</h1>
        <p>متابعة واستعراض رسائل الزوار والعملاء الواردة عبر نموذج "اتصل بنا"</p>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <i class="fas fa-inbox"></i> صندوق الوارد ({{ $messages->total() }})
        </div>
        <div class="table-actions">
            <div class="table-search">
                <input type="text" placeholder="بحث في الرسائل..." data-table-search="messagesTable">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="messagesTable">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>المرسل</th>
                    <th>البريد والهاتف</th>
                    <th>الموضوع</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                    <th style="text-align: center;">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $index => $msg)
                    <tr style="{{ !$msg->is_read ? 'font-weight: 700; background: var(--bg-surface-hover);' : '' }}">
                        <td>{{ $messages->firstItem() + $index }}</td>
                        <td><strong>{{ $msg->name }}</strong></td>
                        <td>
                            <div>{{ $msg->email }}</div>
                            <small style="color: var(--text-muted);" dir="ltr">{{ $msg->phone ?? '-' }}</small>
                        </td>
                        <td>{{ Str::limit($msg->subject ?? $msg->message, 35) }}</td>
                        <td>{{ $msg->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            <span class="badge {{ $msg->is_read ? 'badge-info' : 'badge-danger' }}">
                                {{ $msg->is_read ? 'تمت القراءة' : 'رسالة جديدة' }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <div style="display: inline-flex; gap: 6px;">
                                <button class="btn btn-secondary btn-icon" onclick="openModal('viewMessageModal_{{ $msg->id }}')" title="قراءة الرسالة">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if(!$msg->is_read)
                                    <form action="{{ route('admin.messages.read', $msg->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-primary btn-icon" title="تحديد كمقروءة">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-icon" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- View Message Modal -->
                    <div class="admin-modal-overlay" id="viewMessageModal_{{ $msg->id }}">
                        <div class="admin-modal">
                            <div class="admin-modal-header">
                                <h3 class="admin-modal-title">تفاصيل الرسالة من: {{ $msg->name }}</h3>
                                <button type="button" class="admin-modal-close" onclick="closeModal('viewMessageModal_{{ $msg->id }}')">&times;</button>
                            </div>
                            <div class="admin-modal-body">
                                <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1.5rem;">
                                    <div>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);">المرسل:</span>
                                        <div style="font-weight: 700;">{{ $msg->name }}</div>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">البريد الإلكتروني:</span>
                                            <div><a href="mailto:{{ $msg->email }}" style="color: var(--primary);">{{ $msg->email }}</a></div>
                                        </div>
                                        <div>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">الهاتف:</span>
                                            <div dir="ltr"><a href="tel:{{ $msg->phone }}" style="color: var(--primary);">{{ $msg->phone ?? 'غير محدد' }}</a></div>
                                        </div>
                                    </div>
                                    <div>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);">الموضوع:</span>
                                        <div style="font-weight: 700;">{{ $msg->subject ?? 'بدون موضوع' }}</div>
                                    </div>
                                    <div>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);">نص الرسالة:</span>
                                        <div style="background: var(--bg-surface-hover); padding: 1.25rem; border-radius: 8px; line-height: 1.8; margin-top: 0.4rem; white-space: pre-wrap;">{{ $msg->message }}</div>
                                    </div>
                                    <div>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);">تاريخ الإرسال:</span>
                                        <div>{{ $msg->created_at->format('Y-m-d H:i:s') }} ({{ $msg->created_at->diffForHumans() }})</div>
                                    </div>
                                </div>
                                <div class="form-actions" style="justify-content: space-between;">
                                    <a href="mailto:{{ $msg->email }}?subject=الرد: {{ $msg->subject }}" class="btn btn-primary">
                                        <i class="fas fa-reply"></i> الرد عبر البريد الإلكتروني
                                    </a>
                                    <button type="button" class="btn btn-secondary" onclick="closeModal('viewMessageModal_{{ $msg->id }}')">إغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 3rem;">لا توجد أي رسائل واردة حتى الآن.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
        <div style="padding: 1.25rem; display: flex; justify-content: center; border-top: 1px solid var(--border-color);">
            {{ $messages->links() }}
        </div>
    @endif
</div>
@endsection
