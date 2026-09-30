@extends('layouts.app')

@section('title', 'اتصل بنا | Robotsoft ERP')
@section('meta_description', 'تواصل مع فريق مبيعات ودعم Robotsoft ERP للاستفسار عن الأنظمة والحلول التقنية.')

@section('content')
<section class="page-hero">
    <div class="container page-hero-container">
        <h1 class="page-hero-title reveal">اتصل بنا</h1>
        <div class="page-hero-breadcrumbs">
            <a href="{{ route('home') }}">الرئيسية</a><span>/</span><span>اتصل بنا</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem;">
            <!-- Contact Info -->
            <div class="reveal">
                <span class="section-tag">قنوات التواصل المباشرة</span>
                <h2 class="section-title">نحن دائماً هنا <span>للإجابة عن استفساراتك</span></h2>
                <p style="color: var(--text-secondary); margin-bottom: 2rem; line-height: 1.8;">
                    سواء كنت ترغب في استشارة حول نظام مناسب أو طلب عرض سعر أو المساعدة في ربط أنظمتك، فريقنا التقني والمبيعات في خدمتك.
                </p>

                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="display: flex; align-items: flex-start; gap: 1rem; background: var(--bg-card); padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color);">
                        <div style="width: 44px; height: 44px; border-radius: 8px; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem;">مقر الشركة</h4>
                            <p style="font-size: 0.875rem; color: var(--text-secondary); margin: 0;">{{ \App\Models\Setting::get('address', 'الرياض، المملكة العربية السعودية') }}</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1rem; background: var(--bg-card); padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color);">
                        <div style="width: 44px; height: 44px; border-radius: 8px; background: var(--success-soft); color: var(--success); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem;">الهاتف المباشر</h4>
                            <p style="font-size: 0.875rem; color: var(--text-secondary); margin: 0;" dir="ltr">{{ \App\Models\Setting::get('contact_phone', '+966 50 123 4567') }}</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1rem; background: var(--bg-card); padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color);">
                        <div style="width: 44px; height: 44px; border-radius: 8px; background: var(--warning-soft); color: var(--warning); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem;">البريد الإلكتروني</h4>
                            <p style="font-size: 0.875rem; color: var(--text-secondary); margin: 0;">{{ \App\Models\Setting::get('contact_email', 'info@robotsoft.com') }}</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1rem; background: var(--bg-card); padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color);">
                        <div style="width: 44px; height: 44px; border-radius: 8px; background: var(--accent-light); color: var(--accent); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="far fa-clock"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem;">ساعات العمل</h4>
                            <p style="font-size: 0.875rem; color: var(--text-secondary); margin: 0;">{{ \App\Models\Setting::get('working_hours', 'الأحد - الخميس: 9:00 ص - 6:00 م') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="reveal">
                <div style="background: var(--bg-card); padding: 2.5rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                    <h3 style="font-size: 1.4rem; font-weight: 800; margin-bottom: 1.5rem;">أرسل لنا رسالة سريعة</h3>

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">الاسم بالكامل *</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="أدخل اسمك الكريم">
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">البريد الإلكتروني *</label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="name@domain.com">
                            </div>
                            <div class="form-group">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="05XXXXXXXX" dir="ltr">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">موضوع الرسالة</label>
                            <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" placeholder="عن ماذا تود الاستفسار؟">
                        </div>

                        <div class="form-group">
                            <label class="form-label">الرسالة *</label>
                            <textarea name="message" class="form-control" rows="5" required placeholder="اكتب تفاصيل استفسارك هنا...">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-size: 1rem;">
                            <i class="fas fa-paper-plane" style="margin-left: 8px;"></i> إرسال الرسالة الآن
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
