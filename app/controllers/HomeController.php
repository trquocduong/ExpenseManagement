<?php
namespace App\controllers;
use App\core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $user = $this->model("User");
        $data = $user->getData();
        $this->view("client/home/home", ["name" => $data]);
    }
}
