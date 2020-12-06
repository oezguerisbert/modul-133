<?php
require_once "./classes/Kommentar.class.php";
require_once "./classes/DB.class.php";

class KommentarRepository extends DB
{
    private static $fetch_class = 'Kommentar';
    public static function findAll(int $auftragid)
    {
        $stmt = KommentarRepository::stmt(
            "SELECT * FROM kxi_auftrag_kommentare where auftragid = :auftragid;"
        );
        $stmt->execute(array("auftragid" => $auftragid));
        $users = $stmt->fetchAll(PDO::FETCH_CLASS, KommentarRepository::$fetch_class);
        return $users;
    }
    public static function find(int $auftragid, int $commentid)
    {
        $stmt = KommentarRepository::stmt(
            "SELECT * FROM kxi_auftrag_kommentare where auftragid = :auftragid and id = :commentid LIMIT 1;"
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, KommentarRepository::$fetch_class);

        $stmt->execute(array("auftragid" => $auftragid, "commentid" => $commentid));
        $user = $stmt->fetch();
        return $user;
    }

    public static function create(int $userid, int $auftragid, string $content)
    {
        return UserRepository::insert(
            "INSERT INTO kxi_auftrag_kommentare(userid, auftragid, content) VALUE(:userid, :auftragid, :content)",
            array("userid" => $userid, "auftragid" => $auftragid, "content" => $content)
        );
    }
}
