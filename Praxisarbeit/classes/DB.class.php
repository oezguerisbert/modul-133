<?php
include "./classes/User.class.php";
include "./classes/Service.class.php";
include "./classes/Priority.class.php";
class DB
{
    private static $_servername = "localhost";
    private static $_username = "root";
    private static $_password = "";
    private static $_name = "modul133";
    private static $_conn = null;

    /**
     * Connection maker
     */
    private static function connection()
    {
        if (DB::$_conn === null) {
            try {
                $_conn = new PDO("mysql:host=" . DB::$_servername . ";port=3306;dbname=" . DB::$_name . "", DB::$_username, DB::$_password);
                // set the PDO error mode to exception
                $_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $_conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                DB::$_conn = $_conn;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return DB::$_conn;
    }

    private static function stmt(string $sql)
    {
        $conn = DB::connection();
        $stmt = $conn->prepare($sql);
        return $stmt;
    }

    private static function insert(string $sql, array $array)
    {
        return DB::stmt($sql)->execute($array);
    }

    public static function createUser(array $useroptions)
    {
        return DB::insert(
            "INSERT INTO users(username, vorname, nachname, phone, email, password) VALUE(:username, :vorname, :nachname, :phone, :email, :password)",
            $useroptions
        );
    }

    public static function getUsers()
    {
        $stmt = DB::stmt(
            "SELECT * FROM users where usertype = :usertype;"
        );
        $stmt->execute(array("usertype" => "moderator"));
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public static function checkLogin(array $userdata)
    {
        $stmt = DB::stmt(
            "SELECT * FROM users where username = :username AND password = :password LIMIT 1;"
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute($userdata);
        $user = $stmt->fetch();
        return $user;
    }

    public static function addService(array $information)
    {
        return DB::insert(
            "INSERT INTO kxi_auftraege(prioid, serviceid, userid)
            VALUE(:prioid, :serviceid, :uid)",
            array(
                "serviceid" => DB::getServiceID($information['service']),
                "prioid" => DB::getPriorityID($information['priority']),
                "uid" => $information['userid'])
        );
    }

    public static function getServices()
    {
        $stmt = DB::stmt("SELECT * FROM kxi_services;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Service');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getService(string $kuerzel)
    {
        $stmt = DB::stmt("SELECT * FROM kxi_services WHERE kuerzel LIKE :kuerzel LIMIT 1;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Service');
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch();
    }
    public static function getPriority(string $kuerzel)
    {
        $stmt = DB::stmt("SELECT * FROM kxi_priorities WHERE kuerzel LIKE :kuerzel LIMIT 1;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Priority');
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch();
    }
    public static function getServiceID(string $kuerzel)
    {
        $stmt = DB::stmt("SELECT * FROM kxi_services where kuerzel = :kuerzel LIMIT 1;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Service');
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch()->getID();
    }
    public static function getPriorityID(string $kuerzel)
    {
        $stmt = DB::stmt("SELECT * FROM kxi_priorities where kuerzel = :kuerzel LIMIT 1;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Priority');
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch()->getID();
    }

}
