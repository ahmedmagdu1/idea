<?php
$locale = 'ar';
$dir = __DIR__ . "/resources/lang/$locale";
$data = [];
foreach (glob($dir.'/*.php') as $file) {
    $content = include $file;
    $data[basename($file, '.php')] = $content;
}
echo json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
