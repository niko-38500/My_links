<?php
use App\Models\Exception\PDOConnexionException;
use App\Models\Exception\PDOSignupException;

include '../src/Models/PDOConnexion.php';

/**
 * @param string $table 
 * the table name
 * @param array $dataArr
 * relationnal array of the data you want to insert
 * @param bool $lastId (optionnel)
 * return the last inserted id if true passed false by default
 */
function insertPDO(string $table, array $dataArr, bool $lastId = false)
{
    $props = [];

    foreach ($dataArr as $prop => $value) {
        array_push($props, $prop);
    }

    $tableProps = implode("`, `", $props);
    $prepare    = implode(", :", $props);

    try {
        $dbh = PDOConnexion();
        $sth = $dbh->prepare(
            "INSERT INTO `$table` (`$tableProps`) VALUES (:$prepare)"
        );

        $sth->execute($dataArr);

        if ($lastId) {
            return $dbh->lastInsertId();
        }
    } catch (PDOConnexionException $e) {
        throw new PDOConnexionException($e->getMessage());
    } catch (PDOException $e) {
        throw new PDOSignupException($e->getMessage());
    }
}