<?php

use App\Models\Exception\PDOConnexionException;
use App\Models\Exception\PDOSignupException;

include "../src/Models/insertPDO.php";
include "../src/Services/getInputData.php";
include "../src/Services/isSignupFormValid.php";

function signup(string $file, bool $isLogged) : void
{
    if ($isLogged) {
        header('Location: /');
        exit;
    }
    
    $title    = "My-links - Inscription";
    $form     = getInputData(['pseudo', 'email', 'password', 'confirm']);
    $exeption = null;

    if (filter_input(INPUT_POST, "submit") && isSignupFormValid($form)) {
        $user = [
            "pseudo" => $form["pseudo"]['value'],
            "email" => $form['email']['value'],
            "password" => password_hash($form['password']['value'], PASSWORD_DEFAULT)
        ];
        try {
            insertPDO('user', $user);
        } catch (PDOConnexionException $e) {
            $exeption = $e->getMessage();
        } catch (PDOSignupException $e) {
            $exeption = $e->getMessage();
        }
        
        if (!$exeption) {
            header('Location: /sign-in');
            exit;
        }
    }

    // template
    include '../templates/base.php';
}