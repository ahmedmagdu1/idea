<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ContentManagementController extends Controller
{
    private $pages = ['welcome', 'about', 'services', 'contact'];
    private $languages = ['ar', 'en'];
    private $languageNames = ['ar' => 'العربية', 'en' => 'English'];
    
    public function index()
    {
        $pagesData = [];
        $totalStats = [
            'total_pages' => 0,
            'total_texts' => 0,
            'total_images' => 0,
            'completed_pages' => 0,
            'missing_translations' => 0,
            'last_activity' => null
        ];
        
        foreach ($this->pages as $page) {
            $pageData = $this->getPageData($page);
            $pagesData[$page] = $pageData;
            
            // إضافة للإحصائيات العامة
            $totalStats['total_pages']++;
            $totalStats['total_texts'] += $pageData['text_count'];
            $totalStats['total_images'] += $pageData['image_count'];
            
            if ($pageData['completion_percentage'] >= 100) {
                $totalStats['completed_pages']++;
            }
            
            $totalStats['missing_translations'] += $pageData['missing_translations'];
        }
        
        $totalStats['completion_rate'] = $totalStats['total_pages'] > 0 
            ? round(($totalStats['completed_pages'] / $totalStats['total_pages']) * 100, 1) 
            : 0;
            
        $recentActivity = $this->getRecentActivity();
        
        return view('admin.content.index', compact('pagesData', 'totalStats', 'recentActivity'));
    }

    public function show($page)
    {
        if (!in_array($page, $this->pages)) {
            abort(404, 'الصفحة غير موجودة');
        }

        $translations = [];
        $translationStats = [];
        
        foreach ($this->languages as $lang) {
            $translations[$lang] = $this->getTranslations($lang, $page);
            $translationStats[$lang] = [
                'total_keys' => count($translations[$lang]),
                'filled_keys' => count(array_filter($translations[$lang], fn($value) => !empty(trim($value)))),
                'empty_keys' => count(array_filter($translations[$lang], fn($value) => empty(trim($value))))
            ];
        }
        
        $images = $this->getPageImages($page);
        $pageAnalytics = $this->getAdvancedPageAnalytics($page, $translations, $images);
        $suggestions = $this->getContentSuggestions($translations);
        
        return view('admin.content.edit', compact(
            'page', 
            'translations', 
            'images', 
            'pageAnalytics', 
            'translationStats',
            'suggestions'
        ));
    }

    public function updateTranslations(Request $request, $page)
    {
        $validator = Validator::make($request->all(), [
            'ar.*' => 'nullable|string|max:5000',
            'en.*' => 'nullable|string|max:5000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'يرجى مراجعة البيانات المدخلة');
        }

        try {
            $updatedStats = ['ar' => 0, 'en' => 0];
            $changedKeys = [];
            
            foreach ($this->languages as $lang) {
                if ($request->has($lang)) {
                    $oldTranslations = $this->getTranslations($lang, $page);
                    $newTranslations = $request->input($lang, []);
                    
                    // تتبع التغييرات
                    foreach ($newTranslations as $key => $value) {
                        if (($oldTranslations[$key] ?? '') !== $value) {
                            $changedKeys[] = $key;
                        }
                    }
                    
                    $this->saveTranslations($lang, $page, $newTranslations);
                    $updatedStats[$lang] = count(array_filter($newTranslations));
                }
            }

            // حفظ سجل النشاط
            $this->logActivity('translations_updated', [
                'page' => $page,
                'changed_keys' => array_unique($changedKeys),
                'stats' => $updatedStats
            ]);

            // مسح الكاش
            $this->clearPageCache($page);

            $message = "تم تحديث الترجمات بنجاح";
            if (!empty($changedKeys)) {
                $message .= " (" . count(array_unique($changedKeys)) . " عنصر محدث)";
            }

            return redirect()->back()->with('success', $message);
            
        } catch (\Exception $e) {
            Log::error("Translation update failed for page: {$page}", [
                'error' => $e->getMessage(),
                'user' => auth()->guard('admin')->user()->email
            ]);
            
            return redirect()->back()->with('error', 'حدث خطأ أثناء حفظ البيانات');
        }
    }

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
            'image_key' => 'required|string|max:100|regex:/^[a-zA-Z0-9_-]+$/',
            'page' => 'required|in:' . implode(',', $this->pages),
            'alt_text' => 'nullable|string|max:200'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false, 
                'errors' => $validator->errors()->first()
            ], 422);
        }

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                
                // حذف الصورة القديمة
                $this->deleteOldImage($request->page, $request->image_key);
                
                // إنشاء اسم فريد للصورة
                $imageName = $this->generateUniqueImageName(
                    $request->page, 
                    $request->image_key, 
                    $image->getClientOriginalExtension()
                );
                
                // إنشاء مجلدات منظمة
                $yearMonth = date('Y/m');
                $contentDir = public_path("images/content/{$yearMonth}");
                if (!File::exists($contentDir)) {
                    File::makeDirectory($contentDir, 0755, true);
                }
                
                // رفع الصورة
                $image->move($contentDir, $imageName);
                
                // تحسين الصورة
                $imagePath = "/images/content/{$yearMonth}/{$imageName}";
                $this->optimizeImage($contentDir . '/' . $imageName);
                
                // حفظ بيانات الصورة
                $imageData = [
                    'path' => $imagePath,
                    'alt_text' => $request->alt_text ?: $request->image_key,
                    'file_size' => $image->getSize(),
                    'dimensions' => $this->getImageDimensions($contentDir . '/' . $imageName),
                    'uploaded_at' => now()->toISOString(),
                    'uploaded_by' => auth()->guard('admin')->user()->email
                ];
                
                $this->saveImageData($request->page, $request->image_key, $imageData);
                
                // تسجيل النشاط
                $this->logActivity('image_uploaded', [
                    'page' => $request->page,
                    'key' => $request->image_key,
                    'file' => $imageName,
                    'size' => $this->formatFileSize($image->getSize())
                ]);
                
                return response()->json([
                    'success' => true,
                    'image_url' => $imagePath,
                    'message' => 'تم رفع الصورة بنجاح',
                    'file_size' => $this->formatFileSize($image->getSize()),
                    'dimensions' => $imageData['dimensions']
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Image upload failed", [
                'error' => $e->getMessage(),
                'request' => $request->only(['page', 'image_key'])
            ]);
            
            return response()->json([
                'success' => false, 
                'message' => 'فشل في رفع الصورة: ' . $e->getMessage()
            ], 500);
        }

        return response()->json(['success' => false, 'message' => 'لم يتم اختيار صورة'], 400);
    }

    // باقي الدوال المساعدة...
    
    private function getPageData($page)
    {
        $arTranslations = $this->getTranslations('ar', $page);
        $enTranslations = $this->getTranslations('en', $page);
        $images = $this->getPageImages($page);
        
        $totalKeys = count($arTranslations);
        $filledAr = count(array_filter($arTranslations, fn($v) => !empty(trim($v))));
        $filledEn = count(array_filter($enTranslations, fn($v) => !empty(trim($v))));
        
        $completionPercentage = $totalKeys > 0 
            ? round((($filledAr + $filledEn) / ($totalKeys * 2)) * 100, 1)
            : 0;
            
        return [
            'ar' => $arTranslations,
            'en' => $enTranslations,
            'images' => $images,
            'text_count' => $totalKeys,
            'image_count' => count($images),
            'completion_percentage' => $completionPercentage,
            'missing_translations' => max(0, count($arTranslations) - count($enTranslations)) + max(0, count($enTranslations) - count($arTranslations)),
            'last_modified' => $this->getLastModified($page),
            'status' => $this->getPageStatus($completionPercentage),
            'health_score' => $this->calculateHealthScore($page, $arTranslations, $enTranslations, $images)
        ];
    }
    
    private function getAdvancedPageAnalytics($page, $translations, $images)
    {
        return [
            'total_keys' => count($translations['ar'] ?? []),
            'completion_stats' => [
                'ar' => [
                    'filled' => count(array_filter($translations['ar'] ?? [], fn($v) => !empty(trim($v)))),
                    'empty' => count(array_filter($translations['ar'] ?? [], fn($v) => empty(trim($v))))
                ],
                'en' => [
                    'filled' => count(array_filter($translations['en'] ?? [], fn($v) => !empty(trim($v)))),
                    'empty' => count(array_filter($translations['en'] ?? [], fn($v) => empty(trim($v))))
                ]
            ],
            'image_analytics' => [
                'total' => count($images),
                'total_size' => $this->calculateTotalImageSize($images),
                'formats' => $this->getImageFormats($images)
            ],
            'content_quality' => $this->analyzeContentQuality($translations),
            'seo_score' => $this->calculateSeoScore($translations),
            'last_update' => $this->getLastModified($page)
        ];
    }
    
    private function getContentSuggestions($translations)
    {
        $suggestions = [];
        
        foreach ($translations as $lang => $trans) {
            foreach ($trans as $key => $value) {
                if (empty(trim($value))) {
                    $suggestions[] = [
                        'type' => 'missing_translation',
                        'language' => $lang,
                        'key' => $key,
                        'message' => "مفقود في {$this->languageNames[$lang]}: {$key}"
                    ];
                }
                
                if (strlen($value) > 200) {
                    $suggestions[] = [
                        'type' => 'long_content',
                        'language' => $lang,
                        'key' => $key,
                        'message' => "محتوى طويل في {$this->languageNames[$lang]}: {$key}"
                    ];
                }
            }
        }
        
        return array_slice($suggestions, 0, 10); // أول 10 اقتراحات
    }
    
    // باقي الدوال المساعدة...
    private function getTranslations($lang, $page)
    {
        $filePath = resource_path("lang/{$lang}/{$page}.php");
        
        if (File::exists($filePath)) {
            return include $filePath;
        }
        
        return [];
    }

    private function saveTranslations($lang, $page, $translations)
    {
        $langDir = resource_path("lang/{$lang}");
        
        if (!File::exists($langDir)) {
            File::makeDirectory($langDir, 0755, true);
        }
        
        $filePath = "{$langDir}/{$page}.php";
        
        // تنسيق أفضل للملف
        $content = "<?php\n\n/**\n * {$page}.php\n * تاريخ آخر تحديث: " . now()->format('Y-m-d H:i:s') . "\n */\n\nreturn " . var_export($translations, true) . ";\n";
        File::put($filePath, $content);
    }

    private function getPageImages($page)
    {
        $imagesFile = storage_path("app/content/images_{$page}.json");
        
        if (File::exists($imagesFile)) {
            return json_decode(File::get($imagesFile), true) ?: [];
        }
        
        return [];
    }

    private function saveImageData($page, $key, $data)
    {
        $contentDir = storage_path('app/content');
        if (!File::exists($contentDir)) {
            File::makeDirectory($contentDir, 0755, true);
        }
        
        $imagesFile = storage_path("app/content/images_{$page}.json");
        $images = $this->getPageImages($page);
        $images[$key] = $data;
        
        File::put($imagesFile, json_encode($images, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    private function logActivity($action, $data = [])
    {
        $logData = array_merge([
            'action' => $action,
            'user' => auth()->guard('admin')->user()->email,
            'timestamp' => now()->toISOString(),
            'ip' => request()->ip()
        ], $data);
        
        Log::channel('content')->info($action, $logData);
    }

    private function clearPageCache($page)
    {
        Cache::forget("translations_{$page}_ar");
        Cache::forget("translations_{$page}_en");
        Cache::forget("images_{$page}");
    }
    
    private function generateUniqueImageName($page, $key, $extension)
    {
        return $page . '_' . $key . '_' . time() . '_' . uniqid() . '.' . $extension;
    }
    
    private function formatFileSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $unitIndex = 0;
        
        while ($size >= 1024 && $unitIndex < count($units) - 1) {
            $size /= 1024;
            $unitIndex++;
        }
        
        return round($size, 2) . ' ' . $units[$unitIndex];
    }
    
    private function getImageDimensions($imagePath)
    {
        try {
            $size = getimagesize($imagePath);
            return $size ? ['width' => $size[0], 'height' => $size[1]] : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function optimizeImage($imagePath)
    {
        // يمكن إضافة تحسين الصور هنا
        // مثل ضغط الصور، تغيير الحجم، إلخ
    }

    private function getLastModified($page)
    {
        $files = [
            resource_path("lang/ar/{$page}.php"),
            resource_path("lang/en/{$page}.php"),
            storage_path("app/content/images_{$page}.json")
        ];
        
        $lastModified = 0;
        foreach ($files as $file) {
            if (File::exists($file)) {
                $lastModified = max($lastModified, File::lastModified($file));
            }
        }
        
        return $lastModified ? date('Y-m-d H:i:s', $lastModified) : null;
    }

    private function getPageStatus($completionPercentage)
    {
        if ($completionPercentage >= 90) return 'excellent';
        if ($completionPercentage >= 70) return 'good';
        if ($completionPercentage >= 40) return 'fair';
        return 'needs_work';
    }

    private function calculateHealthScore($page, $arTranslations, $enTranslations, $images)
    {
        $score = 0;
        $maxScore = 100;
        
        // نقاط الترجمة (40%)
        $translationScore = 0;
        if (!empty($arTranslations)) $translationScore += 20;
        if (!empty($enTranslations)) $translationScore += 20;
        
        // نقاط الاكتمال (40%)
        $arFilled = count(array_filter($arTranslations, fn($v) => !empty(trim($v))));
        $enFilled = count(array_filter($enTranslations, fn($v) => !empty(trim($v))));
        $totalKeys = max(count($arTranslations), count($enTranslations));
        
        if ($totalKeys > 0) {
            $completionScore = (($arFilled + $enFilled) / ($totalKeys * 2)) * 40;
        } else {
            $completionScore = 0;
        }
        
        // نقاط الصور (20%)
        $imageScore = min(count($images) * 5, 20);
        
        return round($translationScore + $completionScore + $imageScore, 1);
    }

    private function getRecentActivity()
    {
        // يمكن تطوير هذه الدالة لقراءة النشاط من قاعدة البيانات أو الملفات
        return [
            [
                'action' => 'تم تحديث صفحة الخدمات',
                'details' => '5 نصوص جديدة، 2 صور',
                'time' => 'منذ ساعة',
                'type' => 'update'
            ],
            [
                'action' => 'فحص تلقائي للصفحات',
                'details' => 'اكتشاف 3 عناصر جديدة',
                'time' => 'منذ 3 ساعات',
                'type' => 'scan'
            ]
        ];
    }
}
