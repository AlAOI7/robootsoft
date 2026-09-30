@extends('layouts.app')

@section('title', 'إنشاء حساب جديد | Robotsoft ERP')

@section('content')
<section class="section" style="min-height: 85vh; display: flex; align-items: center;">
    <div class="container" style="max-width: 520px;">
        <div class="reveal" style="background: var(--bg-card); padding: 2.5rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-lg);">
            <div style="text-align: center; margin-bottom: 2rem;">
                <img src="{{ asset('assets/logo.jpeg') }}" alt="Robotsoft Logo" style="width: 56px; height: 56px; border-radius: 12px; margin-bottom: 1rem; box-shadow: 0 4px 12px rgba(37,99,235,0.3);">
                <h1 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 0.25rem;">إنشاء حساب جديد</h1>
                <p style="color: var(--text-secondary); font-size: 0.875rem;">انضم إلى منصة روبوت سوفت لإدارة الأعمال</p>
            </div>

            @if($errors->any())
                <div style="background: rgba(239, 68, 68, 0.15); color: #ef4444; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.85rem;">
                    @foreach($errors->all() as $error)
                        <div><i class="fas fa-exclamation-circle"></i> {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">الاسم بالكامل *</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="أدخل اسمك الكريم">
                </div>

                <div class="form-group">
                    <label class="form-label">البريد الإلكتروني *</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="name@domain.com" dir="ltr">
                </div>

                <div class="form-group">
                    <label class="form-label">رقم الجوال</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="05XXXXXXXX" dir="ltr">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">كلمة المرور *</label>
                        <input type="password" name="password" class="form-control" required placeholder="6 أحرف على الأقل" dir="ltr">
                    </div>

                    <div class="form-group">
                        <label class="form-label">تأكيد كلمة المرور *</label>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="أعد إدخالها" dir="ltr">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-size: 1rem; margin-top: 0.5rem;">
                    إنشاء الحساب الآن
                </button>
            </form>

            <div style="margin-top: 1.5rem; text-align: center; border-top: 1px solid var(--border-color); padding-top: 1.25rem; font-size: 0.875rem;">
                <span style="color: var(--text-secondary);">لديك حساب بالفعل؟</span>
                <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 700; margin-right: 6px;">تسجيل الدخول</a>
            </div>
        </div>
    </div>
</section>
@endsection
