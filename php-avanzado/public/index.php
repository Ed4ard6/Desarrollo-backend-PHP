<?php
require __DIR__ . '/../framework/Database.php';
$db = new Database();

$routes = require __DIR__ . '/../routes/web.php';

/** 1) Obtener path limpio (sin querystring) */
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/** 2) Quitar basePath (por si el proyecto no está en la raíz del vhost) */
$basePath = rtrim(str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'])), '/');
if ($basePath !== '' && strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

/** 3) Normalizar: quitar barra final y asegurar "/" para home */
$path = '/' . ltrim($path, '/');
$path = rtrim($path, '/');
if ($path === '') { $path = '/'; }

/** 4) Ruta especial: /post/{id} */
if (preg_match('#^/post/(\d+)$#', $path, $m)) {
    $_GET['id'] = $m[1];
    require __DIR__ . '/../' . $routes['/post'];
    exit;
}

/** 5) Match EXACTO contra routes/web.php (soporta /links/create) */
if (isset($routes[$path])) {
    require __DIR__ . '/../' . $routes[$path];
    exit;
}

/** 6) Fallback home y 404 */
if ($path === '/' && isset($routes['/'])) {
    require __DIR__ . '/../' . $routes['/'];
    exit;
}

http_response_code(404);
echo '<h1>404 - No encontrado</h1>';
exit;
