<?php
require_once "./classes/Modus.class.php";
require_once "./classes/DB.class.php";

class ModusRepository extends DB
{
    public static function asArray(string $filter = "")
    {
        $result = array();

        $modi = ModusRepository::findAll();
        foreach ($modi as $key => $modus) {
            if (!empty(trim($filter))) {
                $result[] = $modus->toArray()[$filter];
            } else {
                $result[] = $modus->getName();
            }
        }
        return $result;
    }

}
