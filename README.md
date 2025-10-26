<<<<<<< HEAD
# IDEA Group Website

## Overview
IDEA Group Website is a multilingual marketing site built with Laravel 10 for showcasing the group's brands, services, and case work. The project delivers a polished front-end experience with localized content in English and Arabic, rich media sections, and interactive components such as client logo sliders and animated company cards.

## Key Features
- ✨ Responsive front-end built with Blade templates and Bootstrap utility classes.
- 🌍 Full Arabic/English localization using Laravel's translation system.
- 🧭 Dynamic About page with interactive company tabs and animated visual grid.
- 🧩 Modular components for services, contact, and website subpages.
- 📄 PDF-ready styling support via `dompdf/dompdf` for printable assets.
- 🔒 API-ready authentication scaffolding using Laravel Sanctum.

## Tech Stack
- **Framework:** Laravel 10 (PHP 8.1+)
- **Front-end:** Blade, Bootstrap 5 utility classes, custom SCSS/CSS, Swiper.js
- **Tooling:** Composer, Laravel Mix/Vite (depending on your build preference), npm
- **Testing & QA:** PHPUnit, Laravel Pint, Collision

## Getting Started

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js & npm (for asset compilation)
- MySQL or another Laravel-supported database

### Local Setup
```bash
git clone <repository-url>
cd idea
composer install
cp .env.example .env
php artisan key:generate
```

Configure `.env` with your database and mail credentials, then run:
```bash
php artisan migrate --seed   # if seeders are available
npm install
npm run dev                  # or npm run build for production assets
php artisan serve
```
Visit `http://localhost:8000` (or your configured host) to view the site.

## Localization Workflow
- Translation files live under `resources/lang/en` and `resources/lang/ar`.
- Use the same keys across languages; fallback strings should live in English.
- Run `php artisan cache:clear` after editing translation files in production to ensure updates propagate.

## Deployment Notes
- Ensure the storage directory is writable (`php artisan storage:link` if serving uploaded assets).
- Compile production assets with `npm run build` (or `npm run prod` if using Mix).
- Cache configuration for performance:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```

## Contributing
1. Fork the repository.
2. Create a feature branch (`git checkout -b feature/amazing-feature`).
3. Commit your changes with clear messages.
4. Push to the branch and open a Pull Request.
5. Please run `npm run lint` (if configured) and `php artisan test` before submitting.

## License
This project is distributed under the MIT License. See the `LICENSE` file (or add one) for details.

---

## نظرة عامة (Arabic Overview)
مشروع **IDEA Group Website** هو موقع تسويقي متعدد اللغات مبني بإطار Laravel، يقدّم تجربة مستخدم احترافية لعرض العلامة التجارية وخدماتها. يدعم الموقع اللغة العربية والإنجليزية، ويحتوي على صفحات مخصّصة للتعريف بالشركة، الخدمات، التواصل، وغيرها مع عناصر تفاعلية ومرئيات جذابة.

## مميزات أساسية
- واجهة متجاوبة تمت برمجتها باستخدام Blade و Bootstrap.
- دعم كامل للترجمة (العربية/الإنجليزية) عبر نظام الترجمات في Laravel.
- صفحة "من نحن" تفاعلية مع تبويب للشركات وصور متحركة.
- هيكلية واضحة للصفحات الثانوية مثل الخدمات والتواصل والموقع الإلكتروني.
- تكامل مع حزمة `dompdf` لإخراج الملفات بصيغة PDF عند الحاجة.
- جاهزية لواجهات برمجة التطبيقات باستخدام Laravel Sanctum.

## خطوات الإعداد السريع
1. تثبيت المتطلبات (`composer install` و `npm install`).
2. إعداد ملف البيئة `.env` وتشغيل `php artisan key:generate`.
3. تنفيذ الهجرات وتشغيل الخادم المحلي عبر `php artisan serve`.
4. تشغيل `npm run dev` لتجميع الملفات الأمامية أثناء التطوير.

## ملاحظات إضافية
- التعديلات على ملفات الترجمة تتطلب مسح الذاكرة المؤقتة في بيئة الإنتاج.
- تأكد من ربط مجلد التخزين (`php artisan storage:link`) قبل النشر.
- استخدم أوامر الكاش (`config:cache`، `route:cache`، `view:cache`) لتحسين الأداء بعد النشر.

للاستفسارات أو الدعم، يرجى فتح تذكرة (Issue) على المستودع أو التواصل مع فريق التطوير.
*** End Patch
=======
# idea
idea group website
>>>>>>> 96144f58f1e8ba8cb51ca6265c5d700e50b32ce7
