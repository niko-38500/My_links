<?php

namespace App\Controller;

abstract class AbstractController {
    protected $isLogged;
    protected $referer;

    public function __construct() {
        $this->isLogged = array_key_exists('user', $_SESSION);
        $this->referer = $_SERVER['HTTP_REFERER'] ?? null;
    }

    protected function render(string $view, array $params = []) 
    {
        $isLogged = $this->isLogged;
        extract($params);
        include '../templates/contents/' . $view;
        include "../templates/base.php";
    }
}