<?php

namespace App\Repositories;

use App\Models\PDOInit;

class Repository {
    
    protected $PDO;

    public function __construct()
    {
        $this->PDO = PDOInit::getPDO();
    }
    
    /**
     * @param string $table 
     * the table name
     * @param array $dataArr
     * relationnal array of the data you want to insert
     * @param bool $lastId (optionnel)
     * return the last inserted id if true passed false by default
     */
    function insert(string $table, array $dataArr, bool $lastId = false)
    {
        $props = [];

        foreach ($dataArr as $prop => $value) {
            array_push($props, $prop);
        }

        $tableProps = implode("`, `", $props);
        $prepare    = implode(", :", $props);

        $dbh = $this->PDO;
        $sth = $dbh->prepare(
            "INSERT INTO `$table` (`$tableProps`) VALUES (:$prepare)"
        );

        $sth->execute($dataArr);

        if ($lastId) {
            return $dbh->lastInsertId();
        }
    }
}