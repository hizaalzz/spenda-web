<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Pengumuman;
use Livewire\WithPagination;

class Persiapan extends Component
{
    use WithPagination;

    public $jadwal;
    public $status;
    public $pelaksanaan;
    public $tata_tertib;

    public $tabActive = [
        'pengumuman' => true,
        'ujian' => false
    ];

    public function render()
    {
        $pengumuman = null;

        if($this->tabActive['pengumuman']) 
        {
            $pengumuman = Pengumuman::where('jenis', 'murid')->orWhere('jenis', 'keduanya')
                ->orderBy('created_at')->select('id', 'judul', 'created_at')->paginate(5);
        } 

        return view('livewire.persiapan', compact('pengumuman'));
    }

    public function mount($pelaksanaan, $status, $jadwal, $tata_tertib) 
    {
        $this->jadwal = $jadwal;
        $this->status = $status;
        $this->pelaksanaan = $pelaksanaan;
        $this->tata_tertib = $tata_tertib;
    }

    public function setTabActive($value) 
    {
        $this->tabActive[$value] = true;

        $otherPage = array_filter($this->tabActive, function($key) use($value) {
            return $key != $value;
        }, ARRAY_FILTER_USE_KEY);

        foreach($otherPage as $key => $value) 
        {
            $this->tabActive[$key] = false;
        }

        if($value == 'ujian') $this->dispatchBrowserEvent('startCountdown');
    }

    public function redirectToUjian()
    {
        return redirect()->route('ujian.mulai');
    }
}
