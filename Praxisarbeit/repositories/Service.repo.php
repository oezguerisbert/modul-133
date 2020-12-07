<?php
require_once './repositories/Priority.repo.php';
require_once "./classes/Service.class.php";
require_once "./classes/DB.class.php";

class ServiceRepository extends DB
{
    public static function add(array $information)
    {
        return ServiceRepository::insert(
            "INSERT INTO kxi_auftraege(prioid, serviceid, userid)
            VALUE(:prioid, :serviceid, :uid)",
            array(
                "serviceid" => ServiceRepository::findByKuerzel($information['service'])->getID(),
                "prioid" => PriorityRepository::findByKuerzel($information['priority'])->getID(),
                "uid" => $information['userid'],
            )
        );
    }
}
