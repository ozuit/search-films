<?php

namespace App\Controller;

use Sifoni\Controller\Base;
use App\Model\Movie;
use App\Model\Genre;
use App\Model\Person;

class HomeController extends Base
{
    public function indexAction()
    {
        $data['movies'] = [];
        if ($postData = $this->getPostData()) {
            $query = Movie::orderBy('Rating', 'desc')->limit(6);
            if (trim($postData['genre']) != '') {
                $genre_query = explode(';', trim($postData['genre']));
                $query->whereHas('genre', function($query) use ($genre_query) {
                    $query->whereIn('Name', $genre_query);
                });
            }
            if (trim($postData['director']) != '') {
                $director_query = explode(';', trim($postData['director']));
                $query->whereHas('director', function($query) use ($director_query) {
                    $query->whereIn('Name', $director_query);
                });
            } 
            if (trim($postData['actor']) != '') {
                $actor_query = explode(';', trim($postData['actor']));
                $query->whereHas('actor', function($query) use ($actor_query) {
                    $query->whereIn('Name', $actor_query);
                });
            } 

            $data['movies'] = $query->get();
        }
        $data['genres'] = Genre::pluck('Name')->toArray();

        return $this->render('home.html.twig', $data);
    }

    public function getPersonAction()
    {
        if ($query = $this->getPostData('query')) {
            $query_datas = explode(' ', $query);
            $person_name = [];
            $result = [];
            foreach ($query_datas as $value) {
                $res_datas =  Person::where('Name', 'like', "$value %")->orWhere('Name', 'like', "% $value")->pluck('Name')->toArray();
                $person_name = array_merge($person_name, $res_datas);
            }
            foreach ($person_name as $name) {
                if (count(array_keys($person_name, $name)) > 1 && !in_array($name, $result)) {
                    $result[] = $name;
                }
            }         

            return implode(';', $result);
        } else {
            return '';
        }
    }
}
