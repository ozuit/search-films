<?php

namespace App\Controller;

use Sifoni\Controller\Base;
use App\Model\Movie;

class HomeController extends Base
{
    public function indexAction()
    {
        $data = [];
        $data['movies'] = Movie::orderBy('Rating', 'desc')->limit(8)->get();

        return $this->render('home.html.twig', $data);
    }
}
