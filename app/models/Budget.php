<?php
namespace App\models;

use App\core\Database;
use PDO;

class Budget extends Database
{
    public function getBudget($user_id)
    {
        $sql = "SELECT * FROM budgets 
            WHERE user_id = :user_id 
            AND month_num = :month_num
            ORDER BY created_at";

        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'month_num' => date('m')
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBudget_ads($user_id)
    {
        $sql = "SELECT * FROM budgets 
            WHERE user_id = :user_id 
            AND month_num = :month_num
            ORDER BY created_at DESC 
            LIMIT 1";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'month_num' => date('m')
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO budgets (user_id, month, month_num, amount, created_at)
                VALUES (:user_id, :month, :month_num, :amount, NOW())";
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->execute($data);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM budgets WHERE id = :id LIMIT 1";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE budgets SET month=:month, month_num=:month_num, amount=:amount WHERE id=:id";
        $stmt = $this->getConnection()->prepare($sql);
        $data[':id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM budgets WHERE id=:id";
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
