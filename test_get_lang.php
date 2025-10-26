<?php
require __DIR__.'/vendor/autoload.php';
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ContentManagementController;

$controller = new ContentManagementController();
$request = Request::create('/', 'GET');
$response = $controller->getLanguageData($request, 'ar');
header('Content-Type: application/json');
echo $response->getContent();
