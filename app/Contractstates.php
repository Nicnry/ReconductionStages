<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractstates extends Model
{
    public $timestamps = false;

    /**
     * Relation with the internship model
     */
    public function internship()
    {
        return $this->hasMany('App\Internship');
    }
}
