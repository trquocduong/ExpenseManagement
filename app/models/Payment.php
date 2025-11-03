<?php
namespace App\models;
use App\core\Database;
use PDO;
class Payment extends Database
{
    public function getAll()
    {
        $sql = "SELECT id, name FROM payment_methods";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>