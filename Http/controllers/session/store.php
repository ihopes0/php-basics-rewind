<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

// log in the user if the creds match

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    if ((new Authenticator)->attempt($email, $password)) {
        redirect('/');
    }
};

$form->error('bottom', 'No matching account for that email adress and password.');

Session::flash('errors', $form->getErrors());
Session::flash('old', [
    'email' => $email,
    'password' => $password,
]);

redirect('/login');
