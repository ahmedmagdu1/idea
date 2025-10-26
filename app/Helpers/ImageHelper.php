<?php

use Illuminate\Support\Facades\File;

if (!function_exists('page_image')) {
    function page_image($page, $key, $default = '/images/placeholder.jpg') {
        $imagesFile = storage_path("app/images_{$page}.json");
        
        if (File::exists($imagesFile)) {
            $images = json_decode(File::get($imagesFile), true);
            return $images[$key] ?? $default;
        }
        
        return $default;
    }
}
