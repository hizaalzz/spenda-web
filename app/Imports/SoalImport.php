<?php

namespace App\Imports;

use App\Models\BankSoal;
use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SoalImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $paket_id;
    public $jadwal_id;

    public function __construct($paket_id, $bank_soal_id)
    {
        $this->paket_id = $paket_id;
        $this->bank_soal_id = $bank_soal_id;    
    }

    public function model(array $row)
    {
        $lastNumber = Soal::orderBy('nomor_soal', 'desc')->select('nomor_soal')->first();

        $banksoal = BankSoal::find($this->bank_soal_id);

        $generateNumber = $lastNumber ? $lastNumber->nomor_soal + 1 : 1;

        return new Soal([
            'nomor_soal' => $generateNumber,
            'isi' => $row[0],
            'pilA' => $row[1],
            'pilB' => $row[2],
            'pilC' => $banksoal->opsi_pg > 2 ? $row[3] : null,
            'pilD' => $banksoal->opsi_pg > 3 ? $row[4] : null,
            'pilE' => $banksoal->opsi_pg > 4 ? $row[5] : null,
            'kunci_jawaban' => $row[6],
            'jenis' => $row[7],
            'paket_id' => $this->paket_id,
            'bank_soal_id' => $this->bank_soal_id
        ]); 
    }

    public function startRow(): int {
        return 2;
    }
}
