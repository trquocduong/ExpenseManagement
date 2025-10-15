<?php
namespace App\core;
use PDO;
use PDOException;

class Model
{
    protected $db;

    public function __construct()
    {
        // Gọi file config.php
        $config = include __DIR__ . '/../config.php';
        $dbConfig = $config['db'];

        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['name']};charset={$dbConfig['charset']}";

        try {
            // Tạo đối tượng PDO
            $this->db = new PDO($dsn, $dbConfig['user'], $dbConfig['pass']);
            // Thiết lập chế độ lỗi
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Lỗi kết nối DB: " . $e->getMessage());
        }
    }
}
