<?php
namespace App\core;

class Controller
{
    public function view($view, $data = [])
    {
        extract($data);

        $viewPath = __DIR__ . "/../views/" . $view . ".php";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View không tồn tại: " . $viewPath);
        }
    }

    public function model($model)
    {
        $modelPath = __DIR__ . "/../models/" . $model . ".php";
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $modelClass = "App\\models\\" . $model;
            return new $modelClass();
        } else {
            die("Model không tồn tại: " . $modelPath);
        }
    }
}
