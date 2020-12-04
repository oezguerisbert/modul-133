<?php
require_once "./classes/Service.class.php";
require_once "./classes/DB.class.php";

class ServiceRepository extends DB
{
    private static $fetch_class = 'Service';
    public function findAll()
    {
        $stmt = ServiceRepository::stmt("SELECT * FROM kxi_services;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, ServiceRepository::$fetch_class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function findByKuerzel(string $kuerzel)
    {
        $stmt = ServiceRepository::stmt("SELECT * FROM kxi_services WHERE kuerzel = :kuerzel LIMIT 1;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, ServiceRepository::$fetch_class);
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch();
    }
    public function find(int $id)
    {
        $stmt = ServiceRepository::stmt("SELECT * FROM kxi_services WHERE id = :id LIMIT 1;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, ServiceRepository::$fetch_class);
        $stmt->execute(array("id" => $id));
        return $stmt->fetch();
    }
}
