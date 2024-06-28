<?php

use Core\Session;

view('session/create.view.php', [
    'header' => 'Log In',
    'errors' => Session::get('errors') ?? [],
]);