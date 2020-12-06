<?php
require_once "./classes/Modus.class.php";
require_once "./classes/DB.class.php";

class ModusRepository extends DB
{
    private static $fetch_class = 'Modus';
    public static function findAll()
    {
        $stmt = ModusRepository::stmt("SELECT * FROM kxi_auftrag_modus;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, ModusRepository::$fetch_class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function find(int $id)
    {
        $stmt = ModusRepository::stmt("SELECT * FROM kxi_auftrag_modus WHERE id = :id;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, ModusRepository::$fetch_class);
        $stmt->execute(array("id" => $id));
        return $stmt->fetch();
    }
    public static function findByKuerzel(string $kuerzel)
    {
        $stmt = ModusRepository::stmt("SELECT * FROM kxi_auftrag_modus WHERE kuerzel = :kuerzel;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, ModusRepository::$fetch_class);
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch();
    }
    public static function asArray(string $filter = ""){
        $result = array();
        
        $modi = ModusRepository::findAll();
            foreach ($modi as $key => $modus) {
                if(!empty(trim($filter))){
                    $result[] = $modus->asArray()[$filter];
                }else {
                    $result[] = $modus->getName();
                }
            }
        return $result;
    }

    
}
