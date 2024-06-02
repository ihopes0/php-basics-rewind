<?php

require 'Database.php';
$config = require ('config.php');

$db = new Database($config);

$posts = $db->query("select * from posts;")->fetchAll();

foreach ($posts as $post) {
    echo "<li>" . $post['title'] . "</li>";
}
