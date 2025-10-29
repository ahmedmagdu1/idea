<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;

class ContentManagementController extends Controller
{
    private const ALLOWED_EXTENSIONS = ['blade.php'];
    private const VIEWS_PATH = 'resources/views/';
    private const LANG_PATH = 'resources/lang/';
    private const IMAGES_PATH = 'public/images/';
    private const BACKUP_SUFFIX = '.backup';

    // Image upload settings
    private const ALLOWED_IMAGE_TYPES = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
    private const MAX_IMAGE_SIZE = 5120; // 5MB in KB
    private const CACHE_TTL = 300; // 5 minutes

    /**
     * Display the main content management dashboard
     */
    public function index(): View
    {
        try {
            $data = Cache::remember('content_manager_dashboard', self::CACHE_TTL, function () {
                return [
                    'viewFiles' => $this->getEditableViews(),
                    'languageFiles' => $this->getLanguageFiles(),
                    'imageFiles' => $this->getImageFiles(),
                    'recentEdits' => $this->getRecentEditHistory(),
                    'statistics' => $this->getDashboardStatistics()
                ];
            });

            return view('admin.content.index', $data);
        } catch (\Exception $e) {
            Log::error('Dashboard loading failed', ['error' => $e->getMessage()]);
            return view('admin.content.index', [
                'viewFiles' => [],
                'languageFiles' => [],
                'imageFiles' => [],
                'recentEdits' => [],
                'statistics' => []
            ])->with('error', 'Failed to load dashboard data');
        }
    }

    /**
     * Show the edit interface for a specific blade file
     */
    public function edit(Request $request, string $file = ''): View|JsonResponse|RedirectResponse
    {
        $locale = $request->get('locale', app()->getLocale());

        try {
            // Validate request
            $validator = $this->validateEditRequest($request, $file);
            if ($validator->fails()) {
                return $this->handleValidationError($validator, $request);
            }

            $filePath = $this->sanitizeFilePath($file);
            $fullPath = base_path(self::VIEWS_PATH . $filePath);

            if (!$this->isValidBladeFile($fullPath)) {
                abort(404, 'Blade file not found or invalid');
            }

            $data = $this->prepareEditData($fullPath, $filePath, $locale);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'data' => $data]);
            }

            return view('admin.content.edit', $data);

        } catch (\Exception $e) {
            Log::error('Content Management Edit Error', [
                'file' => $file,
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return $this->handleError($request, 'Failed to load the requested file.');
        }
    }

    /**
     * Update blade file content with validation and backup
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $validator = $this->validateUpdateRequest($request);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $filePath = $this->sanitizeFilePath($request->input('file'));
            $fullPath = base_path(self::VIEWS_PATH . $filePath);

            if (!$this->isValidBladeFile($fullPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid blade file'
                ], 404);
            }

            // Create backup and update content
            $this->createBackup($fullPath);
            $newContent = $this->processContentUpdate($request);

            // Validate blade syntax
            if (!$this->validateBladeSyntax($newContent)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Blade syntax detected'
                ], 400);
            }

            $this->saveFileContent($fullPath, $newContent);
            $this->logEditActivity($filePath, $request->input('update_type'));
            $this->clearCache();

            return response()->json([
                'success' => true,
                'message' => 'Content updated successfully',
                'backup_created' => true,
                'last_modified' => filemtime($fullPath)
            ]);

        } catch (\Exception $e) {
            Log::error('Content Management Update Error', [
                'file' => $request->input('file'),
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update content'
            ], 500);
        }
    }

    /**
     * Preview blade content with live streaming
     */
    public function preview(Request $request): JsonResponse
    {
        App::setLocale($request->input('locale', app()->getLocale()));

        try {
            $validator = Validator::make($request->all(), [
                'content' => 'required|string',
                'preview_data' => 'sometimes|array',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }

            $content = $request->input('content');
            $previewData = $request->input('preview_data', []);

            $renderedContent = $this->renderPreview($content, $previewData);

            // Push to cache for SSE
            Cache::put('blade-preview-' . auth()->id(), $renderedContent, 30);

            return response()->json(['success' => true]);

        } catch (\Throwable $e) {
            Log::error('Preview failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Preview generation failed',
            ], 500);
        }
    }

    /**
     * Server-Sent Events stream for live preview
     */
    public function stream(Request $request): StreamedResponse
    {
        $channel = 'blade-preview-' . auth()->id();

        set_time_limit(0);
        ignore_user_abort(true);

        return response()->stream(function () use ($channel) {
            while (true) {
                if (connection_aborted()) {
                    break;
                }

                if ($html = Cache::pull($channel)) {
                    echo "event: frame\n";
                    echo 'data: ' . base64_encode($html) . "\n\n";
                    @ob_flush();
                    flush();
                }

                usleep(300_000); // 0.3s throttle
            }
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
        ]);
    }

    /**
     * Upload image files
     */
    public function uploadImage(Request $request): JsonResponse
    {
        try {
            $validator = $this->validateImageUpload($request);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $image = $request->file('image');
            $folder = $request->input('folder', 'general');

            $imageInfo = $this->storeImage($image, $folder);
            $this->clearCache();

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'image' => $imageInfo
            ]);

        } catch (\Exception $e) {
            Log::error('Image Upload Error', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image'
            ], 500);
        }
    }

    /**
     * Get language data for editing
     */
    public function getLanguageData(Request $request, string $locale): JsonResponse
    {
        try {
            $locale = !empty($locale) ? $locale : app()->getLocale();
            $languageData = $this->loadLanguageData($locale);

            return response()->json([
                'success' => true,
                'data' => $languageData,
                'locale' => $locale,
            ]);
        } catch (\Exception $e) {
            Log::error('Language Load Error', [
                'locale' => $locale,
                'user_id' => auth()->id(),
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to load language data',
            ], 500);
        }
    }

    /**
     * Update language files
     */
    public function updateLanguage(Request $request): JsonResponse
    {
        try {
            $validator = $this->validateLanguageUpdate($request);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $this->saveLanguageFile($request);
            $this->clearCache();

            return response()->json([
                'success' => true,
                'message' => 'Language file updated successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Language Update Error', [
                'locale' => $request->input('locale'),
                'file' => $request->input('file'),
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update language file'
            ], 500);
        }
    }

    /**
     * Delete image file
     */
    public function deleteImage(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'path' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $path = $request->input('path');

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                $this->clearCache();

                return response()->json([
                    'success' => true,
                    'message' => 'Image deleted successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Image not found'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Image Delete Error', [
                'path' => $request->input('path'),
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image'
            ], 500);
        }
    }

    /**
     * Standalone language manager page
     */
    public function languageManager(Request $request, ?string $locale = null): View
    {
        $languageFiles = $this->getLanguageFiles();
        $availableLocales = array_keys($languageFiles);
        $currentLocale = $locale && in_array($locale, $availableLocales) ? $locale : (app()->getLocale() ?: ($availableLocales[0] ?? 'en'));

        return view('admin.content.language', [
            'locale' => $currentLocale,
            'languageFiles' => $languageFiles,
        ]);
    }

    // Private helper methods

    private function prepareEditData(string $fullPath, string $filePath, string $locale): array
    {
        return [
            'filePath' => $filePath,
            'fileContent' => $this->getFileContent($fullPath),
            'editableSections' => $this->parseEditableSections($this->getFileContent($fullPath), $locale),
            'fileInfo' => $this->getFileInfo($fullPath),
            'breadcrumbs' => $this->generateBreadcrumbs($filePath),
            'locale' => $locale,
            'languageFiles' => $this->getLanguageFiles(),
            'imageFiles' => $this->getImageFiles()
        ];
    }

    private function renderPreview(string $content, array $previewData): string
    {
        $tempViewName = 'temp_preview_' . Str::random(10);
        $tempPath = resource_path("views/temp/{$tempViewName}.blade.php");

        try {
            if (!File::exists(dirname($tempPath))) {
                File::makeDirectory(dirname($tempPath), 0755, true);
            }

            File::put($tempPath, $content);
            return view("temp.{$tempViewName}", $previewData)->render();
        } finally {
            if (File::exists($tempPath)) {
                File::delete($tempPath);
            }
        }
    }

    private function processContentUpdate(Request $request): string
    {
        $content = $request->input('content');
        $sections = $request->input('sections', []);
        $updateType = $request->input('update_type', 'full');

        return match ($updateType) {
            'sections' => $this->updateContentSections($content, $sections),
            'translation' => $this->updateTranslationKeys($content, $sections),
            default => $content
        };
    }

    private function storeImage($image, string $folder): array
    {
        $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $path = "images/{$folder}/{$filename}";

        $storedPath = Storage::disk('public')->putFileAs(
            "images/{$folder}",
            $image,
            $filename
        );

        if (!$storedPath) {
            throw new \Exception('Failed to store image');
        }

        return [
            'filename' => $filename,
            'original_name' => $image->getClientOriginalName(),
            'path' => $path,
            'url' => Storage::disk('public')->url($storedPath),
            'size' => $image->getSize(),
            'mime_type' => $image->getMimeType(),
            'folder' => $folder,
            'uploaded_at' => now()->toISOString()
        ];
    }

    private function loadLanguageData(string $locale): array
    {
        $langPath = base_path(self::LANG_PATH . $locale);
        if (!File::exists($langPath)) {
            throw new \Exception('Language directory not found');
        }
        $languageData = [];
        $files = File::glob($langPath . '/*.php');
        foreach ($files as $file) {
            try {
                $content = include $file;
                if (!is_array($content)) {
                    Log::warning('Language file did not return array', ['file' => $file]);
                    $content = [];
                }
            } catch (\Throwable $e) {
                Log::error('Failed parsing language file', ['file' => $file, 'error' => $e->getMessage()]);
                $content = [];
            }
            $filename = basename($file, '.php');
            $languageData[$filename] = $content;
        }
        return $languageData;
    }

    private function saveLanguageFile(Request $request): void
    {
        $locale = $request->input('locale');
        $filename = $request->input('file');
        $data = $request->input('data');

        $langPath = base_path(self::LANG_PATH . $locale . '/' . $filename . '.php');
        $dir = dirname($langPath);
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        // Build PHP array content using var_export
        $export = var_export($data, true);
        $content = "<?php\n\n/**\n * {$filename}.php\n * Last updated: " . now()->format('Y-m-d H:i:s') . "\n */\n\nreturn {$export};\n";

        // Write to temp, validate, then atomically replace
        $tmp = $langPath . '.tmp';
        File::put($tmp, $content);
        try {
            $test = include $tmp;
            if (!is_array($test)) {
                throw new \RuntimeException('Saved language file did not return array');
            }
            if (File::exists($langPath)) {
                $this->createBackup($langPath);
            }
            File::move($tmp, $langPath);
        } catch (\Throwable $e) {
            File::delete($tmp);
            throw $e;
        }
    }

    private function clearCache(): void
    {
        Cache::forget('content_manager_dashboard');

        $store = Cache::getStore();
        if (is_object($store) && method_exists($store, 'tags')) {
            Cache::tags(['content_manager'])->flush();
        }
    }

    private function validateLanguageUpdate(Request $request): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            'locale' => 'required|in:ar,en',
            'file'   => 'required|string',
            'data'   => 'required|array',
        ]);
    }

    private function getEditableViews(): array
    {
        $viewsPath = resource_path('views');
        $files = collect();

        if (!File::exists($viewsPath)) {
            return [];
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($viewsPath, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php' &&
                Str::endsWith($file->getFilename(), '.blade.php')) {

                $relativePath = str_replace($viewsPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $relativePath = str_replace(DIRECTORY_SEPARATOR, '/', $relativePath);

                $files->push([
                    'path' => $relativePath,
                    'name' => $file->getBasename('.blade.php'),
                    'size' => $file->getSize(),
                    'modified' => $file->getMTime(),
                    'directory' => dirname($relativePath),
                    'human_size' => $this->formatBytes($file->getSize()),
                    'human_date' => Carbon::createFromTimestamp($file->getMTime())->diffForHumans()
                ]);
            }
        }

        return $files->sortBy('path')->values()->all();
    }

    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }

    private function getLanguageFiles(): array
    {
        $langPath = resource_path('lang');
        $languages = [];

        if (!File::exists($langPath)) {
            return $languages;
        }

        $directories = File::directories($langPath);

        foreach ($directories as $dir) {
            $locale = basename($dir);
            $files = File::glob($dir . '/*.php');

            $languages[$locale] = collect($files)->map(function ($file) {
                return [
                    'name' => basename($file, '.php'),
                    'path' => str_replace(base_path(), '', $file),
                    'size' => File::size($file),
                    'modified' => File::lastModified($file),
                    'human_size' => $this->formatBytes(File::size($file))
                ];
            })->all();
        }

        return $languages;
    }

    private function getImageFiles(): array
    {
        $imagePath = storage_path('app/public/images');

        if (!File::exists($imagePath)) {
            File::makeDirectory($imagePath, 0755, true);
            return [];
        }

        $images = collect();

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($imagePath, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && in_array(strtolower($file->getExtension()), self::ALLOWED_IMAGE_TYPES)) {
                $relativePath = str_replace($imagePath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $relativePath = str_replace(DIRECTORY_SEPARATOR, '/', $relativePath);

                $images->push([
                    'path' => 'images/' . $relativePath,
                    'name' => $file->getBasename(),
                    'size' => $file->getSize(),
                    'modified' => $file->getMTime(),
                    'url' => asset('storage/images/' . $relativePath),
                    'folder' => dirname($relativePath),
                    'human_size' => $this->formatBytes($file->getSize())
                ]);
            }
        }

        return $images->sortByDesc('modified')->values()->all();
    }

    // ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â¹ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¦ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã¢â‚¬Å“ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¨ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â¹ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¦ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã¢â‚¬Å“ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â§ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¾ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â¦ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¾ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¦ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â  ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â¹ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¦ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã¢â‚¬Å“ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â§ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¾ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â¦ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¾ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¾ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¦ethods ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¾ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¾ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¾ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¦ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â¹ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¦ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã¢â‚¬Å“ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â§ ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¾ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¾ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¦ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â ...
    private function parseEditableSections(string $content, string $locale): array
    {
        $sections = [];

        // Translation keys
        if (preg_match_all('/\{\{\s*__\([\'"]([^\'"]+)[\'"]\)\s*\}\}/', $content, $matches)) {
            foreach (array_unique($matches[1]) as $key) {
                $sections['translations'][$key] = __($key, [], $locale);
            }
        }

        // Direct text inside tags
        if (preg_match_all('/>([^<{]+)</', $content, $matches)) {
            $sections['direct_text'] = array_values(array_filter(
                array_map('trim', array_unique($matches[1])),
                fn ($text) => $text !== ''
            ));
        }

        // Image sources
        if (preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/', $content, $matches)) {
            $sections['images'] = array_unique($matches[1]);
        }

        return $sections;
    }

    private function arrayToPhpString(array $array, int $indent = 0): string
    {
        $spaces = str_repeat('    ', $indent);
        $result = "[\n";

        foreach ($array as $key => $value) {
            $result .= $spaces . '    ';

            if (is_string($key)) {
                $result .= "'" . addslashes($key) . "' => ";
            }

            if (is_array($value)) {
                $result .= $this->arrayToPhpString($value, $indent + 1);
            } elseif (is_string($value)) {
                $result .= "'" . addslashes($value) . "'";
            } elseif (is_bool($value)) {
                $result .= $value ? 'true' : 'false';
            } elseif (is_null($value)) {
                $result .= 'null';
            } else {
                $result .= $value;
            }

            $result .= ",\n";
        }

        $result .= $spaces . ']';
        return $result;
    }

    private function validateEditRequest(Request $request, string $file): \Illuminate\Validation\Validator
    {
        return Validator::make(['file' => $file] + $request->all(), [
            'file' => 'required|string|regex:/^[a-zA-Z0-9\/\-_.]+$/',
        ]);
    }

    private function validateUpdateRequest(Request $request): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            'file' => 'required|string|regex:/^[a-zA-Z0-9\/\-_.]+$/',
            'content' => 'required|string',
            'sections' => 'sometimes|array',
            'update_type' => 'sometimes|string|in:full,sections,translation'
        ]);
    }

    private function sanitizeFilePath(string $filePath): string
    {
        $filePath = str_replace(['../', '..\\'], '', $filePath);
        $filePath = trim($filePath, '/\\');

        if (!Str::endsWith($filePath, '.blade.php')) {
            $filePath .= '.blade.php';
        }

        return $filePath;
    }

    private function isValidBladeFile(string $fullPath): bool
    {
        return File::exists($fullPath) &&
               Str::endsWith($fullPath, '.blade.php') &&
               is_readable($fullPath) &&
               is_writable($fullPath);
    }

    private function getFileContent(string $fullPath): string
    {
        return File::get($fullPath);
    }

    private function getFileInfo(string $fullPath): array
    {
        return [
            'size' => File::size($fullPath),
            'modified' => File::lastModified($fullPath),
            'permissions' => substr(sprintf('%o', fileperms($fullPath)), -4),
            'readable' => is_readable($fullPath),
            'writable' => is_writable($fullPath),
            'human_size' => $this->formatBytes(File::size($fullPath))
        ];
    }

    private function generateBreadcrumbs(string $filePath): array
    {
        $parts = explode('/', dirname($filePath));
        $breadcrumbs = [['name' => 'Views', 'path' => '']];

        $currentPath = '';
        foreach ($parts as $part) {
            if ($part !== '.') {
                $currentPath .= ($currentPath ? '/' : '') . $part;
                $breadcrumbs[] = ['name' => $part, 'path' => $currentPath];
            }
        }

        return $breadcrumbs;
    }

    private function createBackup(string $fullPath): void
    {
        $backupPath = $fullPath . self::BACKUP_SUFFIX . '.' . time();
        File::copy($fullPath, $backupPath);

        $this->cleanupOldBackups($fullPath, 10);
    }

    private function cleanupOldBackups(string $fullPath, int $keepCount): void
    {
        $backupPattern = $fullPath . self::BACKUP_SUFFIX . '.*';
        $backups = File::glob($backupPattern);

        if (count($backups) > $keepCount) {
            usort($backups, fn($a, $b) => filemtime($b) <=> filemtime($a));

            $toDelete = array_slice($backups, $keepCount);
            foreach ($toDelete as $backup) {
                File::delete($backup);
            }
        }
    }

    private function updateContentSections(string $content, array $sections): string
    {
        foreach ($sections as $section) {
            if (isset($section['old']) && isset($section['new'])) {
                $content = str_replace($section['old'], $section['new'], $content);
            }
        }

        return $content;
    }

    private function updateTranslationKeys(string $content, array $sections): string
    {
        foreach ($sections as $key => $value) {
            $pattern = '/\{\{\s*__\([\'"]' . preg_quote($key, '/') . '[\'"]\)\s*\}\}/';
            $replacement = $value;
            $content = preg_replace($pattern, $replacement, $content);
        }

        return $content;
    }

    private function validateBladeSyntax(string $content): bool
    {
        try {
            // Check for balanced braces
            $braceCount = substr_count($content, '{') - substr_count($content, '}');
            if ($braceCount !== 0) {
                return false;
            }

            // Check for malformed directives
            $invalidDirectives = preg_match('/(@\w+)(?!\(|\s)/', $content);
            if ($invalidDirectives) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function saveFileContent(string $fullPath, string $content): void
    {
        File::put($fullPath, $content);
    }

    private function logEditActivity(string $filePath, string $updateType): void
    {
        Log::info('Content Management Edit Activity', [
            'file' => $filePath,
            'update_type' => $updateType,
            'user_id' => auth()->id(),
            'timestamp' => now(),
            'ip_address' => request()->ip()
        ]);
    }

    private function getRecentEditHistory(): array
    {
        return [];
    }

    private function getDashboardStatistics(): array
    {
        try {
            $views  = $this->getEditableViews();
            $langs  = $this->getLanguageFiles();
            $images = $this->getImageFiles();
            $languagesCount = 0;
            foreach ($langs as $loc => $files) { $languagesCount += is_array($files) ? count($files) : 0; }
            return [
                'views_count'     => is_array($views) ? count($views) : 0,
                'locales_count'   => is_array($langs) ? count($langs) : 0,
                'language_files'  => $languagesCount,
                'images_count'    => is_array($images) ? count($images) : 0,
                'last_updated_at' => now()->toDateTimeString(),
            ];
        } catch (\Throwable $e) {
            return [
                'views_count'     => 0,
                'locales_count'   => 0,
                'language_files'  => 0,
                'images_count'    => 0,
                'last_updated_at' => now()->toDateTimeString(),
            ];
        }
    }}



