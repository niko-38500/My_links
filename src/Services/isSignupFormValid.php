<?php

/**
 * @param array &$form 
 * the array of fileds data
 * @return bool
 * check if the form is correctlly filled
 */
function isSignupFormValid(array &$form) : bool 
{
    $isPasswordValid = preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/", $form["password"]['value']);
    $isEmailValid    = filter_var($form["email"]['value'], FILTER_VALIDATE_EMAIL);

    if (!$isEmailValid) {
        $form["email"]['error'] = 'veuillez rentré un email valide';
    } 
    
    if (!$isPasswordValid) {
        $form["password"]['error'] = 
        'Votre mot de passe doit contenir au moins 1 majuscule
        1 minuscule 1 chiffre et un caractère special et avoir
        au moins 6 caractères';
    } 
    
    if ($form["confirm"]['value'] !== $form["password"]['value']) {
        $form['confirm']['error'] = 'Mot de passe et confirmation differents';
    }

    if ($form['confirm']['error'] || $form['email']['error'] || $form['password']['error']) {
        return false;
    }
    
    return true;
}