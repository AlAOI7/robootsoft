-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: robootsoft
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'أنظمة وتقنية',
  `author` varchar(255) NOT NULL DEFAULT 'فريق Robotsoft',
  `summary` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `views_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (1,'كيف تختار نظام ERP المناسب لحجم منشأتك في 2026؟','how-to-choose-erp-2026','استشارات تقنية','فريق Robotsoft','دليل شامل لاختيار أنظمة تخطيط الموارد بما يتوافق مع ميزانيتك وطبيعة عملياتك.','تعد أنظمة تخطيط موارد المؤسسات (ERP) العمود الفقري لأي منشأة تطمح إلى النمو والاستدامة. في هذا المقال نستعرض أهم المعايير لاختيار النظام الأنسب، بدءاً من قابلية التوسع، مروراً بمتطلبات الفوترة الإلكترونية، وانتهاءً بسهولة الاستخدام والدعم الفني المحلي.','assets/logo.jpeg','2026-09-25 13:50:43',342,'2026-09-30 13:50:43','2026-09-30 13:50:43'),(2,'متطلبات المرحلة الثانية من الفاتورة الإلكترونية ZATCA','zatca-phase-2-requirements','الفوترة الإلكترونية','قسم الامتثال الضريبي','كل ما تحتاج لمعرفته حول مرحلة الربط والتكامل مع منصة فاتورة التابعة لهيئة الزكاة والضريبة.','تتطلب مرحلة الربط والتكامل متطلبات برمجية وأمنية دقيقة تشمل التوقيع الرقمي، رمز الاستجابة السريعة المشفر، ومعرف UUID لكل فاتورة. أنظمة Robotsoft مصممة لتضمن لك الامتثال التام دون أي تعقيد.','assets/logo.jpeg','2026-09-18 13:50:43',890,'2026-09-30 13:50:43','2026-09-30 13:50:43'),(3,'أهمية ذكاء الأعمال (BI) في اتخاذ القرارات الاستراتيجية','importance-of-business-intelligence','ذكاء الأعمال','أحمد المحلل المالي','تحويل البيانات الخام إلى رؤى قابلة للتنفيذ السريع لزيادة أرباح شركتك وتخفيض التكاليف.','لا يكفي مجرد جمع البيانات، بل تكمن القوة في تحليلها وعرضها عبر لوحات تحكم تفاعلية توضح اتجاهات المبيعات وأداء الموظفين وإدارة السيولة بدقة فائقة.','assets/logo.jpeg','2026-09-10 13:50:43',520,'2026-09-30 13:50:43','2026-09-30 13:50:43');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `testimonial` text DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'شركة الأفق القابضة','assets/logo.jpeg','التجارة والمقاولات','أنظمة روبوت سوفت غيرت طريقة إدارتنا بالكامل، وفرنا أكثر من 40% من الوقت المستغرق في إعداد التقارير المالية.',5,'2026-09-30 13:50:43','2026-09-30 13:50:43'),(2,'سلسلة مطاعم التميمي','assets/logo.jpeg','الأغذية والمشروبات','نقاط البيع السحابية وسرعة الربط مع هيئة الزكاة والضريبة كانت مذهلة ومريحة جداً.',5,'2026-09-30 13:50:43','2026-09-30 13:50:43'),(3,'مجموعة الراية الطبية','assets/logo.jpeg','الرعاية الصحية','دعم فني استثنائي وتدريب احترافي لجميع كوادرنا الطبية والإدارية.',5,'2026-09-30 13:50:43','2026-09-30 13:50:43'),(4,'شركة النماء اللوجستية','assets/logo.jpeg','النقل واللوجستيات','إدارة المستودعات وحركة الشاحنات أصبحت تجري بسلاسة متناهية.',5,'2026-09-30 13:50:43','2026-09-30 13:50:43');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,'عبدالله السالم','client1@example.com','+966551234567','استفسار عن نظام نقاط البيع للمطاعم','السلام عليكم، نود الاستفسار عن باقات نظام الكاشير وإمكانية ربطه مع أجهزة نقاط البيع لدينا.',0,'2026-09-30 13:50:43','2026-09-30 13:50:43');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2026_09_29_171316_create_services_table',1),(6,'2026_09_29_171317_create_projects_table',1),(7,'2026_09_29_171318_create_blog_posts_table',1),(8,'2026_09_29_171318_create_clients_table',1),(9,'2026_09_29_171319_create_contact_messages_table',1),(10,'2026_09_29_171320_create_service_requests_table',1),(11,'2026_09_29_171320_create_settings_table',1),(12,'2026_09_29_175450_add_role_to_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `completion_date` date DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'مجموعة الأركان للتجارة','erp','شركة الأركان التجارية','assets/logo.jpeg','تهيئة نظام ERP متكامل يشمل المحاسبة، المبيعات، المشتريات والمستودعات لمجموعة ذات 7 فروع.','#','2025-11-15',1,'2026-09-30 13:50:42','2026-09-30 13:50:42'),(2,'سلسلة مطاعم التميمي','pos','مؤسسة التميمي للأغذية','assets/logo.jpeg','نظام POS سحابي لـ 15 فرع مطعم مع ربط ZATCA وإدارة الطلبات وشاشات المطبخ الذكية.','#','2026-01-20',1,'2026-09-30 13:50:42','2026-09-30 13:50:42'),(3,'بوابة الموردين الإلكترونية','web','شركة أفق الصناعية','assets/logo.jpeg','منصة ويب متكاملة للتواصل مع الموردين ومتابعة أوامر الشراء والفواتير لحظياً.','#','2026-03-10',1,'2026-09-30 13:50:42','2026-09-30 13:50:42'),(4,'لوحة معلومات ذكاء الأعمال BI','bi','مستشفى الشفاء التخصصي','assets/logo.jpeg','لوحات قيادة تفاعلية ومؤشرات أداء متقدمة لاتخاذ القرارات الإدارية والمالية بدقة.','#','2026-05-01',0,'2026-09-30 13:50:42','2026-09-30 13:50:42');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_requests`
--

DROP TABLE IF EXISTS `service_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `system_size` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'جديد',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_requests`
--

LOCK TABLES `service_requests` WRITE;
/*!40000 ALTER TABLE `service_requests` DISABLE KEYS */;
INSERT INTO `service_requests` VALUES (1,'شركة الأركان التجارية','محمد الأحمد','tech@alarkan.com','+966567890123','التركيب والتهيئة','متوسط (10-50 مستخدم)','نحتاج لترحيل البيانات من نظام محاسبي قديم والربط مع ZATCA.','جديد','2026-09-30 13:50:43','2026-09-30 13:50:43');
/*!40000 ALTER TABLE `service_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'الاستشارات التقنية','consulting','fas fa-lightbulb','فريق من المستشارين المحترفين يحلل احتياجاتك ويضع خطة التحول الرقمي المثلى لمنشأتك.','[\"\\u062a\\u062d\\u0644\\u064a\\u0644 \\u0628\\u064a\\u0626\\u0629 \\u0627\\u0644\\u0639\\u0645\\u0644 \\u0627\\u0644\\u062d\\u0627\\u0644\\u064a\\u0629\",\"\\u0648\\u0636\\u0639 \\u062e\\u0627\\u0631\\u0637\\u0629 \\u0637\\u0631\\u064a\\u0642 \\u0631\\u0642\\u0645\\u064a\\u0629\",\"\\u062f\\u0631\\u0627\\u0633\\u0629 \\u0627\\u0644\\u062c\\u062f\\u0648\\u0649 \\u0627\\u0644\\u062a\\u0642\\u0646\\u064a\\u0629\",\"\\u062a\\u062d\\u062f\\u064a\\u062f \\u0627\\u0644\\u0645\\u062a\\u0637\\u0644\\u0628\\u0627\\u062a \\u0628\\u062f\\u0642\\u0629\"]',1,1,'2026-09-30 13:50:42','2026-09-30 13:50:42'),(2,'التركيب والتهيئة','setup','fas fa-cogs','نتولى تركيب الأنظمة وضبط الإعدادات وترحيل البيانات من أنظمتك القديمة بسلاسة تامة.','[\"\\u062a\\u0647\\u064a\\u0626\\u0629 \\u0627\\u0644\\u062e\\u0648\\u0627\\u062f\\u0645 \\u0648\\u0642\\u0648\\u0627\\u0639\\u062f \\u0627\\u0644\\u0628\\u064a\\u0627\\u0646\\u0627\\u062a\",\"\\u062a\\u0631\\u062d\\u064a\\u0644 \\u0648\\u062a\\u0646\\u0638\\u064a\\u0641 \\u0627\\u0644\\u0628\\u064a\\u0627\\u0646\\u0627\\u062a\",\"\\u0625\\u0639\\u062f\\u0627\\u062f \\u0627\\u0644\\u0635\\u0644\\u0627\\u062d\\u064a\\u0627\\u062a \\u0648\\u0627\\u0644\\u0623\\u0645\\u0627\\u0646\",\"\\u0627\\u062e\\u062a\\u0628\\u0627\\u0631 \\u0627\\u0644\\u062c\\u0627\\u0647\\u0632\\u064a\\u0629\"]',1,2,'2026-09-30 13:50:42','2026-09-30 13:50:42'),(3,'التطوير والتخصيص','development','fas fa-code','تخصيص الأنظمة لتناسب طبيعة عملك وتطوير وحدات إضافية تلبي متطلباتك الخاصة.','[\"\\u0628\\u0631\\u0645\\u062c\\u0629 \\u0648\\u062d\\u062f\\u0627\\u062a \\u0645\\u062e\\u0635\\u0635\\u0629\",\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0633\\u064a\\u0631 \\u0627\\u0644\\u0639\\u0645\\u0644\",\"\\u062a\\u0635\\u0645\\u064a\\u0645 \\u062a\\u0642\\u0627\\u0631\\u064a\\u0631 \\u062e\\u0627\\u0635\\u0629\",\"\\u062a\\u0637\\u0648\\u064a\\u0631 \\u0648\\u0627\\u062c\\u0647\\u0627\\u062a \\u0645\\u062e\\u0635\\u0635\\u0629\"]',1,3,'2026-09-30 13:50:42','2026-09-30 13:50:42'),(4,'التدريب والتأهيل','training','fas fa-graduation-cap','برامج تدريبية شاملة حضورية وعن بُعد لكافة مستويات الموظفين لضمان الاستفادة القصوى.','[\"\\u062a\\u062f\\u0631\\u064a\\u0628 \\u0639\\u0645\\u0644\\u064a \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645\",\"\\u0643\\u062a\\u064a\\u0628\\u0627\\u062a \\u0648\\u0623\\u062f\\u0644\\u0629 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645\",\"\\u062c\\u0644\\u0633\\u0627\\u062a \\u062a\\u0641\\u0627\\u0639\\u0644\\u064a\\u0629 \\u0645\\u0633\\u062c\\u0644\\u0629\",\"\\u0634\\u0647\\u0627\\u062f\\u0627\\u062a \\u0625\\u062a\\u0645\\u0627\\u0645 \\u062a\\u062f\\u0631\\u064a\\u0628\"]',1,4,'2026-09-30 13:50:42','2026-09-30 13:50:42'),(5,'الدعم الفني المستمر','support','fas fa-headset','فريق دعم متاح على مدار الساعة عبر الهاتف والبريد الإلكتروني والواتساب لحل أي مشكلة فور ظهورها.','[\"\\u062f\\u0639\\u0645 24\\/7 \\u0637\\u0648\\u0627\\u0644 \\u0627\\u0644\\u0623\\u0633\\u0628\\u0648\\u0639\",\"\\u062a\\u0630\\u0627\\u0643\\u0631 \\u062f\\u0639\\u0645 \\u0630\\u0627\\u062a \\u0623\\u0648\\u0644\\u0648\\u064a\\u0629\",\"\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0648\\u062a\\u062d\\u062f\\u064a\\u062b\\u0627\\u062a \\u062f\\u0648\\u0631\\u064a\\u0629\",\"\\u0646\\u0633\\u062e \\u0627\\u062d\\u062a\\u064a\\u0627\\u0637\\u064a \\u062a\\u0644\\u0642\\u0627\\u0626\\u064a\"]',1,5,'2026-09-30 13:50:42','2026-09-30 13:50:42'),(6,'التكامل والربط مع الأنظمة','integration','fas fa-network-wired','ربط أنظمة Robotsoft مع منصات خارجية كالتجارة الإلكترونية، ZATCA، بوابات الدفع، وأجهزة الحضور.','[\"\\u0631\\u0628\\u0637 \\u0627\\u0644\\u0641\\u0627\\u062a\\u0648\\u0631\\u0629 \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\\u0629 ZATCA\",\"\\u0631\\u0628\\u0637 \\u0645\\u0646\\u0635\\u0627\\u062a \\u0627\\u0644\\u0645\\u062a\\u0627\\u062c\\u0631 \\u0633\\u0644\\u0629 \\u0648\\u0632\\u062f\",\"\\u0631\\u0628\\u0637 \\u0628\\u0648\\u0627\\u0628\\u0627\\u062a \\u0627\\u0644\\u062f\\u0641\\u0639 \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"\\u0623\\u062c\\u0647\\u0632\\u0629 \\u0627\\u0644\\u0628\\u0635\\u0645\\u0629 \\u0648\\u0627\\u0644\\u062a\\u062d\\u0643\\u0645 \\u0628\\u0627\\u0644\\u062f\\u062e\\u0648\\u0644\"]',1,6,'2026-09-30 13:50:42','2026-09-30 13:50:42');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_name','Robotsoft ERP | روبوت سوفت','general','2026-09-30 13:50:43','2026-09-30 13:50:43'),(2,'site_desc','حلول برمجية وأنظمة ERP متكاملة للشركات والمؤسسات','general','2026-09-30 13:50:43','2026-09-30 13:50:43'),(3,'contact_email','info@robotsoft.com','contact','2026-09-30 13:50:43','2026-09-30 13:50:43'),(4,'contact_phone','+966 50 123 4567','contact','2026-09-30 13:50:43','2026-09-30 13:50:43'),(5,'whatsapp_number','+966501234567','contact','2026-09-30 13:50:43','2026-09-30 13:50:43'),(6,'address','المملكة العربية السعودية - الرياض','contact','2026-09-30 13:50:43','2026-09-30 13:50:43'),(7,'working_hours','الأحد - الخميس: 9:00 ص - 6:00 م','general','2026-09-30 13:50:43','2026-09-30 13:50:43'),(8,'twitter','https://twitter.com/robotsoft','social','2026-09-30 13:50:43','2026-09-30 13:50:43'),(9,'linkedin','https://linkedin.com/company/robotsoft','social','2026-09-30 13:50:43','2026-09-30 13:50:43'),(10,'facebook','https://facebook.com/robotsoft','social','2026-09-30 13:50:43','2026-09-30 13:50:43');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `avatar` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'المدير العام','admin@robotsoft.com','+966500000000',NULL,'$2y$10$Sd.z7379DdXGdCcK7SHnkOFec9Hpo8Q.QNBKjYQg5lTEwY2VJEHva','admin',NULL,'active',NULL,'2026-09-30 13:50:42','2026-09-30 13:50:42'),(2,'أحمد الدعم الفني','tech@robotsoft.com','+966501111111',NULL,'$2y$10$ujgebw5WOT5P5nD/571L9eZEaXCu27WasK1LAeWf3D9huJBa0wA4q','moderator',NULL,'active',NULL,'2026-09-30 13:50:42','2026-09-30 13:50:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-30 19:50:54
