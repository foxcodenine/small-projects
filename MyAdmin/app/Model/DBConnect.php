<?php
namespace app\Model;

use PDO;
use PRO;
use PDOException;

class DBConnect {

    private static $conn = null;
    private static $db_type;
    private static $db_host;
    private static $db_schema;
    private static $db_usename;
    private static $db_password;

    // _________________________________________

    public static function getConn() {
        self::loadENV();
        echo self::$db_type . ':host=' . self::$db_host . ';dbname=' . self::$db_schema .'<br>';
        if (self::$conn === null) {

            try {
                

                $conn = new PDO(
                    self::$db_type . ':host=' . self::$db_host . ';dbname=' . self::$db_schema,
                    self::$db_usename,
                    self::$db_password
                );
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn = $conn;

            } catch (PDOException $e) {
                die("Error getConn: <br>" . $e->getMessage());
            }
        }
        return self::$conn;
    }

    // _________________________________________

    public static function loadENV() {

        self::$db_type = $_ENV['DB_TYPE'];
        self::$db_host = $_ENV['DB_HOST'];
        

        if ($_ENV['APP_ENV'] === 'production' && $_SERVER['SERVER_NAME'] === 'foxcode.io') {
            
            self::$db_schema   = $_ENV['DB_SCHEMA_PRO'];
            self::$db_usename  = $_ENV['DB_USERNAME_PRO'];
            self::$db_password = $_ENV['DB_PASSWORD_PRO'];
        }

        if ($_ENV['APP_ENV'] === 'development' && gethostname() === 'Inspiron16' && php_uname('s') === 'Linux') {

            self::$db_schema   = $_ENV['DB_SCHEMA_DEV'];
            self::$db_usename  = $_ENV['DB_USERNAME_DEV'];
            self::$db_password = $_ENV['DB_PASSWORD_DEV'];
        }
    }

    // _________________________________________

    public static function createTable($sql) {
        $conn = self::getConn();        

        try {
            $conn->exec($sql);

        } catch (PDOException $e) {
            die("Error createTable: <br>" .  $e->getMessage());
        }
    }

    // _________________________________________
}



?>