<?php
require_once "./classes/User.class.php";
require_once "./classes/DB.class.php";

class UserRepository extends DB
{
    private static $fetch_class = 'User';
    public static function findAll()
    {
        $stmt = UserRepository::stmt(
            "SELECT * FROM users where usertype = :usertype;"
        );
        $stmt->execute(array("usertype" => "moderator"));
        $users = $stmt->fetchAll(PDO::FETCH_CLASS, UserRepository::$fetch_class);
        return $users;
    }
    public static function find(int $userid)
    {
        $stmt = UserRepository::stmt(
            "SELECT * FROM users where id = :userid LIMIT 1;"
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserRepository::$fetch_class);

        $stmt->execute(array("userid" => $userid));
        $user = $stmt->fetch();
        return $user;
    }
    public static function create(array $useroptions)
    {
        return UserRepository::insert(
            "INSERT INTO users(username, vorname, nachname, phone, email, password) VALUE(:username, :vorname, :nachname, :phone, :email, :password)",
            $useroptions
        );
    }
    public static function checkLogin(array $userdata)
    {
        $stmt = DB::stmt(
            "SELECT * FROM users where username = :username AND password = :password LIMIT 1;"
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserRepository::$fetch_class);
        $stmt->execute($userdata);
        $user = $stmt->fetch();
        return $user;
    }
}
