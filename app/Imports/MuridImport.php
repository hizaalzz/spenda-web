<?php

namespace App\Imports;

use App\Models\Murid;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MuridImport implements ToModel, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Murid([
            'nama' => $row[0],
            'nis' => $row[1],
            'nisn' => $row[2],
            'jenis_kelamin' => $row[3],
            'telp' => $row[4],
            'tempat_lahir' => $row[5],
            'tanggal_lahir' => $row[6]
        ]);
    }

    public function startRow(): int {
        return 2;
    }
}
