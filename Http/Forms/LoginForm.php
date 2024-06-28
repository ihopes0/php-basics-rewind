<?php

namespace Http\Forms;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function validate(string $email, string $password)
    {
        // validate input
        if (!Validator::email($email)) {
            $this->errors['email'] = 'Please provide a valid email adress.';
        }

        if (!Validator::string($password, 1, INF)) {
            $this->errors['password'] = 'Please provide a valid password';
        }

        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function error($type, $message)
    {
        $this->errors[$type] = $message;
    }
}
