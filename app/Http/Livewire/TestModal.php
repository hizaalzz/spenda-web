<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Score;
use Exception;
use ActiveStatus;
use App\Models\Nilai;
use App\Models\Jawaban;

class TestModal extends Component
{
    public $title = '';
    public $content = '';

    public $type;
    public $show = false;

    public $jadwal;

    public $listeners = [
        'changeType' => 'changeTypeEventHandler',
        'ujianSelesai' => 'ujianSelesaiEventHandler',
        'toggleModal' => 'toggleModalEventHandler',
        'changeContent' => 'changeContentEventHandler'
    ];

    public function render()
    {
        return view('livewire.test-modal');
    }

    public function mount($jadwal) 
    {
        $this->jadwal = $jadwal;
    }

    public function changeTypeEventHandler($type)
    {
        $this->type = $type;
    }

    public function changeContentEventHandler($title, $content) 
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function ujianSelesaiEventHandler() 
    {

        $jawaban = Jawaban::where('jadwal_id', $this->jadwal->id)->where('murid_id', auth()->user()->murid->id)->get();
        $countEssay = $this->jadwal->banksoal->soal->where('jenis', 2)->count();

        $score = $countEssay > 0 ? 0 : Score::count($jawaban, $this->jadwal);

        $nilai = new Nilai();

        $nilai->jadwal_id = $this->jadwal->id;
        $nilai->murid_id = auth()->user()->murid->id;
        $nilai->nilai = $score;
        $nilai->status = 'Belum';
        
        $nilai->save();

        session(['endtoken' => ActiveStatus::generateToken(8)]);

        return redirect()->route('ujian.selesai', ['endtoken' => session('endtoken')]);
    }

    public function toggleModalEventHandler($value) 
    {
        $this->show = $value;
    }

    public function hideModal() 
    {
        $this->show = false;
    }
}
