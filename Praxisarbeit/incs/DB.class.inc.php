<?php
    class DB {
        private static $_servername = "172.26.0.3";
        private static $_username = "admin";
        private static $_password = "admin";
        private static $_name = "modul133";
        private static $_conn = null;
        private static function connection(){
            if(DB::$_conn === null){
                try {
                    $_conn = new PDO("mysql:host=".DB::$_servername.";port=3306;dbname=".DB::$_name."", DB::$_username, DB::$_password);
                    // set the PDO error mode to exception
                    $_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $_conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    DB::$_conn = $_conn;
                } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            }
            return DB::$_conn;
        }

        private static function stmt(string $sql){
            $conn = DB::connection();
            $stmt = $conn->prepare($sql);
            return $stmt;
        }

        private static function insert(string $sql, array $array){
            return DB::stmt($sql)->execute($array);
        }

        public static function createUser(array $useroptions){
            return DB::insert(
                "INSERT INTO user(vorname, nachname, phone, email) VALUE(:vorname, :nachname, :phone, :email)",
                $useroptions
            );
        }

        private static function getUserID(string $vorname, string $nachname, string $email, string $phone){
            $useroptions = array("vorname" => $vorname, "nachname" => $nachname, "email" => $email, "phone" => $phone);
            $stmt = DB::stmt(
                "SELECT * FROM user where vorname = :vorname and nachname = :nachname and email = :email and phone = :phone;"
            );
            $stmt->execute($useroptions);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $uid = -2;
            if(sizeof($users) >= 1) {
                $uid = $users[0]['id'];
            }else {
                if(DB::createUser($useroptions)){
                    $uid = DB::getUserID($vorname, $nachname, $email, $phone);
                }
            }
            return $uid;
        }

        public static function addService(array $information){
            $userid = DB::getUserID($information['vorname'], $information['nachname'], $information['email'], $information['phone']);
            
            return DB::insert("INSERT INTO sxi(prio, service, userid) VALUE(:prio, :service, :uid)", array("service" => $information['service'], "prio" => $information['priority'], "uid" => $userid));
        }

    }
?>
