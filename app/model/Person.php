<?php
namespace App\Model;

class Person extends Base
{
    protected $table = 'Person';

    protected $primaryKey = 'Id';

    public function movie()
    {
        return $this->belongsToMany('App\Model\Movie', 'Actor', 'Person_id', 'Movie_id')->withPivot('CharacterName');
    }
}