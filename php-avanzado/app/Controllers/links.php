<?php
$title = 'Proyectos';

// $dsn = 'mysql:host=localhost;dbname=web-php;charset=utf8mb4';
// $pdo = new PDO($dsn, 'root', '');

$links = $db->query('SELECT * FROM links ORDER BY id DESC');

require __DIR__ . '/../../resources/links.templates.php';