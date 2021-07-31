<?php

namespace App\Controller;

use App\Repositories\Exception\RemoveException;
use App\repositories\FavoriteRepository;

class FavoriteController extends AbstractController {

    public function index(FavoriteRepository $favoriteRepository) {
        if (!$this->isLogged) {
            return $this->render('homePlaceholder.html.php');
        }
        
        $sort = filter_input(INPUT_GET, 's');
        $filter = "ASC";

        if ("desc" === $sort) {
            $filter = "DESC";
        }

        $favList = $favoriteRepository->findByUserAndSort($_SESSION['user']['id'], $filter);
        // var_dump($_SESSION["error"]);
        

        return $this->render('home.html.php', [
            "links" => $favList,
        ]);
    }

    public function add(FavoriteRepository $favoriteRepository) : void
    {
        $url = filter_input(INPUT_GET, 'fav');
    
        if ($this->isLogged && filter_var($url, FILTER_VALIDATE_URL)) {
    
            $linkInfo = $this->getLinkInfoFromUrl($url);
    
            $favorite = [
                "title"   => $linkInfo['title'] ?? "pas de balise title",
                "favicon" => $linkInfo['favicon'],
                "preview" => $linkInfo['preview'] ?? null,
                "href"    => urlencode($url),
            ];
            
            $favoriteRepository->add($favorite);
        } else {
            throw new \InvalidArgumentException('error durring the insertion into the database');
        }
        header('Location: /');
        exit;
    }

    public function showAll() 
    {
        if (!$this->isLogged) {
            header('Location: /');
            exit;
        }

        $this->render('showAllFav.html.php');
    }

    public function remove(FavoriteRepository $favoriteRepository)
    {
        try {
            $favoriteRepository->removeOne();
        } catch (RemoveException $e) {
            $_SESSION["error"] = $e->getMessage();
            exit;
        }
        
        header("Location: " . $this->referer);
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