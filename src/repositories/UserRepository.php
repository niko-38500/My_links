<?php

namespace App\Repositories;

use PDO;

class UserRepository extends Repository {
    
    public function findForLogin($value) {
        $sth = $this->PDO->prepare("SELECT `id`, `pseudo`, `password` FROM `user` WHERE `email` = :email");
        $sth->execute([
            ":email" => $value
        ]);

        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}