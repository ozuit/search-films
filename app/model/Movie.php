<?php
namespace App\Model;

class Movie extends Base
{
    protected $table = 'Movie';

    protected $primaryKey = 'Id';

    public function actor()
    {
        return $this->belongsToMany('App\Model\Person', 'Actor', 'Movie_id', 'Person_id')->withPivot('CharacterName');
    }

    public function director()
    {
        return $this->belongsToMany('App\Model\Person', 'Director', 'Movie_id', 'Person_id');
    }
    
    public function genre()
    {
        return $this->belongsToMany('App\Model\Genre', 'Movie_Genre', 'Movie_id', 'Genre_id');
    }

    public function getMainActor()
    {
        $persons = $this->actor->take(3);
        $result = [];
        foreach($persons as $person) {
            $result[] = $person->Name; 
        }
        return implode('; ', $result);
    }

    public function getGenre()
    {
        $genres = $this->genre->all();
        $result = [];
        foreach($genres as $genre) {
            $result[] = $genre->Name;
        }
        return implode('; ', $result);
    }
}