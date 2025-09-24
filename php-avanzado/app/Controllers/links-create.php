<?php

require __DIR__ . '/../../framework/Validator.php'; // ← Importamos la clase

$title = 'Registrar proyecto';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $validator = new Validator($_POST, [
        'title'       => 'required|min:3|max:190',
        'url'         => 'required|url|max:190',
        'description' => 'required|min:3|max:500',
    ]);

    if ($validator->passes()) {
        // Guardar en la base de datos
        $db->query(
            'INSERT INTO links (title, url, description) VALUES (:title, :url, :description)',
            [
                'title'       => $_POST['title'],
                'url'         => $_POST['url'],
                'description' => $_POST['description'],
            ]
        );

        header('Location: /links');
        exit;
    } else {
        $errors = $validator->errors(); // Array con los errores
    }
}

require __DIR__ . '/../../resources/links-create.templates.php';
