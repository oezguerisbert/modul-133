<?php
require_once "./classes/Priority.class.php";
require_once "./classes/DB.class.php";

class PriorityRepository extends DB
{
    private static $fetch_class = 'Priority';
    public function findAll()
    {
        $stmt = PriorityRepository::stmt("SELECT * FROM kxi_priorities;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, PriorityRepository::$fetch_class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function findByKuerzel(string $kuerzel)
    {
        $stmt = PriorityRepository::stmt("SELECT * FROM kxi_priorities WHERE kuerzel = :kuerzel LIMIT 1;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, PriorityRepository::$fetch_class);
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch();
    }
    public function find(int $id)
    {
        $stmt = PriorityRepository::stmt("SELECT * FROM kxi_priorities WHERE id = :id;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, PriorityRepository::$fetch_class);
        $stmt->execute(array("id" => $id));
        return $stmt->fetch();
    }
}
