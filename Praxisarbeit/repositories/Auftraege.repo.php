<?php
require_once "./classes/Auftrag.class.php";
require_once "./classes/Modus.class.php";
require_once "./repositories/Modus.repo.php";
require_once "./classes/DB.class.php";

class AuftraegeRepository extends DB
{
    private static $fetch_class = 'Auftrag';
    public static function findAll()
    {
        $stmt = AuftraegeRepository::stmt("SELECT * FROM kxi_auftraege WHERE visible = 1;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, AuftraegeRepository::$fetch_class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function find(int $id)
    {
        $stmt = AuftraegeRepository::stmt("SELECT * FROM kxi_auftraege WHERE id = :id;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, AuftraegeRepository::$fetch_class);
        $stmt->execute(array("id" => $id));
        return $stmt->fetch();
    }
    public static function update(int $id, string $col, $value)
    {
        $stmt = AuftraegeRepository::stmt("UPDATE kxi_auftraege SET $col = :value WHERE id = :id;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, AuftraegeRepository::$fetch_class);
        $stmt->execute(array("id" => $id, "value" => $value));
        return $stmt->fetch();
    }
    public static function setVisibility(int $id, bool $b){
        return AuftraegeRepository::update($id, "visible", $b ? 1 : 0);
    }
    public static function updateModus(int $id, string $modus){
        $modus = ModusRepository::findByKuerzel($modus);
        if(!$modus) {
            return false;
        }
        return AuftraegeRepository::update($id, "modeid", $modus->getID());
    }
}