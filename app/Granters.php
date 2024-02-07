<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\GrantersKidsRel;
use App\Kids;

class Granters extends Model
{

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'granters';

    protected $fillable = [
        'name',
        'email',
        'cell',
        'home_phone',
    ];

    public function kids()
    {
        return $this->belongsToMany(\App\Kids::class)->withTimestamps();
    }

    public function commitments()
    {
        return $this->hasMany(\App\GrantersKidsRel::class, 'granters_id');
    }
}
