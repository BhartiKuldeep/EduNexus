<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    private array $routes = [];

    public function get(string $path, mixed $handler, array $middleware = []): void
    {
        $this->routes['GET'][$path] = ['handler' => $handler, 'middleware' => $middleware];
    }

    public function post(string $path, mixed $handler, array $middleware = []): void
    {
        $this->routes['POST'][$path] = ['handler' => $handler, 'middleware' => $middleware];
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $route = $this->routes[$method][$path] ?? null;
        if ($route === null) {
            http_response_code(404);
            echo '404 | Page not found';
            return;
        }
        if (! $this->passes($route['middleware'])) {
            return;
        }
        $handler = $route['handler'];
        if (is_callable($handler)) {
            $handler();
            return;
        }
        if (is_array($handler) && count($handler) === 2) {
            [$class, $action] = $handler;
            (new $class())->{$action}();
            return;
        }
        throw new \RuntimeException('Invalid route handler.');
    }

    private function passes(array $middleware): bool
    {
        foreach ($middleware as $item) {
            if ($item === 'auth' && ! Auth::check()) {
                flash('error', 'Please login first.');
                redirect('/login');
            }
            if ($item === 'guest' && Auth::check()) {
                redirect('/dashboard');
            }
            if (str_starts_with($item, 'role:')) {
                $roles = array_map('trim', explode(',', substr($item, 5)));
                if (! Auth::hasRole($roles)) {
                    http_response_code(403);
                    echo '403 | Access denied';
                    return false;
                }
            }
        }
        return true;
    }
}
