<?php
namespace App\models;
use App\core\Database;
use PDO;

class Category extends Database
{
    public function findByUser($user_id)
    {
        $sql = "SELECT * FROM categories WHERE user_id = :user_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $description, $user_id)
    {
        $sql = "INSERT INTO categories (name, description, user_id) VALUES (:name, :description, :user_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'description' => $description,
            'user_id' => $user_id
        ]);
        return $this->conn->lastInsertId();
    }


}