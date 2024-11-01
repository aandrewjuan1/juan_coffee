<?php

require_once base_path('app/Core/Middleware/Middleware.php');

class Router
{
    protected $routes = [];
    protected $currentMiddleware = null;

    public function add($method, $uri, $controllerAction)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controllerAction' => $controllerAction,
            'method' => strtoupper($method),
            'middleware' => null
        ];


        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }
    
    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route($uri, $method)
    {
        if ($method === 'POST') {
            $method = $_POST['_method'] ?? 'POST';
        }

        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);
                // Check middleware
                if ($route['middleware'] && !$this->handleMiddleware($route['middleware'])) {
                    $this->abort(403); // Forbidden if middleware fails
                    return;
                }

                list($controller, $action) = explode('@', $route['controllerAction']);
                if (class_exists($controller) && method_exists($controller, $action)) {
                    $controllerInstance = new $controller();
                    return $controllerInstance->$action();
                }
                
                break;
            }
        }
        $this->abort();
    }

    protected function handleMiddleware($middleware)
    {
        if ($middleware === 'guest' && $this->isAuthenticated()) {
            return false;
        }
        if ($middleware === 'auth' && !$this->isAuthenticated()) {
            return false;
        }
        return true;
    }

    protected function isAuthenticated()
    {
        // Placeholder; adjust based on your auth logic, e.g., checking session
        return isset($_SESSION['user']);
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        view("{$code}.php");
        die();
    }
}
