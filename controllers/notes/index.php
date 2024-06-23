<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 9;

$notes = $db->query('select * from notes where user_id = :id;', [
    'id' => $currentUserId,
])->get();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);