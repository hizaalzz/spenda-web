<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Jawaban;

class ButtonFooter extends Component
{
    public $active = 0;

    public $soal;
    public $jadwal;
    public $totalSoal;

    //Button Property
    public $nextButtonText = 'Selanjutnya';
    public $previousButtonEnabled = false;

    protected $listeners = [
        'pageChange' => 'onPageChange'
    ];
    
    public function render()
    {
        return view('livewire.button-footer');
    }

    public function mount($soal, $jadwal) 
    {
        $this->soal = $soal;
        $this->jadwal = $jadwal;
    } 

    public function onPageChange($action = 'next', $index = null)
    {
        // Tereksekusi saat page atau nomor soal berubah

        if($index !== null) {
            // Apabila nomor soal berubah dipilih dari sidebar maka set variable aktif berdasarkan variable index
            $this->active = $index;
        } else {
            // Set variable aktif berdasarkan aksi next atau back ++ jika next -- jika back
            $action == 'next' ? $this->active++ : $this->active--;
        }

        // Disable tombol back/previous jika berada pada nomor soal 1
        $this->previousButtonEnabled = $this->active == 0 ? false : true;
        
        //Menghitung total soal
        $totalSoal = count($this->soal) - 1;

        //Mengganti teks button next apabila ada pada akhir soal menjadi selesai
        $this->nextButtonText = $this->active == $totalSoal ? 'Selesai' : 'Selanjutnya';
    }

}
