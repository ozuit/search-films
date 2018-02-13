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
            $data['movies'] = Movie::whereHas('genre', function($query) use ($postData) {
                $query->where('Name', 'like', trim($postData['genre']));
            })->whereHas('actor', function($query) use ($postData) {
                $query->where('Name', 'like', trim($postData['actor']));
            })->orderBy('Rating', 'desc')->limit(6)->get();
        }

        return $this->render('home.html.twig', $data);
    }
}
