@extends('layouts.admin')

@section('title', 'الإعدادات العامة للنظام')

@section('content')
<div class="page-header">
    <div class="page-title-box">
        <h1>إعدادات النظام والموقع</h1>
        <p>التحكم في بيانات التواصل والشبكات الاجتماعية ومعلومات موقع Robotsoft ERP</p>
    </div>
</div>

<div class="form-card" style="max-width: 900px;">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        
        <!-- General Info -->
        <h3 style="font-size: 1.2rem; font-weight: 800; margin-bottom: 1.25rem; color: var(--primary); display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-info-circle"></i> المعلومات الأساسية
        </h3>

        <div class="form-group">
            <label class="form-label">اسم الموقع / النظام</label>
            <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'Robotsoft ERP | روبوت سوفت' }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">الوصف العام (SEO Meta Description)</label>
            <textarea name="site_desc" class="form-control" rows="2">{{ $settings['site_desc'] ?? 'حلول برمجية وأنظمة ERP متكاملة للشركات والمؤسسات' }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">مواعيد وساعات العمل</label>
            <input type="text" name="working_hours" class="form-control" value="{{ $settings['working_hours'] ?? 'الأحد - الخميس: 9:00 ص - 6:00 م' }}">
        </div>

        <hr style="border: none; border-top: 1px solid var(--border-color); margin: 2rem 0;">

        <!-- Contact Info -->
        <h3 style="font-size: 1.2rem; font-weight: 800; margin-bottom: 1.25rem; color: var(--primary); display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-address-book"></i> قنوات وبيانات التواصل
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">البريد الإلكتروني الرسمي</label>
                <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? 'info@robotsoft.com' }}" dir="ltr">
            </div>

            <div class="form-group">
                <label class="form-label">رقم الهاتف / الاتصال</label>
                <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '+966 50 123 4567' }}" dir="ltr">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">رقم الواتساب (مع رمز الدولة بدون +)</label>
                <input type="text" name="whatsapp_number" class="form-control" value="{{ $settings['whatsapp_number'] ?? '966501234567' }}" dir="ltr">
            </div>

            <div class="form-group">
                <label class="form-label">العنوان / المقر</label>
                <input type="text" name="address" class="form-control" value="{{ $settings['address'] ?? 'المملكة العربية السعودية - الرياض' }}">
            </div>
        </div>

        <hr style="border: none; border-top: 1px solid var(--border-color); margin: 2rem 0;">

        <!-- Social Media -->
        <h3 style="font-size: 1.2rem; font-weight: 800; margin-bottom: 1.25rem; color: var(--primary); display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-share-alt"></i> روابط وسائل التواصل الاجتماعي
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label class="form-label"><i class="fab fa-twitter" style="color: #1da1f2;"></i> تويتر (X)</label>
                <input type="text" name="twitter" class="form-control" value="{{ $settings['twitter'] ?? '' }}" placeholder="https://x.com/..." dir="ltr">
            </div>

            <div class="form-group">
                <label class="form-label"><i class="fab fa-linkedin" style="color: #0077b5;"></i> لينكد إن</label>
                <input type="text" name="linkedin" class="form-control" value="{{ $settings['linkedin'] ?? '' }}" placeholder="https://linkedin.com/..." dir="ltr">
            </div>

            <div class="form-group">
                <label class="form-label"><i class="fab fa-facebook" style="color: #4267b2;"></i> فيسبوك</label>
                <input type="text" name="facebook" class="form-control" value="{{ $settings['facebook'] ?? '' }}" placeholder="https://facebook.com/..." dir="ltr">
            </div>
        </div>

        <div class="form-actions" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="padding: 0.85rem 2rem;">
                <i class="fas fa-save" style="margin-left: 8px;"></i> حفظ التعديلات
            </button>
        </div>
    </form>
</div>
@endsection
