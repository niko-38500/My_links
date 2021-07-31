<?php

function getLinkInfoFromUrl(string $url) : array 
{
    $page = file_get_contents($url);    
    $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;
    $favicon = preg_match("/^https?:\/\/[^\/]*\//", $url, $matche) ? $matche[0] . "favicon.ico" : null;
    if (!$favicon){
        $favicon = preg_match('/href="(.*favicon\.[^"]*)/', $page, $match) ? $match[1] : null;
    }
    if (!$favicon){
        $favicon = preg_match('/rel=\"shortcut icon\" (?:href=[\'\"]([^\'\"]+)[\'\"])?/', $page, $match) ? $match[1] : null;
    }

    return [
        'title' =>  $title,
        'favicon' => $favicon,
    ];
}