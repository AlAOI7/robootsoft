@extends('layouts.app')

@section('title', 'طلب خدمة أو نظام | Robotsoft ERP')
@section('meta_description', 'قدم طلبك للحصول على نظام ERP أو نقاط بيع أو استشارة برمجية مجانية.')

@section('content')
<section class="page-hero">
    <div class="container page-hero-container">
        <h1 class="page-hero-title reveal">طلب خدمة أو استشارة</h1>
        <div class="page-hero-breadcrumbs">
            <a href="{{ route('home') }}">الرئيسية</a><span>/</span><span>طلب خدمة</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container" style="max-width: 850px;">
        <div class="reveal" style="background: var(--bg-card); padding: 3rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
            <div style="text-align: center; margin-bottom: 2.5rem;">
                <span class="section-tag">استشارة وعرض مجاني</span>
                <h2 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 0.5rem;">ابدأ التحول الرقمي لمنشأتك اليوم</h2>
                <p style="color: var(--text-secondary); font-size: 0.95rem;">يرجى تزويدنا بالمعلومات الأساسية وسيقوم مستشارنا بالتواصل معك لترتيب عرض حي وتحديد النظام الأنسب.</p>
            </div>

            <form action="{{ route('request-service.submit') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label">اسم المنشأة / الشركة *</label>
                        <input type="text" name="company_name" class="form-control" required value="{{ old('company_name') }}" placeholder="مثال: شركة الأفق للتجارة">
                    </div>

                    <div class="form-group">
                        <label class="form-label">اسم المسؤول / الشخص المعني *</label>
                        <input type="text" name="contact_person" class="form-control" required value="{{ old('contact_person') }}" placeholder="الاسم الكريم">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label">البريد الإلكتروني المهني *</label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="name@company.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label">رقم الجوال للتواصل *</label>
                        <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}" placeholder="05XXXXXXXX" dir="ltr">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label">نوع النظام أو الخدمة المطلوبة *</label>
                        <select name="service_type" class="form-select" required>
                            <option value="">-- اختر الخدمة أو النظام --</option>
                            <option value="نظام ERP شامل (مالي + مستودعات + مبيعات)" {{ request('service') == 'نظام ERP شامل' ? 'selected' : '' }}>نظام ERP شامل (مالي + مستودعات + مبيعات)</option>
                            <option value="نقاط البيع السحابية والكاشير POS" {{ request('service') == 'نقاط البيع السحابية والكاشير POS' ? 'selected' : '' }}>نقاط البيع السحابية والكاشير POS</option>
                            <option value="الربط مع الفاتورة الإلكترونية ZATCA">الربط مع الفاتورة الإلكترونية ZATCA</option>
                            <option value="نظام الموارد البشرية والرواتب HR">نظام الموارد البشرية والرواتب HR</option>
                            <option value="التطوير البرمجي والتخصيص">التطوير البرمجي والتخصيص</option>
                            <option value="استشارة تقنية ودراسة جدوى">استشارة تقنية ودراسة جدوى</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">حجم المنشأة / عدد المستخدمين التقريبي</label>
                        <select name="system_size" class="form-select">
                            <option value="منشأة ناشئة / متناهية الصغر (1-3 مستخدمين)">منشأة ناشئة / متناهية الصغر (1-3 مستخدمين)</option>
                            <option value="منشأة صغيرة (4-10 مستخدمين)">منشأة صغيرة (4-10 مستخدمين)</option>
                            <option value="منشأة متوسطة (11-50 مستخدماً)" selected>منشأة متوسطة (11-50 مستخدماً)</option>
                            <option value="منشأة كبرى (أكثر من 50 مستخدماً)">منشأة كبرى (أكثر من 50 مستخدماً)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">ملاحظات أو متطلبات خاصة ترغب بإضافتها</label>
                    <textarea name="notes" class="form-control" rows="4" placeholder="هل توجد برامج قديمة ترغب بترحيل بياناتها؟ أو عدد الفروع؟">{{ old('notes') }}</textarea>
                </div>

                <div style="margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem;">
                        <i class="fas fa-check-circle" style="margin-left: 8px;"></i> تأكيد إرسال الطلب
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
