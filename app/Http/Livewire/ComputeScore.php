<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Score;
use App\Models\Nilai;

class ComputeScore extends Component
{
    public $jadwal;
    public $jawaban;

    public $nilai;

    public function render()
    {
        return view('livewire.compute-score');
    }

    public function mount($murid, $jadwal)
    {
        $this->jadwal = $jadwal;
        $this->jawaban = $murid->jawaban->where('jadwal_id', $jadwal->id);

        if(!count($this->jawaban)) 
        {
            $this->nilai = 'Belum mengerjakan ujian';

            return;
        }

        $nilaiTersimpan = Nilai::where('jadwal_id', $this->jadwal->id)->where('murid_id', $murid->id)->first();
        

        if($nilaiTersimpan === null) 
        {
            // Menentukan nilai
            $nilai = Score::count($this->jawaban, $this->jadwal);

            // Save nilai
            $hasilNilai = new Nilai([
                'jadwal_id' => $this->jadwal->id,
                'murid_id' => $murid->id,
                'nilai' => $nilai
            ]);

            $hasilNilai->save();

            $this->nilai = $this->formatNumber($nilai);

            return;

        }

        $this->nilai = $this->formatNumber($nilaiTersimpan->nilai);
    }

    public function formatNumber($value) 
    {
        return number_format((float)$value, 0, '' , '');
    }
}
