<?php

namespace myfrm;

class Router
{
    public array $routes = [];
    protected string $uri;
    protected string $method;
    public static array $routeParams = [];

    public function __construct()
    {
        $fullUri = $_SERVER['REQUEST_URI'];
        $this->uri = trim(explode('?', $fullUri)[0], '/');
        $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    }

    public function add($uri, $controller, $method): Router
    {
        if (is_array($method)) {
            $method = array_map('strtoupper', $method);
        } else {
            $method = [$method];
        }
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];
        return $this;
    }

    public function only($middleware)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
        return $this;
    }

    public
    function match(): void
    {
        $flag = false;
        foreach ($this->routes as $route) {
            if ((preg_match("#^{$route['uri']}$#", $this->uri, $matches)) && (in_array($this->method, $route['method']))) {

                if ($route['middleware']) {
                    $middleware = MIDDLEWARE_ROUTES[$route['middleware']] ?? false;
                    if (!$middleware) {
                        throw new \Exception('Inccorrect middleware: ' . $route['middleware']);
                    }
                    (new $middleware)->handle();
                }
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        self::$routeParams[$key] = $match;
                    }
                }
                require CONTROLLERS . "/{$route['controller']}";
                $flag = true;
                break;


            }
        }
        if (!$flag) {
            abort();
        }
    }

    public
    function get(string $uri, string $controller): Router
    {
        return $this->add($uri, $controller, 'GET');
    }

    public
    function post(string $uri, string $controller): Router
    {
        return $this->add($uri, $controller, 'POST');
    }

    public
    function delete(string $uri, string $controller): Router
    {
        return $this->add($uri, $controller, 'DELETE');
    }
}