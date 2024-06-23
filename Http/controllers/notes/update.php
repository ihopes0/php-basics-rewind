<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 9;

$note = $db->query('select * from notes where id = :id;', [
    ':id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = "A body of no more than 1000 characters is required";
}

if (!empty($errors)) {

    return view(
        "note/edit.view.php",
        [
            'heading' => 'Edit Note',
            'errors' => $errors,
            'note' => $note
        ]
    );
}

$db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'body' => $_POST['body'],
    'id' => $_POST['id']
]);

header('location: /notes');
die();