<?php
require_once "./repositories/Service.repo.php";
require_once "./repositories/Priority.repo.php";
class DB
{
    private static $_servername = "localhost";
    private static $_username = "root";
    private static $_password = "";
    private static $_name = "modul133";
    private static $_conn = null;
    private static $_migrated = false;
    private static $_migrating = false;

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
                if (!file_exists("./migration.lock")) {
                    DB::$_migrated = DB::migrate();
                    fclose(fopen("./migration.lock", "a+"));
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
    public static function findAll()
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        $stmt = ServiceRepository::stmt(file_get_contents("./sql/statements/$filename"));
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function find(int $id)
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        $stmt = ServiceRepository::stmt(file_get_contents("./sql/statements/$filename"));
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute(array("id" => $id));
        return $stmt->fetch();
    }
    public static function findByKuerzel(string $kuerzel)
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        $stmt = ServiceRepository::stmt(file_get_contents("./sql/statements/$filename"));
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch();
    }
}
