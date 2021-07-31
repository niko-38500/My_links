<?php

use App\Models\Exception\PDOConnexionException;
use App\Models\Exception\PDOSigninException;

include '../src/Models/PDOConnexion.php';

/**
 * @param string $value
 * value of the email field
 * @return array 
 * return array if the user is found else throw an exception
 */
function findUserForLogin(string $value) : array
{
    try {
        $sth = PDOConnexion()->prepare("SELECT `id`, `pseudo`, `password` FROM `user` WHERE `email` = :email");
        $sth->execute([
            ":email" => $value
        ]);

        return $sth->fetch(PDO::FETCH_ASSOC);
        
    } catch(PDOConnexionException $e) {
        throw new PDOConnexionException($e->getMessage());
    } catch(TypeError $e) {
        throw new PDOSigninException('Bad credentials');
    }

}