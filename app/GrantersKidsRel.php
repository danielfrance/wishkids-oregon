<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrantersKidsRel extends Model
{
    use SoftDeletes;


    protected $table = 'granters_kids';

    protected $fillable = ['granters_id', 'kids_id'];


    /**
     * @return array
     */
    public static function getVolunteer()
    {
        $this->belongsTo(\App\Granters::class, 'granters_id');
    }
}
