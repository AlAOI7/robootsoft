@extends('layouts.app')

@section('title', 'الأسئلة الشائعة | Robotsoft ERP')

@section('content')
<section class="page-hero">
    <div class="container page-hero-container">
        <h1 class="page-hero-title reveal">الأسئلة الأكثر شيوعاً</h1>
        <div class="page-hero-breadcrumbs">
            <a href="{{ route('home') }}">الرئيسية</a><span>/</span><span>الأسئلة الشائعة</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container" style="max-width: 900px;">
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="feature-card reveal" style="padding: 1.75rem; background: var(--bg-card); border-radius: 12px;">
                <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--primary); margin-bottom: 0.5rem;">
                    <i class="fas fa-question-circle" style="margin-left: 8px;"></i> هل أنظمة Robotsoft متوافقة مع متطلبات هيئة الزكاة (ZATCA)؟
                </h3>
                <p style="color: var(--text-secondary); line-height: 1.8; margin: 0;">
                    نعم، أنظمتنا معتمدة ومطابقة تماماً لمتطلبات المرحلتين الأولى والثانية (الربط والتكامل) من الفاتورة الإلكترونية، بما يشمل إنشاء التوقيع الرقمي، وتوليد رمز الاستجابة السريعة (QR Code) المشفر، وربط API التلقائي مع بوابة فاتورة.
                </p>
            </div>

            <div class="feature-card reveal" style="padding: 1.75rem; background: var(--bg-card); border-radius: 12px;">
                <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--primary); margin-bottom: 0.5rem;">
                    <i class="fas fa-question-circle" style="margin-left: 8px;"></i> هل يمكن ترحيل البيانات من نظامنا المحاسبي القديم؟
                </h3>
                <p style="color: var(--text-secondary); line-height: 1.8; margin: 0;">
                    بالتأكيد، يقوم فريق التهيئة المتخصص لدينا بمراجعة ملفات بياناتك السابقة وتنظيفها وتوحيدها ثم استيرادها بالكامل (دليل الحسابات، الأرصدة الافتتاحية، بيانات العملاء والموردين، أصناف المستودعات وأسعارها) دون فقدان أي بيانات.
                </p>
            </div>

            <div class="feature-card reveal" style="padding: 1.75rem; background: var(--bg-card); border-radius: 12px;">
                <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--primary); margin-bottom: 0.5rem;">
                    <i class="fas fa-question-circle" style="margin-left: 8px;"></i> هل يعمل النظام سحابياً أم على خوادم محلية؟
                </h3>
                <p style="color: var(--text-secondary); line-height: 1.8; margin: 0;">
                    نوفر الخيارين معاً! يمكنك الاختيار بين الاستضافة السحابية الآمنة عالية الأداء للوصول للنظام من أي مكان وأي جهاز، أو التركيب على خوادم محلية خاصة بمنشأتك وفق سياسات تكنولوجيا المعلومات لديكم.
                </p>
            </div>

            <div class="feature-card reveal" style="padding: 1.75rem; background: var(--bg-card); border-radius: 12px;">
                <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--primary); margin-bottom: 0.5rem;">
                    <i class="fas fa-question-circle" style="margin-left: 8px;"></i> ما هي طبيعة التدريب والدعم الفني المقدم بعد البيع؟
                </h3>
                <p style="color: var(--text-secondary); line-height: 1.8; margin: 0;">
                    نقدم جلسات تدريبية مكثفة عملية لكافة المستخدمين وإداريي النظام مع كتيبات إرشادية وفيديوهات تعليمية، بالإضافة إلى خط دعم فني مخصص يعمل على مدار الساعة طوال أيام الأسبوع لحل أي استفسار فوراً.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
