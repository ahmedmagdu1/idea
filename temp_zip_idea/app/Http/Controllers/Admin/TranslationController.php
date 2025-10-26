<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TranslationController extends Controller
{
    /**
     * Display translation management interface
     */
    public function index(): View
    {
        $languages = $this->getAvailableLanguages();
        $translationStats = $this->getTranslationStats();
        $missingKeys = $this->findMissingTranslations();
        
        return view('admin.content.translations.index', compact(
            'languages',
            'translationStats', 
            'missingKeys'
        ));
    }

    /**
     * Edit translations for a specific locale
     */
    public function edit(Request $request, string $locale): View|JsonResponse
    {
        $validator = Validator::make(['locale' => $locale], [
            'locale' => 'required|string|in:en,ar'
        ]);

        if ($validator->fails()) {
            abort(404, 'Invalid locale');
        }

        $translations = $this->getTranslationsForLocale($locale);
        $availableKeys = $this->getAllTranslationKeys();
        $missingKeys = $this->getMissingKeysForLocale($locale);
        
        $data = compact('locale', 'translations', 'availableKeys', 'missingKeys');

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $data]);
        }

        return view('admin.content.translations.edit', $data);
    }

    /**
     * Update translations
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'locale' => 'required|string|in:en,ar',
                'file' => 'required|string|regex:/^[a-zA-Z0-9_-]+$/',
                'translations' => 'required|array',
                'translations.*' => 'string|nullable'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $locale = $request->input('locale');
            $file = $request->input('file');
            $translations = $request->input('translations');

            // Create backup
            $this->createTranslationBackup($locale, $file);
            
            // Update translations
            $this->saveTranslations($locale, $file, $translations);
            
            // Clear language cache
            $this->clearLanguageCache();
            
            return response()->json([
                'success' => true,
                'message' => 'Translations updated successfully',
                'updated_count' => count($translations)
            ]);

        } catch (\Exception $e) {
            \Log::error('Translation update failed', [
                'error' => $e->getMessage(),
                'locale' => $request->input('locale'),
                'file' => $request->input('file')
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update translations'
            ], 500);
        }
    }

    /**
     * Create a new translation key
     */
    public function createKey(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'key' => 'required|string|regex:/^[a-zA-Z0-9_.]+$/',
                'value' => 'required|string',
                'file' => 'required|string|regex:/^[a-zA-Z0-9_-]+$/',
                'create_for_all' => 'boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $key = $request->input('key');
            $value = $request->input('value');
            $file = $request->input('file');
            $createForAll = $request->input('create_for_all', false);

            $languages = $createForAll ? ['en', 'ar'] : [app()->getLocale()];
            $created = [];

            foreach ($languages as $locale) {
                $translations = $this->getTranslationsForLocale($locale)[$file] ?? [];
                
                if (!isset($translations[$key])) {
                    $translations[$key] = $locale === app()->getLocale() ? $value : '';
                    $this->saveTranslations($locale, $file, $translations);
                    $created[] = $locale;
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Translation key created successfully',
                'created_for_languages' => $created
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create translation key'
            ], 500);
        }
    }

    /**
     * Delete a translation key
     */
    public function deleteKey(Request $request, string $locale, string $key): JsonResponse
    {
        try {
            $validator = Validator::make([
                'locale' => $locale,
                'key' => $key
            ], [
                'locale' => 'required|string|in:en,ar',
                'key' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $file = $request->input('file', 'messages');
            $translations = $this->getTranslationsForLocale($locale)[$file] ?? [];
            
            if (isset($translations[$key])) {
                unset($translations[$key]);
                $this->saveTranslations($locale, $file, $translations);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Translation key deleted successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Translation key not found'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete translation key'
            ], 500);
        }
    }

    // Helper methods

    private function getAvailableLanguages(): array
    {
        $langPath = resource_path('lang');
        $languages = [];

        if (!File::exists($langPath)) {
            return $languages;
        }

        $directories = File::directories($langPath);

        foreach ($directories as $dir) {
            $locale = basename($dir);
            $files = File::glob($dir . '/*.json');
            
            $languages[$locale] = [
                'name' => $this->getLanguageName($locale),
                'code' => $locale,
                'file_count' => count($files),
                'key_count' => $this->countKeysForLocale($locale)
            ];
        }

        return $languages;
    }

    private function getLanguageName(string $locale): string
    {
        $names = [
            'en' => 'English',
            'ar' => 'العربية'
        ];

        return $names[$locale] ?? ucfirst($locale);
    }

    private function getTranslationsForLocale(string $locale): array
    {
        $langPath = resource_path("lang/{$locale}");
        $translations = [];

        if (!File::exists($langPath)) {
            return $translations;
        }

        $files = File::glob($langPath . '/*.json');

        foreach ($files as $file) {
            $filename = basename($file, '.json');
            $content = json_decode(File::get($file), true);
            $translations[$filename] = $content ?? [];
        }

        return $translations;
    }

    private function getAllTranslationKeys(): array
    {
        $allKeys = [];
        $languages = $this->getAvailableLanguages();

        foreach (array_keys($languages) as $locale) {
            $translations = $this->getTranslationsForLocale($locale);
            foreach ($translations as $file => $keys) {
                $allKeys = array_merge($allKeys, array_keys($keys));
            }
        }

        return array_unique($allKeys);
    }

    private function getMissingKeysForLocale(string $locale): array
    {
        $allKeys = $this->getAllTranslationKeys();
        $currentKeys = [];
        $translations = $this->getTranslationsForLocale($locale);
        
        foreach ($translations as $keys) {
            $currentKeys = array_merge($currentKeys, array_keys($keys));
        }

        return array_diff($allKeys, $currentKeys);
    }

    private function getTranslationStats(): array
    {
        $stats = [];
        $languages = $this->getAvailableLanguages();

        foreach ($languages as $locale => $info) {
            $stats[$locale] = [
                'total_keys' => $info['key_count'],
                'missing_keys' => count($this->getMissingKeysForLocale($locale)),
                'completion_percentage' => $this->calculateCompletionPercentage($locale)
            ];
        }

        return $stats;
    }

    private function calculateCompletionPercentage(string $locale): float
    {
        $allKeys = $this->getAllTranslationKeys();
        $totalKeys = count($allKeys);
        
        if ($totalKeys === 0) {
            return 100;
        }

        $translations = $this->getTranslationsForLocale($locale);
        $translatedCount = 0;

        foreach ($translations as $keys) {
            foreach ($keys as $value) {
                if (!empty(trim($value))) {
                    $translatedCount++;
                }
            }
        }

        return round(($translatedCount / $totalKeys) * 100, 1);
    }

    private function findMissingTranslations(): array
    {
        $missing = [];
        $languages = array_keys($this->getAvailableLanguages());
        
        foreach ($languages as $locale) {
            $missing[$locale] = $this->getMissingKeysForLocale($locale);
        }

        return $missing;
    }

    private function countKeysForLocale(string $locale): int
    {
        $count = 0;
        $translations = $this->getTranslationsForLocale($locale);
        
        foreach ($translations as $keys) {
            $count += count($keys);
        }

        return $count;
    }

    private function createTranslationBackup(string $locale, string $file): void
    {
        $filePath = resource_path("lang/{$locale}/{$file}.json");
        
        if (File::exists($filePath)) {
            $backupPath = $filePath . '.backup.' . time();
            File::copy($filePath, $backupPath);
        }
    }

    private function saveTranslations(string $locale, string $file, array $translations): void
    {
        $langDir = resource_path("lang/{$locale}");
        
        if (!File::exists($langDir)) {
            File::makeDirectory($langDir, 0755, true);
        }

        $filePath = $langDir . "/{$file}.json";
        File::put($filePath, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    private function clearLanguageCache(): void
    {
        try {
            if (function_exists('artisan')) {
                \Artisan::call('cache:clear');
            }
        } catch (\Exception $e) {
            \Log::warning('Failed to clear language cache: ' . $e->getMessage());
        }
    }
}
