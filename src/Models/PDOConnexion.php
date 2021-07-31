<?php

use App\Models\Exception\PDOConnexionException;

function PDOConnexion() : object
{
    try {
        $db = new PDO(
            'mysql:host=localhost:3307;dbname=my_links;charset=UTF8;',
            'root',
            'root'
        );    
    } catch(PDOException $e) {
        throw new PDOConnexionException("Could not connect to the database");
    }

    return $db;
    
}

