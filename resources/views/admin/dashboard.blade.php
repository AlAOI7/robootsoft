@extends('layouts.admin')

@section('title', 'لوحة التحكم الرئيسية')

@section('content')
<div class="page-header">
    <div class="page-title-box">
        <h1>لوحة المعلومات</h1>
        <p>نظرة عامة على الأداء والمحتوى والطلبات الواردة في نظام Robotsoft ERP</p>
    </div>
    <div class="breadcrumb-nav">
        <a href="{{ route('admin.dashboard') }}">الرئيسية</a>
        <span>/</span>
        <span>لوحة التحكم</span>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon primary"><i class="fas fa-cubes"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $stats['services_count'] }}</div>
            <div class="stat-label">الخدمات النشطة</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon success"><i class="fas fa-briefcase"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $stats['projects_count'] }}</div>
            <div class="stat-label">المشاريع المنجزة</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon accent"><i class="fas fa-handshake"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $stats['clients_count'] }}</div>
            <div class="stat-label">العملاء والشركاء</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon warning"><i class="fas fa-clipboard-list"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $stats['pending_requests'] }}</div>
            <div class="stat-label">طلبات خدمات جديدة</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon danger"><i class="fas fa-envelope"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $stats['unread_messages'] }}</div>
            <div class="stat-label">رسائل غير مقروءة</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon primary"><i class="fas fa-users"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $stats['users_count'] }}</div>
            <div class="stat-label">المستخدمين المسجلين</div>
        </div>
    </div>
</div>

<!-- Quick Action Shortcuts -->
<div class="table-card" style="padding: 1.25rem 1.5rem; margin-bottom: 2rem;">
    <div style="font-weight: 700; font-size: 0.95rem; margin-bottom: 0.75rem; color: var(--text-primary);">إجراءات سريعة:</div>
    <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i> إضافة خدمة</a>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i> إضافة مشروع</a>
        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> نشر مقال جديد</a>
        <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-user-plus"></i> إضافة عميل</a>
        <a href="{{ route('admin.service-requests.index') }}" class="btn btn-primary btn-sm"><i class="fas fa-tasks"></i> متابعة الطلبات</a>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 1.5rem;">
    <!-- Recent Service Requests -->
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <i class="fas fa-clipboard-check" style="color: var(--primary);"></i> أحدث طلبات الخدمات
            </div>
            <a href="{{ route('admin.service-requests.index') }}" class="btn btn-outline-primary btn-sm">عرض الكل</a>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>الشركة</th>
                        <th>الخدمة</th>
                        <th>التاريخ</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentRequests as $request)
                        <tr>
                            <td>
                                <strong>{{ $request->company_name }}</strong><br>
                                <small style="color: var(--text-muted);">{{ $request->contact_person }}</small>
                            </td>
                            <td>{{ $request->service_type }}</td>
                            <td>{{ $request->created_at->diffForHumans() }}</td>
                            <td>
                                <span class="badge {{ $request->status === 'جديد' ? 'badge-warning' : ($request->status === 'مكتمل' ? 'badge-success' : 'badge-primary') }}">
                                    {{ $request->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--text-muted);">لا توجد طلبات واردة حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Contact Messages -->
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <i class="fas fa-inbox" style="color: var(--danger);"></i> أحدث رسائل التواصل
            </div>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-primary btn-sm">عرض الكل</a>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>المرسل</th>
                        <th>الموضوع</th>
                        <th>التاريخ</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMessages as $msg)
                        <tr>
                            <td>
                                <strong>{{ $msg->name }}</strong><br>
                                <small style="color: var(--text-muted);">{{ $msg->email }}</small>
                            </td>
                            <td>{{ Str::limit($msg->subject ?? $msg->message, 25) }}</td>
                            <td>{{ $msg->created_at->diffForHumans() }}</td>
                            <td>
                                <span class="badge {{ $msg->is_read ? 'badge-info' : 'badge-danger' }}">
                                    {{ $msg->is_read ? 'مقروءة' : 'جديدة' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--text-muted);">لا توجد رسائل جديدة.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
