<?php
namespace App\core;

class Route
{
    private static $routes = [];

    public static function get($path, $action)
    {
        self::$routes['GET'][$path] = $action;
    }

    public static function post($path, $action)
    {
        self::$routes['POST'][$path] = $action;
    }

    public static function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Bỏ phần /public nếu có
        $uri = preg_replace('/^\/public/', '', $uri);

        if (isset(self::$routes[$method][$uri])) {
            $action = self::$routes[$method][$uri];

            if (is_callable($action)) {
                return call_user_func($action);
            }

            // Cú pháp kiểu "Controller@method"
            if (is_string($action) && strpos($action, '@') !== false) {
                list($controllerName, $methodName) = explode('@', $action);
                $controllerClass = "App\\controllers\\" . $controllerName;
                $controller = new $controllerClass();
                return call_user_func([$controller, $methodName]);
            }
        }

        // Nếu không có route nào trùng khớp → 404
        http_response_code(404);
        $notFound = new \App\controllers\NotFoundController();
        $notFound->index();
    }
}
