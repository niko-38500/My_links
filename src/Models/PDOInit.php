<?php


namespace App\Models;


final class PDOInit
{
    private static $PDO = null;

    private function __construct()
    {
        $paramsPDO = json_decode(file_get_contents("../config/PDOConf.json"), true);
        self::$PDO = new \PDO($paramsPDO['dsn'], $paramsPDO['username'], $paramsPDO['password']);
    }

    // public static function setPDO($pdo) {
    //     self::$PDO = $pdo;
    // }

    public static function getPDO() 
    {
        if (null === self::$PDO) {
            new PDOInit();
        }
        return self::$PDO;
    }
}