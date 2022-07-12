<?php

namespace App\Imports;

use App\Models\BankSoal;
use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SoalImport implements ToModel, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }
}
