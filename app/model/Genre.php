<?php

namespace App\Model;

class Genre extends Base
{
    protected $table = 'Genre';

    protected $primaryKey = 'Id';

    public function movie()
    {
        return $this->belongsToMany('App\Model\Movie', 'Movie_Genre', 'Genre_id', 'Movie_id');
    }
}