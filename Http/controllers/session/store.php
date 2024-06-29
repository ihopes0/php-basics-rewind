<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

// log in the user if the creds match

try {
    $form = LoginForm::validate($attributes = [
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ]);
} catch (\Core\ValidationException $e) {
    Session::flash('errors', $e->errors);
    Session::flash('old', $e->old);

    redirect('/login');
}


if ((new Authenticator)->attempt($attributes['email'], $attributes['password'])) {
    redirect('/');
}

$form->error('bottom', 'No matching account for that email adress and password.');