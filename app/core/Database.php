<?php
namespace App\core;

use PDO;
use PDOException;

class Database
{
    protected $conn;
    public function __construct()
    {
        $config = require __DIR__ . '/../config/config.php';
        $db = $config['db'];

        $host = $db['host'];
        $dbname = $db['name'];
        $user = $db['user'];
        $pass = $db['pass'];
        $charset = $db['charset'];

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        try {
            $this->conn = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
