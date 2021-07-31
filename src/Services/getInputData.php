<?php

/**
 * @param array $namesList
 * array of each input name you wish get 
 * @return array
 * return a new array of each input value
 */
function getInputData(array $namesList) : array
{
    $form = [];
    foreach($namesList as $name) {
        $form[$name] = [
            'value' => filter_input(INPUT_POST, $name),
            'error' => null,
        ];
    }
    return $form;
}