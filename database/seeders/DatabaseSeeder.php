<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Service;
use App\Models\Project;
use App\Models\Client;
use App\Models\BlogPost;
use App\Models\Setting;
use App\Models\ContactMessage;
use App\Models\ServiceRequest;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Users
        User::firstOrCreate(
            ['email' => 'admin@robotsoft.com'],
            [
                'name' => 'المدير العام',
                'phone' => '+966500000000',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        User::firstOrCreate(
            ['email' => 'tech@robotsoft.com'],
            [
                'name' => 'أحمد الدعم الفني',
                'phone' => '+966501111111',
                'password' => Hash::make('password'),
                'role' => 'moderator',
                'status' => 'active',
            ]
        );

        // 2. Services
        $services = [
            [
                'title' => 'الاستشارات التقنية',
                'category' => 'consulting',
                'icon' => 'fas fa-lightbulb',
                'description' => 'فريق من المستشارين المحترفين يحلل احتياجاتك ويضع خطة التحول الرقمي المثلى لمنشأتك.',
                'features' => ['تحليل بيئة العمل الحالية', 'وضع خارطة طريق رقمية', 'دراسة الجدوى التقنية', 'تحديد المتطلبات بدقة'],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'التركيب والتهيئة',
                'category' => 'setup',
                'icon' => 'fas fa-cogs',
                'description' => 'نتولى تركيب الأنظمة وضبط الإعدادات وترحيل البيانات من أنظمتك القديمة بسلاسة تامة.',
                'features' => ['تهيئة الخوادم وقواعد البيانات', 'ترحيل وتنظيف البيانات', 'إعداد الصلاحيات والأمان', 'اختبار الجاهزية'],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'التطوير والتخصيص',
                'category' => 'development',
                'icon' => 'fas fa-code',
                'description' => 'تخصيص الأنظمة لتناسب طبيعة عملك وتطوير وحدات إضافية تلبي متطلباتك الخاصة.',
                'features' => ['برمجة وحدات مخصصة', 'تعديل سير العمل', 'تصميم تقارير خاصة', 'تطوير واجهات مخصصة'],
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'التدريب والتأهيل',
                'category' => 'training',
                'icon' => 'fas fa-graduation-cap',
                'description' => 'برامج تدريبية شاملة حضورية وعن بُعد لكافة مستويات الموظفين لضمان الاستفادة القصوى.',
                'features' => ['تدريب عملي على النظام', 'كتيبات وأدلة استخدام', 'جلسات تفاعلية مسجلة', 'شهادات إتمام تدريب'],
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'الدعم الفني المستمر',
                'category' => 'support',
                'icon' => 'fas fa-headset',
                'description' => 'فريق دعم متاح على مدار الساعة عبر الهاتف والبريد الإلكتروني والواتساب لحل أي مشكلة فور ظهورها.',
                'features' => ['دعم 24/7 طوال الأسبوع', 'تذاكر دعم ذات أولوية', 'صيانة وتحديثات دورية', 'نسخ احتياطي تلقائي'],
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'التكامل والربط مع الأنظمة',
                'category' => 'integration',
                'icon' => 'fas fa-network-wired',
                'description' => 'ربط أنظمة Robotsoft مع منصات خارجية كالتجارة الإلكترونية، ZATCA، بوابات الدفع، وأجهزة الحضور.',
                'features' => ['ربط الفاتورة الإلكترونية ZATCA', 'ربط منصات المتاجر سلة وزد', 'ربط بوابات الدفع الإلكتروني', 'أجهزة البصمة والتحكم بالدخول'],
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::updateOrCreate(['title' => $serviceData['title']], $serviceData);
        }

        // 3. Projects
        $projects = [
            [
                'title' => 'مجموعة الأركان للتجارة',
                'category' => 'erp',
                'client_name' => 'شركة الأركان التجارية',
                'image' => 'assets/logo.jpeg',
                'description' => 'تهيئة نظام ERP متكامل يشمل المحاسبة، المبيعات، المشتريات والمستودعات لمجموعة ذات 7 فروع.',
                'link' => '#',
                'completion_date' => '2025-11-15',
                'is_featured' => true,
            ],
            [
                'title' => 'سلسلة مطاعم التميمي',
                'category' => 'pos',
                'client_name' => 'مؤسسة التميمي للأغذية',
                'image' => 'assets/logo.jpeg',
                'description' => 'نظام POS سحابي لـ 15 فرع مطعم مع ربط ZATCA وإدارة الطلبات وشاشات المطبخ الذكية.',
                'link' => '#',
                'completion_date' => '2026-01-20',
                'is_featured' => true,
            ],
            [
                'title' => 'بوابة الموردين الإلكترونية',
                'category' => 'web',
                'client_name' => 'شركة أفق الصناعية',
                'image' => 'assets/logo.jpeg',
                'description' => 'منصة ويب متكاملة للتواصل مع الموردين ومتابعة أوامر الشراء والفواتير لحظياً.',
                'link' => '#',
                'completion_date' => '2026-03-10',
                'is_featured' => true,
            ],
            [
                'title' => 'لوحة معلومات ذكاء الأعمال BI',
                'category' => 'bi',
                'client_name' => 'مستشفى الشفاء التخصصي',
                'image' => 'assets/logo.jpeg',
                'description' => 'لوحات قيادة تفاعلية ومؤشرات أداء متقدمة لاتخاذ القرارات الإدارية والمالية بدقة.',
                'link' => '#',
                'completion_date' => '2026-05-01',
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $projectData) {
            Project::updateOrCreate(['title' => $projectData['title']], $projectData);
        }

        // 4. Clients
        $clients = [
            [
                'name' => 'شركة الأفق القابضة',
                'logo' => 'assets/logo.jpeg',
                'industry' => 'التجارة والمقاولات',
                'testimonial' => 'أنظمة روبوت سوفت غيرت طريقة إدارتنا بالكامل، وفرنا أكثر من 40% من الوقت المستغرق في إعداد التقارير المالية.',
                'rating' => 5,
            ],
            [
                'name' => 'سلسلة مطاعم التميمي',
                'logo' => 'assets/logo.jpeg',
                'industry' => 'الأغذية والمشروبات',
                'testimonial' => 'نقاط البيع السحابية وسرعة الربط مع هيئة الزكاة والضريبة كانت مذهلة ومريحة جداً.',
                'rating' => 5,
            ],
            [
                'name' => 'مجموعة الراية الطبية',
                'logo' => 'assets/logo.jpeg',
                'industry' => 'الرعاية الصحية',
                'testimonial' => 'دعم فني استثنائي وتدريب احترافي لجميع كوادرنا الطبية والإدارية.',
                'rating' => 5,
            ],
            [
                'name' => 'شركة النماء اللوجستية',
                'logo' => 'assets/logo.jpeg',
                'industry' => 'النقل واللوجستيات',
                'testimonial' => 'إدارة المستودعات وحركة الشاحنات أصبحت تجري بسلاسة متناهية.',
                'rating' => 5,
            ],
        ];

        foreach ($clients as $clientData) {
            Client::updateOrCreate(['name' => $clientData['name']], $clientData);
        }

        // 5. Blog Posts
        $posts = [
            [
                'title' => 'كيف تختار نظام ERP المناسب لحجم منشأتك في 2026؟',
                'slug' => 'how-to-choose-erp-2026',
                'category' => 'استشارات تقنية',
                'author' => 'فريق Robotsoft',
                'summary' => 'دليل شامل لاختيار أنظمة تخطيط الموارد بما يتوافق مع ميزانيتك وطبيعة عملياتك.',
                'content' => 'تعد أنظمة تخطيط موارد المؤسسات (ERP) العمود الفقري لأي منشأة تطمح إلى النمو والاستدامة. في هذا المقال نستعرض أهم المعايير لاختيار النظام الأنسب، بدءاً من قابلية التوسع، مروراً بمتطلبات الفوترة الإلكترونية، وانتهاءً بسهولة الاستخدام والدعم الفني المحلي.',
                'image' => 'assets/logo.jpeg',
                'published_at' => now()->subDays(5),
                'views_count' => 342,
            ],
            [
                'title' => 'متطلبات المرحلة الثانية من الفاتورة الإلكترونية ZATCA',
                'slug' => 'zatca-phase-2-requirements',
                'category' => 'الفوترة الإلكترونية',
                'author' => 'قسم الامتثال الضريبي',
                'summary' => 'كل ما تحتاج لمعرفته حول مرحلة الربط والتكامل مع منصة فاتورة التابعة لهيئة الزكاة والضريبة.',
                'content' => 'تتطلب مرحلة الربط والتكامل متطلبات برمجية وأمنية دقيقة تشمل التوقيع الرقمي، رمز الاستجابة السريعة المشفر، ومعرف UUID لكل فاتورة. أنظمة Robotsoft مصممة لتضمن لك الامتثال التام دون أي تعقيد.',
                'image' => 'assets/logo.jpeg',
                'published_at' => now()->subDays(12),
                'views_count' => 890,
            ],
            [
                'title' => 'أهمية ذكاء الأعمال (BI) في اتخاذ القرارات الاستراتيجية',
                'slug' => 'importance-of-business-intelligence',
                'category' => 'ذكاء الأعمال',
                'author' => 'أحمد المحلل المالي',
                'summary' => 'تحويل البيانات الخام إلى رؤى قابلة للتنفيذ السريع لزيادة أرباح شركتك وتخفيض التكاليف.',
                'content' => 'لا يكفي مجرد جمع البيانات، بل تكمن القوة في تحليلها وعرضها عبر لوحات تحكم تفاعلية توضح اتجاهات المبيعات وأداء الموظفين وإدارة السيولة بدقة فائقة.',
                'image' => 'assets/logo.jpeg',
                'published_at' => now()->subDays(20),
                'views_count' => 520,
            ],
        ];

        foreach ($posts as $postData) {
            BlogPost::updateOrCreate(['slug' => $postData['slug']], $postData);
        }

        // 6. Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Robotsoft ERP | روبوت سوفت', 'group' => 'general'],
            ['key' => 'site_desc', 'value' => 'حلول برمجية وأنظمة ERP متكاملة للشركات والمؤسسات', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'info@robotsoft.com', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+966 50 123 4567', 'group' => 'contact'],
            ['key' => 'whatsapp_number', 'value' => '+966501234567', 'group' => 'contact'],
            ['key' => 'address', 'value' => 'المملكة العربية السعودية - الرياض', 'group' => 'contact'],
            ['key' => 'working_hours', 'value' => 'الأحد - الخميس: 9:00 ص - 6:00 م', 'group' => 'general'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/robotsoft', 'group' => 'social'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/company/robotsoft', 'group' => 'social'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/robotsoft', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 7. Sample Contact Messages
        ContactMessage::firstOrCreate(
            ['email' => 'client1@example.com'],
            [
                'name' => 'عبدالله السالم',
                'phone' => '+966551234567',
                'subject' => 'استفسار عن نظام نقاط البيع للمطاعم',
                'message' => 'السلام عليكم، نود الاستفسار عن باقات نظام الكاشير وإمكانية ربطه مع أجهزة نقاط البيع لدينا.',
                'is_read' => false,
            ]
        );

        // 8. Sample Service Request
        ServiceRequest::firstOrCreate(
            ['email' => 'tech@alarkan.com'],
            [
                'company_name' => 'شركة الأركان التجارية',
                'contact_person' => 'محمد الأحمد',
                'phone' => '+966567890123',
                'service_type' => 'التركيب والتهيئة',
                'system_size' => 'متوسط (10-50 مستخدم)',
                'notes' => 'نحتاج لترحيل البيانات من نظام محاسبي قديم والربط مع ZATCA.',
                'status' => 'جديد',
            ]
        );
    }
}
