<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Params extends Model
{
    protected $primaryKey = 'param_id';
    public $timestamps = false;
    protected $fillable = [
        'paramValueDate',
        'paramName',
    ];
    
    //
    /**
     * Get the param from the name
     * @param name mixed value
     * 
     * @author Benjamin Delacombaz
     */
    public static function getParamByName($name)
    {
        $params = Params::where('paramName', $name)
        ->first();
        return $params;
    }


    /**
     * Get column value and convert to Carbon date.
     * @param column String Get value of a column
     * 
     * @author Nicolas Henry
     */
    public static function getInternshipMonth($column) {
        $internshipStart = Params::where('paramName', $column);
        $timestamp = $internshipStart->get()->first()->paramValueDate;

        $splitTimeStamp = explode(" ",$timestamp);
        $date = $splitTimeStamp[0];
        $date = explode('-', $date);

        return $date[1];
    }
}
