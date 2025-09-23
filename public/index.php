<?php
// Carga el mapa de rutas
$routes = require __DIR__ . '/../routes/web.php';

// 1) Path solicitado (sin query string)
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 2) Base path dinámico (la carpeta donde vive /public)
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

// 3) “Limpia” el path quitando el basePath real
if ($basePath !== '' && strpos($path, $basePath) === 0) {
    $cleanedUri = substr($path, strlen($basePath));
} else {
    $cleanedUri = $path;
}

// Normaliza a formato '/algo'
$cleanedUri = '/' . ltrim($cleanedUri, '/');
if ($cleanedUri === '//') $cleanedUri = '/';
if ($cleanedUri === '')   $cleanedUri = '/';

// 4) Busca la ruta; si es raíz vacía, manda a '/'
$route = $routes[$cleanedUri] ?? ($cleanedUri === '/' ? $routes['/'] : null);

if ($route) {
    require __DIR__ . '/../' . $route;
} else {
    http_response_code(404);
    echo '<h1>404 - No encontrado</h1>';
    exit;
}
