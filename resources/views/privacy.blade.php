@extends('layouts.app')

@section('title', 'سياسة الخصوصية وسرية البيانات | Robotsoft ERP')

@section('content')
<section class="page-hero">
    <div class="container page-hero-container">
        <h1 class="page-hero-title reveal">سياسة الخصوصية وحماية البيانات</h1>
        <div class="page-hero-breadcrumbs">
            <a href="{{ route('home') }}">الرئيسية</a><span>/</span><span>سياسة الخصوصية</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container" style="max-width: 900px;">
        <div class="reveal" style="background: var(--bg-card); padding: 2.5rem; border-radius: 16px; border: 1px solid var(--border-color); line-height: 1.9; color: var(--text-secondary);">
            <h3 style="color: var(--text-primary); font-size: 1.3rem; margin-bottom: 1rem;">1. التزامنا تجاه خصوصية بياناتك</h3>
            <p>
                نحن في Robotsoft ERP ندرك أهمية وسرية البيانات المالية والتشغيلية لمنشأتك. نلتزم بأعلى معايير الأمن السيبراني والتشريعات المنظمة لحماية البيانات الشخصية والتجارية.
            </p>

            <h3 style="color: var(--text-primary); font-size: 1.3rem; margin: 1.5rem 0 1rem;">2. البيانات التي يتم جمعها</h3>
            <p>
                نقوم بجمع المعلومات الضرورية فقط لتشغيل الأنظمة وتقديم الدعم الفني، وتشمل: معلومات الاتصال بالمسؤولين، سجلات تسجيل الدخول التشغيلية لأغراض التدقيق والأمان، والبيانات الفنية الخاصة بالأجهزة المتصلة.
            </p>

            <h3 style="color: var(--text-primary); font-size: 1.3rem; margin: 1.5rem 0 1rem;">3. ملكية البيانات وسريتها</h3>
            <p>
                جميع البيانات المدخلة في أنظمتك من حسابات وفواتير وبيانات عملاء وموظفين هي ملك خالص وحصري لمنشأتك، ولا يحق لـ Robotsoft أو أي طرف ثالث الاطلاع عليها أو استخدامها دون تفويض كتابي صريح لأغراض الدعم الفني.
            </p>

            <h3 style="color: var(--text-primary); font-size: 1.3rem; margin: 1.5rem 0 1rem;">4. النسخ الاحتياطي والأمان</h3>
            <p>
                تُحفظ البيانات السحابية في خوادم مشفرة متوافقة مع ضوابط الأمن السيبراني الوطنية، وتُجرى عمليات نسخ احتياطي تلقائي مشفرة يومياً وأسبوعياً مع إمكانية استعادة البيانات الفورية في أي وقت.
            </p>
        </div>
    </div>
</section>
@endsection
