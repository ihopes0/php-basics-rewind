<?php

use Core\Response;

function urlIs(string $value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function dd(mixed $value): void
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function abort(int $code = 404): void
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize(bool $condition, int $status = Response::FORBIDDEN): void
{
    if (!$condition) {
        abort($status);
    }
}

function base_path(string $path): string
{
    return BASE_PATH . $path;
}

function view(string $path, array $attributes): void
{
    extract($attributes);

    require base_path("views/{$path}");
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}
