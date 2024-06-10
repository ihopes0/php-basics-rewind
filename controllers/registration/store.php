<?php

use Core\Validator;
use Core\App;
use Core\Database;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

// validate input
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email adress.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a valid password (minimum 7 characters)';
}

if (!empty($errors)) {
    return view('/registration/create.view.php', [
        'errors' => $errors,
    ]);
}

$db = App::resolve(Database::class);

// check if the account already exists
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

    // if yes, redirect to a login page
if ($user) {
    header('location: /');
    exit();
} else {
    // if not, save one to the db, and log in user, and redirect
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => $password
    ]);
    // mark as logged in
    $_SESSION['user'] = [
        'email' => $email
    ];

    header('location: /');
    exit();
}



view('registration/store.view.php', []);