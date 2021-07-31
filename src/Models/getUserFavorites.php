<?php

include "../src/Models/PDOConnexion.php";

/**
 *@param string $userId
 * id of the user you want to get the id
 * @return array
 * array of all the favorites of the user
 */
function getUserFavorites(string $userId) : array
{
    try {
        $sth = PDOConnexion()->prepare(
            "SELECT favorite.id, favorite.href, favorite.favicon, favorite.preview, favorite.title
            FROM `user_favorite` 
            JOIN `favorite`
            ON user_favorite.favorite_id = favorite.id
            WHERE user_id = :user_id"
        );
        $sth->execute([
            ":user_id" => $userId,
        ]);

        return $sth->fetchAll(PDO::FETCH_ASSOC);

    } catch (\App\Models\Exception\PDOConnexionException $e) {
        
    }

}