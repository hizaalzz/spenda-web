<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Status;

class Aktivasi extends Component
{
    public $statusDipilih = 'Aktif';

    public function render()
    {
        $status = $this->statusDipilih == 'Aktif' ? Status::whereActive()->get() : 
            Status::whereNonActive()->get();

        return view('livewire.aktivasi', compact('status'));
    }
}
