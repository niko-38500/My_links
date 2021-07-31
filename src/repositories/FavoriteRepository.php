<?php

namespace App\Repositories;

use App\Repositories\Exception\RemoveException;
use PDO;

class FavoriteRepository extends Repository
{

    public function add(array $favorite) : void
    {
        $dbh = $this->PDO;
        $sth = $dbh->prepare(
            "SELECT `id`
            FROM `favorite`
            WHERE `href` = :href"
        );

        $sth->execute([
            ":href" => $favorite['href'],
        ]);
        $favId = $sth->fetch(PDO::FETCH_ASSOC);

        if (!$favId) {
            $lastId = $this->insert('favorite', $favorite, true);

            $user_favorite = [
                "user_id" => $_SESSION['user']['id'],
                "favorite_id" => $lastId,
            ];

            $this->insert('user_favorite', $user_favorite);
            return;
        }

        $user_favorite = [
            "user_id" => $_SESSION['user']['id'],
            "favorite_id" => $favId['id'],
        ];

        $this->insert('user_favorite', $user_favorite);
    }

    public function findByUserAndSort(int $userId, string $filter) {

        $dbh = $this->PDO;

        $sth = $dbh->prepare(
            "SELECT favorite.id, favorite.href, favorite.favicon, favorite.preview, favorite.title
            FROM `user_favorite` 
            JOIN `favorite`
            ON user_favorite.favorite_id = favorite.id
            WHERE user_id = :user_id
            ORDER BY favorite.id $filter"
        );

        $sth->execute([
            ":user_id" => $userId,
        ]);

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findAll(string $filter, int $offset = 0) 
    {
        $dbh = $this->PDO;
        $sth = $dbh->prepare(
            "SELECT `href`, `title`, `preview`, `favicon` 
            FROM `favorite`
            ORDER BY `id` $filter
            LIMIT 8
            OFFSET $offset"
        );

        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function removeOne() {

        $favoriteHref = urlencode(filter_input(INPUT_GET, 'fav'));
        $user = $_SESSION['user']['id'];

        $dbh = $this->PDO;
        $sth = $dbh->prepare(
            "DELETE FROM `user_favorite`
            WHERE  user_id = :user_id
            AND favorite_id = (
                SELECT `id`
                FROM `favorite`
                WHERE `href` = :favorite
                LIMIT 1
            )
            LIMIT 1"
        );

        $sth->execute([
            ":favorite" => $favoriteHref,
            ":user_id" => $user,
        ]);
    }
}