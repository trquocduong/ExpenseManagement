<?php
namespace App\controllers;
use App\core\Controller;
use App\models\User;

class AuthController extends Controller
{
    private $userModel;
    private $googleConfig;

    public function __construct()
    {
        $this->userModel = new User();
        $this->googleConfig = require_once __DIR__ . '/../config/google.php'; // 🔥 load file config
    }

    public function index()
    {
        $this->view("client/auth/login", );
    }
    public function register()
    {
        $this->view("client/auth/register");
    }
    public function post_register()
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST["email"] ?? '');
            $password = trim($_POST["password"] ?? '');

            if (empty($email) || empty($password)) {
                return $this->view("client/auth/register", ["error" => "Vui lòng nhập đầy đủ thông tin."]);
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->view("client/auth/register", [
                    "error" => "Vui lòng nhập email hợp lệ."
                ]);
            }
            if (empty($password) || strlen($password) < 6) {
                return $this->view("client/auth/register", [
                    "error" => "Mật khẩu phải có ít nhất 6 ký tự."
                ]);
            }
            $userModel = $this->model("User");
            if ($userModel->findByEmail($email)) {
                return $this->view("client/auth/register", ["error" => "Email này đã được đăng ký."]);
            }
            $hash = password_hash($password, PASSWORD_DEFAULT);
            if ($userModel->register($email, $hash)) {
                $_SESSION['toast'] = [
                    'message' => 'Đăng ký thành công! Vui lòng đăng nhập.',
                    'type' => 'success'
                ];
                header('Location: /login');
                exit;
            } else {
                $_SESSION['toast'] = [
                    'message' => 'Đăng ký thất bại, vui lòng thử lại.',
                    'type' => 'danger'
                ];
                header('Location: /register');
                exit;
            }

        }
    }
    public function post_login()
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST["email"] ?? '');
            $password = trim($_POST["password"] ?? '');

            if (empty($email) || empty($password)) {
                return $this->view("client/auth/login", [
                    "error" => "Vui lòng nhập đầy đủ thông tin."
                ]);
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->view("client/auth/login", [
                    "error" => "Email không hợp lệ."
                ]);
            }
            $userModel = $this->model("User");
            $user = $userModel->findByEmail($email);

            if (!$user || !password_verify($password, $user['password'])) {
                $_SESSION['toast_error'] = 'Email hoặc mật khẩu không chính xác!';
                header('Location: /login');
                exit;
            }
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            $_SESSION['toast'] = ($user['role'] == 1)
                ? 'Đăng nhập thành công vào quản trị viên!'
                : 'Đăng nhập thành công!';

            header('Location: ' . ($user['role'] == 1 ? '/admin' : '/ex_manager'));
            exit;


        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        $_SESSION['toast_error'] = 'Bạn đã đăng xuất tài khoản !';
        header('Location: /login');
        exit;
    }


    public function googleLogin()
    {
        $config = require __DIR__ . '/../config/google.php';
        $url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
            'client_id' => $config['client_id'],
            'redirect_uri' => $config['redirect_uri'],
            'response_type' => 'code',
            'scope' => 'email profile https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email',
            'access_type' => 'online',
        ]);

        header('Location: ' . $url);
        exit;
    }

    public function googleCallback()
    {
        if (!isset($_GET['code'])) {
            echo "Lỗi: Không có mã code từ Google.";
            return;
        }

        $config = require __DIR__ . '/../config/google.php';
        $token_request = [
            'code' => $_GET['code'],
            'client_id' => $config['client_id'],
            'client_secret' => $config['client_secret'],
            'redirect_uri' => $config['redirect_uri'],
            'grant_type' => 'authorization_code'
        ];

        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);
        if ($response === false) {
            var_dump(curl_error($ch));
        }

        $token = json_decode($response, true);

        if (!isset($token['access_token'])) {
            echo "Lỗi khi lấy access token từ Google.";
            return;
        }
        $ch = curl_init('https://www.googleapis.com/oauth2/v2/userinfo');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token['access_token']]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $user_info = curl_exec($ch);
        curl_close($ch);

        $googleUser = json_decode($user_info, true);

        if (!isset($googleUser['email'])) {
            echo "Không thể lấy thông tin người dùng.";
            return;
        }
        $userModel = new \App\models\User();
        $user = $userModel->findByEmail($googleUser['email']);

        if (!$user) {
            $userModel->register($googleUser['email'], '');
        }

        session_start();
        $_SESSION['user'] = [
            'email' => $googleUser['email'],
            'name' => $googleUser['name'] ?? '',
        ];

        header('Location: /');
        exit;
    }


}
