<?php

namespace App\Imports;

use App\Models\Guru;
use App\Classes\GenerateCredential;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GuruImport implements ToModel, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $guru = new Guru();

        $guru->nama = $row[0];
        $guru->nuptk = $row[1];
        $guru->email = $row[2];
        $guru->jenis_kelamin = $row[3];
        $guru->tempat_lahir = $row[4];
        $guru->tanggal_lahir = $row[5];
        $guru->telp = $row[6];

        if($guru->save()) {
            $adminGenerator = new GenerateCredential();

            $adminGenerator->generateAdmin($guru, false);

        }

        return $guru;
    }

    public function startRow(): int
    {
        return 2;
    }
}
