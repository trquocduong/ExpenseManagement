<?php
namespace App\models;

use App\core\Database;
use PDO;

class Expense extends Database
{
    public function getAllByUser($user_id)
    {
        $sql = "SELECT e.*, c.name AS category, p.name AS payment
                FROM expenses e
                LEFT JOIN categories c ON e.category_id = c.id
                LEFT JOIN payment_methods p ON e.payment_id = p.id
                WHERE e.user_id = :user_id
                ORDER BY e.date DESC";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCategoryTotalsByUser($user_id)
    {
        $sql = "SELECT 
                c.name AS category,
                SUM(e.amount) AS total_amount,
                MAX(e.created_at) AS latest_date
            FROM expenses e
            LEFT JOIN categories c ON e.category_id = c.id
            WHERE e.user_id = :user_id
            GROUP BY c.name";

        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getThisMonthExpenses($user_id)
    {
        $sql = "SELECT e.*, c.name AS category, p.name AS payment
                FROM expenses e
                LEFT JOIN categories c ON e.category_id = c.id
                LEFT JOIN payment_methods p ON e.payment_id = p.id
                WHERE e.user_id = :user_id
                AND MONTH(e.date) = MONTH(CURDATE())
                AND YEAR(e.date) = YEAR(CURDATE())
                ORDER BY e.date DESC";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO expenses (user_id, category_id, payment_id, title, amount, date, location, notes, created_at)
                VALUES (:user_id, :category_id, :payment_id, :title, :amount, :date, :location, :notes, NOW())";
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->execute($data);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM expenses WHERE id = :id LIMIT 1";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE expenses 
                SET category_id=:category_id, payment_id=:payment_id, title=:title,
                    amount=:amount, date=:date, location=:location, notes=:notes 
                WHERE id=:id";
        $stmt = $this->getConnection()->prepare($sql);
        $data[':id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM expenses WHERE id=:id";
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
