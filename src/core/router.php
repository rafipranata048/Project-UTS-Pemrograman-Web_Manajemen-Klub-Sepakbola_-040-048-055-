
<?php

class Router
{
    private $routes = [];

    // Mendaftarkan route GET
    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    // Mendaftarkan route POST
    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    // Menjalankan route sesuai request
    public function dispatch($method, $path)
    {
        if (isset($this->routes[$method][$path])) {
            $callback = $this->routes[$method][$path];
            call_user_func($callback);
        } else {
            http_response_code(404);
            echo "404 - Halaman tidak ditemukan";
        }
    }
}
