<?php

namespace App\Controller;

use Sifoni\Controller\Base;
use App\Model\Movie;

class HomeController extends Base
{
    public function indexAction()
    {
        $data['movies'] = [];
        if ($postData = $this->getPostData()) {
            $genre_query = explode('; ', trim($postData['genre']));
            $actor_query = explode('; ', trim($postData['actor']));
            $data['movies'] = Movie::whereHas('genre', function($query) use ($genre_query) {
                $query->whereIn('Name', $genre_query);
            })->whereHas('actor', function($query) use ($actor_query) {
                $query->where('Name', $actor_query);
            })->orderBy('Rating', 'desc')->limit(6)->get();
        }

        return $this->render('home.html.twig', $data);
    }
}
