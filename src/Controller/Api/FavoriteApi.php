<?php

namespace App\Controller\Api;

use App\Repositories\Exception\RemoveException;
use App\repositories\FavoriteRepository;

class FavoriteApi {

    public function findByUser(FavoriteRepository $favoriteRepository) 
    {
        $sort = filter_input(INPUT_GET, 's');
        $filter = "ASC";

        if ("desc" === $sort) {
            $filter = "DESC";
        }

        $favList = json_encode($favoriteRepository->findByUserAndSort($_SESSION['user']['id'], $filter));
        header('Content-Type: application/json');
        print_r($favList);  
    }

    public function showAll(FavoriteRepository $favoriteRepository) 
    {
        $sort = filter_input(INPUT_GET, 's');
        $filter = "ASC";

        if ("desc" === $sort) {
            $filter = "DESC";
        }
        $offset = (int) filter_input(INPUT_GET, 'p') ?? 0;
        $links = json_encode($favoriteRepository->findAll($filter, $offset));
        header('Content-Type: application/json');
        print_r($links);
    }

    public function remove(FavoriteRepository $favoriteRepository) 
    {
        try {
            $favoriteRepository->removeOne();
        } catch (RemoveException $e) {
            $_SESSION["error"] = $e->getMessage();
            exit;
        }
        
        header("Location: /");
        exit;
    }

    protected function getLinkInfoFromUrl(string $url) : array 
    {
        $previewUrl = null;
        if (preg_match("/^https?:\/\/www\.youtube\.[a-z]{2,3}\/[a-zA-Z0-9]+/", $url)) {
            if (preg_match("/.*(&t=[0-9]*s)/", $url)) {
                $url = preg_replace("/(.*)&t=[0-9]*s/", "$1", $url);
            }
            preg_match('/.*\?v=([a-zA-Z0-9_\-]*)/', $url, $match);
            $previewUrl = "https://www.youtube.com/embed/" . $match[1];
        }
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
            'preview' => $previewUrl,
        ];
    }
}