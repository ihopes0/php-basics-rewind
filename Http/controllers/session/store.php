<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

// log in the user if the creds match


$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
]);

$signedIn = (new Authenticator)->attempt(
    $attributes['email'],
    $attributes['password']
);

if (!$signedIn) {
    $form->error(
        'bottom', 'No matching account for that email adress and password.'
    )->throw();
}

redirect('/');
