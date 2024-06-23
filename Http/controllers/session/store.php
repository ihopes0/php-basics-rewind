<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

// log in the user if the creds match

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    $auth = new Authenticator();

    if ($auth->attempt($email, $password)) {
        redirect('/');
    }
};

$form->error('email', 'No matching account for that email adress and password.');

return view('session/create.view.php', [
    'errors' => $form->getErrors()
]);
