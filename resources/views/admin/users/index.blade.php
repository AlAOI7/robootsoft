@extends('layouts.admin')

@section('title', 'إدارة المستخدمين والصلاحيات')

@section('content')
<div class="page-header">
    <div class="page-title-box">
        <h1>إدارة المستخدمين وصلاحيات الدخول</h1>
        <p>إدارة حسابات المدراء والمشرفين والمستخدمين في نظام Robotsoft ERP</p>
    </div>
    <div>
        <button class="btn btn-primary" onclick="openModal('addUserModal')">
            <i class="fas fa-user-plus"></i> إضافة مستخدم جديد
        </button>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <i class="fas fa-users-cog"></i> المستخدمون المسجلون ({{ $users->total() }})
        </div>
        <div class="table-actions">
            <div class="table-search">
                <input type="text" placeholder="بحث في المستخدمين..." data-table-search="usersTable">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="usersTable">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>رقم الجوال</th>
                    <th>نوع الحساب / الدور</th>
                    <th>تاريخ التسجيل</th>
                    <th style="text-align: center;">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $index }}</td>
                        <td>
                            <strong>{{ $user->name }}</strong>
                            @if($user->id === auth()->id())
                                <span class="badge badge-success" style="margin-right: 6px;">حسابك الحالي</span>
                            @endif
                        </td>
                        <td dir="ltr" style="text-align: right;">{{ $user->email }}</td>
                        <td dir="ltr" style="text-align: right;">{{ $user->phone ?? '-' }}</td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge badge-danger">مدير نظام (Admin)</span>
                            @elseif($user->role === 'moderator')
                                <span class="badge badge-warning">مشرف (Moderator)</span>
                            @else
                                <span class="badge badge-info">مستخدم عادي</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('Y/m/d') }}</td>
                        <td style="text-align: center;">
                            <div style="display: inline-flex; gap: 6px;">
                                <button class="btn btn-secondary btn-icon" onclick="openModal('editUserModal_{{ $user->id }}')" title="تعديل">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-icon" title="حذف">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- Edit User Modal -->
                    <div class="admin-modal-overlay" id="editUserModal_{{ $user->id }}">
                        <div class="admin-modal">
                            <div class="admin-modal-header">
                                <h3 class="admin-modal-title">تعديل بيانات: {{ $user->name }}</h3>
                                <button type="button" class="admin-modal-close" onclick="closeModal('editUserModal_{{ $user->id }}')">&times;</button>
                            </div>
                            <div class="admin-modal-body">
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="form-label">الاسم بالكامل *</label>
                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div class="form-group">
                                            <label class="form-label">البريد الإلكتروني *</label>
                                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required dir="ltr">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">رقم الجوال</label>
                                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" dir="ltr">
                                        </div>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div class="form-group">
                                            <label class="form-label">الدور / الصلاحية</label>
                                            <select name="role" class="form-select">
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>مدير نظام (Admin)</option>
                                                <option value="moderator" {{ $user->role === 'moderator' ? 'selected' : '' }}>مشرف (Moderator)</option>
                                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>مستخدم عادي (User)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">كلمة المرور الجديدة (اتركه فارغاً للإبقاء عليها)</label>
                                            <input type="password" name="password" class="form-control" placeholder="••••••••" dir="ltr">
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                        <button type="button" class="btn btn-secondary" onclick="closeModal('editUserModal_{{ $user->id }}')">إلغاء</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 3rem;">لا يوجد مستخدمون مضافون.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div style="padding: 1.25rem; display: flex; justify-content: center; border-top: 1px solid var(--border-color);">
            {{ $users->links() }}
        </div>
    @endif
</div>

<!-- Add User Modal -->
<div class="admin-modal-overlay" id="addUserModal">
    <div class="admin-modal">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">إضافة مستخدم جديد</h3>
            <button type="button" class="admin-modal-close" onclick="closeModal('addUserModal')">&times;</button>
        </div>
        <div class="admin-modal-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">الاسم بالكامل *</label>
                    <input type="text" name="name" class="form-control" required placeholder="اسم الموظف أو المستخدم">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">البريد الإلكتروني *</label>
                        <input type="email" name="email" class="form-control" required placeholder="user@robotsoft.com" dir="ltr">
                    </div>
                    <div class="form-group">
                        <label class="form-label">رقم الجوال</label>
                        <input type="text" name="phone" class="form-control" placeholder="05XXXXXXXX" dir="ltr">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">نوع الحساب / الدور *</label>
                        <select name="role" class="form-select" required>
                            <option value="admin">مدير نظام (Admin)</option>
                            <option value="moderator">مشرف (Moderator)</option>
                            <option value="user" selected>مستخدم عادي (User)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">كلمة المرور *</label>
                        <input type="password" name="password" class="form-control" required placeholder="6 أحرف على الأقل" dir="ltr">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">إنشاء الحساب</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addUserModal')">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
