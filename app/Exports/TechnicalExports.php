<?php

namespace App\Exports;

use App\Technical;
use Maatwebsite\Excel\Concerns\FromCollection;

class TechnicalExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Technical::all();
    }
}
