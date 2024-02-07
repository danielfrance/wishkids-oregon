<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GrantersKidsRel;
use App\Granters;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Kids extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'kids';

    protected $fillable =  ['id', 'name', 'image', 'age','sex', 'bio','illness','city','treatment_center','language', 'wish', 'waiting','token', 'created_at', 'updated_at'];

    public function granters()
    {

//        return $this->belongsToMany('App\GrantersKidsRel');

        return $this->belongsToMany(\App\Granters::class)->withTimestamps();
    }

    public function allvolunteers($id)
    {

        $rel = GrantersKidsRel::where('kids_id', $id)->get();

        $array = [];
        foreach ($rel as $vol) {
            $volunteer = Granters::find($vol['granters_id'])->toArray();
            array_push($array, $volunteer);
        }
        return $array;
    }

    public function activegranters($id)
    {
      //  $rel = GrantersKidsRel::where('kids_id',$id)
      //  ->where('deleted_at', NULL)->get();

//        dd($rel);

        $join = DB::table('granters')
                ->join('granters_kids', 'granters.id', '=', 'granters_kids.granters_id')
                ->select('granters.*','granters_kids.granter_type')
                ->where('kids_id', $id)
                ->where('granters_kids.deleted_at', null)
                ->get();


        return $join;
    }

    public function leadGranter()
    {
        $granters = $this->activegranters($this->id);
        $lead = '';
        foreach ($granters as $granter)
        {
            if ($granter->granter_type === 'lead')
            {
                $lead = $granter;
            }
        }

        return $lead;

    }

    public function secondGranter()
    {
        $granters = $this->activegranters($this->id);
        $second = '';
        foreach ($granters as $granter)
        {
            if ($granter->granter_type === 'second')
            {
                $second = $granter;
            }
        }

        return $second;
    }
}
