<?php
namespace App\Model;

class Person extends Base
{
    protected $table = 'Person';

    protected $primaryKey = 'Id';

    public function actor_movie()
    {
        return $this->belongsToMany('App\Model\Movie', 'Actor', 'Person_id', 'Movie_id')->withPivot('CharacterName');
    }
    
    public function director_movie()
    {
        return $this->belongsToMany('App\Model\Movie', 'Director', 'Person_id', 'Movie_id');
    }
}