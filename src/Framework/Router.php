<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middleWares = [];

    public function add(string $method, string $path, array $controller)
    {
        $path = $this->normalizePath($path);
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller
        ];
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/{$path}/";
        $path = preg_replace('#[/]{2,}#', '/', $path);
        return $path;
    }

    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method) {
                continue;
                //echo "Does not exist";
            }

            [$class, $function] = $route['controller'];

            $controllerInstance = $container ?
                $container->resolve($class) :  new $class;

            $action = fn () => $controllerInstance->{$function}();

            foreach ($this->middleWares as $middleware) {
                $middlewareInstance = $container ? $container->resolve($middleware) : new  $middleware;
                $action = fn () => $middlewareInstance->process($action);
            }

            $action();

            return;
        }
    }

    public function addMiddlewares(string $middleware)
    {
        $this->middleWares[] = $middleware;
    }
}