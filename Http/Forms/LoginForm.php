<?php

namespace Http\Forms;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email adress.';
        }

        if (!Validator::string($attributes['password'], 100)) {
            $this->errors['password'] = 'Please provide a valid password';
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);
        
        if ($instance->failed()) {
            \Core\ValidationException::throw($instance->getErrors(), $instance->attributes);
        }

        return $instance;
    }

    public function failed()
    {
        return !empty($this->errors);
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
