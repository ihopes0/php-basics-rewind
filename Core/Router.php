<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
    protected $routes = [];

    private function add(string $uri, string $controller, string $method): self
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
        ];

        return $this;
    }


    public function get(string $uri, string $controller): self
    {
        return $this->add($uri, $controller, 'GET');
    }


    public function post(string $uri, string $controller): self
    {
        return $this->add($uri, $controller, 'POST');
    }


    public function delete(string $uri, string $controller): self
    {
        return $this->add($uri, $controller, 'DELETE');
    }


    public function patch(string $uri, string $controller): self
    {
        return $this->add($uri, $controller, 'PATCH');
    }


    public function put(string $uri, string $controller): self
    {
        return $this->add($uri, $controller, 'PUT');
    }


    public function only(string $key): void
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
    }


    public function route(string $uri, string $method): string
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                // apply middleware
                Middleware::resolve($route['middleware']);

                return require base_path('Http/controllers/' . $route['controller']);
            }
        }

        $this->abort();
    }

    
    protected function abort(int $code = 404): void
    {
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}
