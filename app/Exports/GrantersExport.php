<?php

namespace App\Exports;

use App\Granters;
use Maatwebsite\Excel\Concerns\FromCollection;

class GrantersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Granters::all();
    }
}
