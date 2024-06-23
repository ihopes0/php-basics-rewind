<?php

// log in the user if the creds match

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if (!$form->validate($email, $password)) {
    return view('session/create.view.php', [
        'errors' => $form->getErrors()
    ]);
};

// match creds
$user = $db->query('select * from users where email = :email', [
    'email' => $email,
])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {
        login([
            'email' => $email
        ]);

        header('location: /');
        exit();
    }
}

return view('/session/create.view.php', [
    'errors' => [
        'password' => 'No matching account for that email adress and password.'
    ]
]);
