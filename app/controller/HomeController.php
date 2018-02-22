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
            $query = Movie::orderBy('Rating', 'desc')->limit(6);
            if (trim($postData['genre']) != '') {
                $genre_query = explode('; ', trim($postData['genre']));
                $query->whereHas('genre', function($query) use ($genre_query) {
                    $query->whereIn('Name', $genre_query);
                });
            }
            if (trim($postData['director'])) {
                $director_query = explode('; ', trim($postData['director']));
                $query->whereHas('director', function($query) use ($director_query) {
                    $query->where('Name', $director_query);
                });
            } 
            if (trim($postData['actor'])) {
                $actor_query = explode('; ', trim($postData['actor']));
                $query->whereHas('actor', function($query) use ($actor_query) {
                    $query->where('Name', $actor_query);
                });
            } 

            $data['movies'] = $query->get();
        }

        return $this->render('home.html.twig', $data);
    }
}
