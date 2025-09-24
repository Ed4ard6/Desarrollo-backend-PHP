<?php
require __DIR__ . '/../framework/Database.php';
$db = new Database();

$routes = require __DIR__ . '/../routes/web.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Divide la ruta en segmentos: /post/6 → ["post", "6"]
$segments = explode('/', trim($path, '/'));

// Primer segmento: nombre de la ruta
$routeName = $segments[0] ?? '';

// Segundo segmento (si existe): ID
$id = $segments[1] ?? null;

if ($routeName === '') {
    $routeName = '/';
}

$route = $routes['/' . $routeName] ?? ($routeName === '/' ? $routes['/'] : null);

if ($route) {
    if ($id) {
        $_GET['id'] = $id;
    }
    require __DIR__ . '/../' . $route;
} else {
    http_response_code(404);
    echo "<h1>404 - Página no encontrada</h1>";
    exit;
}
