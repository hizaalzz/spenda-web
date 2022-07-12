<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InputNilai extends Component
{
    public $nilai;

    protected $listeners = ['scoreChanged' => 'onScoreChanged'];

    public function onScoreChanged($score) 
    {
        $this->nilai = $score;
    }

    public function render()
    {
        return view('livewire.input-nilai');
    }
}
