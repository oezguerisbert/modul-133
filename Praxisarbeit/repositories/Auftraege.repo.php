<?php
require_once "./classes/Auftrag.class.php";
require_once "./classes/DB.class.php";

class AuftraegeRepository extends DB
{
    private static $fetch_class = 'Auftrag';
    public function findAll()
    {
        $stmt = AuftraegeRepository::stmt("SELECT * FROM kxi_auftraege;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, AuftraegeRepository::$fetch_class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function find()
    {
        $stmt = AuftraegeRepository::stmt("SELECT * FROM kxi_auftraege WHERE id = :id;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, AuftraegeRepository::$fetch_class);
        $stmt->execute(array("id" => $id));
        return $stmt->fetch();
    }
}
