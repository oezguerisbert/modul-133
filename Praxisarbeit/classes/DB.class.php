<?php
if(!isset($_SESSION)){
    session_start();
}
class DB
{
    private static $_servername = "localhost";
    private static $_username = "root";
    private static $_password = "root";
    private static $_name = "mytable";
    private static $_conn = null;
    private static $_port = 3306;
    private static $_migrated = false;
    private static $_migrating = false;

    /**
     * Connection maker
     */
    private static function connection()
    {
        if (DB::$_conn === null) {
            try {
                $configFile = "./config.json";
                if (file_exists($configFile)) {
                    $config = file_get_contents("./config.json");
                    $json = json_decode($config, true);
                    $db = $json['database'];
                    DB::$_servername = $db['host'];
                    DB::$_port = $db['port'];
                    DB::$_username = $db['user'];
                    DB::$_password = $db['password'];
                    DB::$_name = $db['dbname'];
                }
                $_conn = new PDO("mysql:host=" . DB::$_servername . ";port=" . DB::$_port . ";dbname=" . DB::$_name . "", DB::$_username, DB::$_password);
                // set the PDO error mode to exception
                $_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $_conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                DB::$_conn = $_conn;
                if (!file_exists("./migration.lock") && (isset($config) && ($db['migrate'] ?? true))) {
                    DB::$_migrated = DB::migrate();
                    fclose(fopen("./migration.lock", "a+"));
                    session_destroy();
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return DB::$_conn;
    }

    private static function migrate()
    {
        DB::$_migrating = true;
        $sqls = array();

        foreach (new DirectoryIterator('./sql/creates/') as $file) {
            if ($file->isDot()) {
                continue;
            }

            if ($file->isDir()) {
                continue;
            }

            $sqls[] = file_get_contents($file->getPath() . "/" . $file->getFilename());
        }

        foreach (new DirectoryIterator('./sql/bundle/') as $file) {
            if ($file->isDot()) {
                continue;
            }

            if ($file->isDir()) {
                continue;
            }
            $sqls[] = file_get_contents($file->getPath() . "/" . $file->getFilename());
        }

        // $sqls[] = file_get_contents("./sql/creates/database.sql");
        // $sqls[] = file_get_contents("./sql/bundle/services.sql");
        // $sqls[] = file_get_contents("./sql/bundle/priorities.sql");
        // $sqls[] = file_get_contents("./sql/bundle/auftrag_modus.sql");
        // $sqls[] = file_get_contents("./sql/bundle/auftraege_und_kommentare.sql");
        // if(file_exists("./sql/bundle/users.sql"))
        // $sqls[] = file_get_contents("./sql/bundle/users.sql");
        $result = true;
        foreach ($sqls as $key => $sql) {
            $c = DB::connection();
            $sqlResult = $c->exec($sql);
            $result &= $sqlResult;
        }
        return $result;
    }

    public static function checkMigration()
    {
        return DB::migrate();
    }

    protected static function stmt(string $sql)
    {
        $conn = DB::connection();
        $stmt = $conn->prepare($sql);
        return $stmt;
    }

    protected static function insert(string $sql, array $array)
    {
        return DB::stmt($sql)->execute($array);
    }

}
