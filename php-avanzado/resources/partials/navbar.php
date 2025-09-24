<?php
// Base path para armar links correctos sin hardcodear carpetas
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

// Ruta actual “limpia” para marcar activo
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($basePath !== '' && strpos($currentPath, $basePath) === 0) {
    $currentPath = substr($currentPath, strlen($basePath));
}
$currentPath = '/' . ltrim($currentPath, '/');

function url($path) {
    global $basePath;
    return ($basePath ?: '') . ($path === '/' ? '/' : rtrim('/' . ltrim($path, '/'), '/'));
}
?>
<nav class="bg-gray-800">
  <div class="mx-auto max-w-7xl flex h-16 items-center justify-center">
    <div class="flex gap-4">
      <a href="<?= url('/') ?>"
         class="<?= $currentPath==='/' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Inicio</a>

      <a href="<?= url('/about') ?>"
         class="<?= $currentPath==='/about' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Acerca de</a>

      <a href="<?= url('/links') ?>"
         class="<?= $currentPath==='/links' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Proyectos</a>
    </div>
  </div>
</nav>
