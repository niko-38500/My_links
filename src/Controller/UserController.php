<?php

namespace App\Controller;

use App\Classes\FormHandler;
use App\Repositories\UserRepository;

class UserController extends AbstractController {

    public function signin(FormHandler $formHandler, UserRepository $userRepository) : void
    {

        if ($this->isLogged) {
            header('Location: /');
            exit;
        }

        $form = $formHandler->getInputData(["email", "password"]);

        if (filter_input(INPUT_POST, "submit")) {
            $user = $userRepository->findForLogin($form['email']['value']);
            $user['email'] = $form['email']['value'];
            if(is_array($user) && password_verify($form['password']['value'], $user['password'])) {
                $_SESSION['user'] = $user;
                header("location: /");
                exit;
            }
        }

        $this->render('signin.html.php', [
            'form' => $form,
        ]);
    }

    function signup(FormHandler $formHandler, UserRepository $userRepository) : void
    {
        if ($this->isLogged) {
            header('Location: /');
            exit;
        }
        
        $form     = $formHandler->getInputData(['pseudo', 'email', 'password', 'confirm']);
        $exeption = null;

        if (filter_input(INPUT_POST, "submit") && $formHandler->isSignupFormValid($form)) {
            $user = [
                "pseudo" => $form["pseudo"]['value'],
                "email" => $form['email']['value'],
                "password" => password_hash($form['password']['value'], PASSWORD_DEFAULT)
            ];

            $userRepository->insert('user', $user);
            
            if (!$exeption) {
                header('Location: /sign-in');
                exit;
            }
        }

        $this->render('signup.html.php', [
            "form" => $form,
            "exeption" => $exeption,
        ]);
    }

    public function signout() : void
    {
        unset($_SESSION['user']);
        session_destroy();
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            "",
            time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly'],
        );
        header('location: /');
        exit;
    }
}