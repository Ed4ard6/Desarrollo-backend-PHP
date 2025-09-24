<?php
require __DIR__ . '/../framework/Database.php';
$db = new Database();

$routes = require __DIR__ . '/../routes/web.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// var_dump($path);
// die();

$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

if ($basePath !== '' && strpos($path, $basePath) === 0) {
    $cleanedUri = substr($path, strlen($basePath));
} else {
    $cleanedUri = $path;
}

$cleanedUri = '/' . ltrim($cleanedUri, '/');
if ($cleanedUri === '//') $cleanedUri = '/';
if ($cleanedUri === '')   $cleanedUri = '/';

$route = $routes[$cleanedUri] ?? ($cleanedUri === '/' ? $routes['/'] : null);

if ($route) {
    require __DIR__ . '/../' . $route;
} else {
    http_response_code(404);
    echo '<h1>404 - No encontrado</h1>';
    exit;
}
