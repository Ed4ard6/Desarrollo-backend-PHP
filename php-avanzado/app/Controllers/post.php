<?php
$title = 'Publicaciones';

$post = $db->query('SELECT * FROM posts WHERE id = :id', [
    'id' => $_GET['id'] ?? null,
    ])->fisrtOrFail();

require __DIR__ . '/../../resources/post.templates.php';