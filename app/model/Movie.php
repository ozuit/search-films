<?php
namespace App\Model;

class Movie extends Base
{
    protected $table = 'Movie';

    protected $primaryKey = 'Id';

    public function person()
    {
        return $this->belongsToMany('App\Model\Person', 'Actor', 'Movie_id', 'Person_id')->withPivot('CharacterName');
    }

    public function getMainActor()
    {
        $persons = $this->person->take(3);
        $result = [];
        foreach($persons as $person) {
            $result[] = $person->Name; 
        }
        return implode('; ', $result);
    }
}