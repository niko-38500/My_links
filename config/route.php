<?php

$routes = [
    '/' => [
        "controller" => "FavoriteController",
        "action" => "index",
    ],
    '/sign-in' => [
        "controller" => "UserController",
        "action" => "signin",
    ],
    '/add' => [
        "controller" => "FavoriteController",
        "action" => "add",
    ],
    '/sign-out' => [
        "controller" => "UserController",
        "action" => "signout",
    ],
    '/sign-up' => [
        "controller" => "UserController",
        "action" => "signup",
    ],
    '/remove-fav' => [
        "controller" => "FavoriteController",
        "action" => "remove",
    ],
    '/favorites' => [
        "controller" => "FavoriteController",
        "action" => "showAll",
    ],
    '/api/index' => [
        "controller" => "Api\\FavoriteApi",
        "action" => "findByUser",
    ],
    '/api/favorites' => [
        "controller" => "Api\\FavoriteApi",
        "action" => "showAll",
    ],
];