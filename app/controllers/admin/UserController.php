<?php
namespace App\controllers\admin;
use App\core\Controller;
use App\models\User;

class UserController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new User();

    }
    public function admin_users()
    {
        if ($_SESSION['user']['role'] != 1) {
            header("Location: /ex_manager");
            exit;
        }
        $users = $this->users->getAll();
        $this->view("admin/users/index", ["users" => $users]);
    }

    public function get_add()
    {
        if ($_SESSION['user']['role'] != 1) {
            header("Location: /ex_manager");
            exit;
        }
        $this->view("admin/users/add");
    }
    public function create()
    {
        if ($_SESSION['user']['role'] != 1) {
            header("Location: /ex_manager");
            exit;
        }
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? '';
        $password = password_hash($_POST['password'] ?? '123456', PASSWORD_DEFAULT);
        $role = $_POST['role'] ?? '';
        $status = $_POST['status'];
        if (empty($name)) {
            $name = 'your_name' . rand(100, 999);
        }
        $img = 'uploads/default.jpg'; // ảnh mặc định
        if (!empty($_FILES['img']['name'])) {
            $fileName = time() . '_' . basename($_FILES['img']['name']);
            $targetDir = "uploads/";
            $targetPath = $targetDir . $fileName;
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
                $img = $targetPath;
            }
        }
        $data = [
            ':img' => $img,
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
            ':status' => $status,
            ':role' => $role
        ];

        $this->users->create($data);
        header("Location: /admin/users-manager");
        exit();
    }


    public function get_edit($id)
    {
        if ($_SESSION['user']['role'] != 1) {
            header("Location: /ex_manager");
            exit;
        }
        $user = $this->users->findById($id);
        $this->view("admin/users/edit", ["user" => $user]);
    }

    public function edit($id)
    {
        if ($_SESSION['user']['role'] != 1) {
            header("Location: /ex_manager");
            exit;
        }
        $user = $this->users->findById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $status = $_POST['status'];
            $role = $_POST['role'];
            $img = $user['img'];
            if (!empty($_FILES['img']['name'])) {
                $targetDir = "public/uploads/";
                if (!is_dir($targetDir))
                    mkdir($targetDir, 0777, true);
                $img = $targetDir . basename($_FILES['img']['name']);
                move_uploaded_file($_FILES['img']['tmp_name'], $img);
            }

            $this->users->update($id, [
                'img' => $img,
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'status' => $status,
                'role' => $role
            ]);
            header("Location: /admin/users-manager");
            exit;
        }

        $this->view("admin/users/edit", ["user" => $user]);
    }

    public function delete($id)
    {
        if ($_SESSION['user']['role'] != 1) {
            header("Location: /ex_manager");
            exit;
        }
        $this->users->delete($id);
        header("Location:  /admin/users-manager");
        exit;
    }
}
