<?php
include "../src/Services/saveUser.php";

function removeFavorites() : void
{
    $alreadyDelete = false;
    
    $url = filter_input(INPUT_GET, 'fav');
    foreach ($_SESSION['user']['favorites'] as $key => $index) {
        if (urldecode($index['href']) === $url && !$alreadyDelete) {
            unset($_SESSION['user']['favorites'][$key]);
            $alreadyDelete = true;
        }
    }

    $_SESSION['user']['favorites'] = array_values($_SESSION['user']['favorites']);
    saveUser($_SESSION['user']);
    header('Location: /');
    exit;
}