<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractstates extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'stateDescription'
    ];

    /**
     * Relation with the internship model
     */
    public function internship()
    {
        return $this->hasMany('App\Internship');
    }
}
