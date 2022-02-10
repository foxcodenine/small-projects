<?php
namespace app\Model;

use app\Model\MyCript;
use app\Model\MyUtilities;
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

    const DT_FORMAT = 'Y-m-d H:i:s';

    // _________________________________________

    public static function getConn() {
        self::loadENV();
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
                $msg = "Error getConn: <br>" . $e->getMessage();
                error_log($msg);
                die($msg);
            }
        }
        return self::$conn;
    }

    // _________________________________________

    public static function loadENV() {

        self::$db_type = $_ENV['DB_TYPE'];
        self::$db_host = $_ENV['DB_HOST'];
        

        if (MyUtilities::whoami() === 'productionServer') {
            
            self::$db_schema   = $_ENV['DB_SCHEMA_PRO'];
            self::$db_usename  = MyCript::decrypt($_ENV['DB_USERNAME_PRO']);
            self::$db_password = MyCript::decrypt($_ENV['DB_PASSWORD_PRO']);
        }

        if (MyUtilities::whoami() === 'develepmentHome') {

            self::$db_schema   = $_ENV['DB_SCHEMA_DEV'];
            self::$db_usename  = MyCript::decrypt($_ENV['DB_USERNAME_DEV']);
            self::$db_password = MyCript::decrypt($_ENV['DB_PASSWORD_DEV']);
        }
    }

    // _________________________________________

    public static function execSql($sql) {
        $conn = self::getConn();        

        try {
            $conn->exec($sql);

        } catch (PDOException $e) {
            $msg = "Error execSql: <br>" .  $e->getMessage();
            error_log($msg);
            die($msg);
        }
    }

    // _________________________________________
}



?>