<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Jawaban;
use App\Models\Nilai;
use Score;

class Penghitung extends Component
{
    public $nilai;
    public $nilaiTersimpan;

    public $jadwal;
    public $jawaban;
    public $murid;

    protected $listeners = ['nilaiChanged' => 'onNilaiChanged'];

    public function onNilaiChanged() 
    {
        $this->getJawaban();

        $this->nilai = $this->formatNilai(Score::count($this->jawaban, $this->jadwal, 'manual'));
        $this->saveNilai();
    }

    public function mount($murid, $jadwal) 
    {
        $this->murid = $murid;
        $this->jadwal = $jadwal;
    }

    public function render()
    {
        $this->getJawaban();

        $this->nilaiTersimpan = $this->getNilaiFromDatabase();

        if($this->nilaiTersimpan == null) {

            $this->nilai = $this->formatNilai(Score::count($this->jawaban, $this->jadwal, 'manual'));

            $this->saveNilai();
        } else {
            $this->nilai = $this->nilaiTersimpan->nilai;
        }

        $this->emit('scoreChanged', $this->nilai);

        return view('livewire.penghitung');
    }

    public function getJawaban() 
    {
        $this->jawaban = Jawaban::where('murid_id', $this->murid)->where('jadwal_id', $this->jadwal->id)->with('soal')->get()
            ->sortBy('soal.nomor_soal');

    }

    public function getNilaiFromDatabase() 
    {
        return Nilai::where('murid_id', $this->murid)->where('jadwal_id', $this->jadwal->id)->first();
    }

    public function saveNilai() 
    {
        Nilai::updateOrCreate(
            ['murid_id' => $this->murid, 'jadwal_id' => $this->jadwal->id],
            ['nilai' => $this->nilai, 'status' => 'Dinilai']
        );
    }

    public function formatNilai($nilai)
    {
        return number_format($nilai, 1, '.', '');
    }
}
