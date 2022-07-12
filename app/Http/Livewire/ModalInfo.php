<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Pengumuman;

class ModalInfo extends Component
{
    public $title;
    public $content;

    public $show = false;

    protected $listeners = [
        'getInfo' => 'getInfoEventHandler',
        'toggleModalInfo' => 'toggleModalEventHandler' 
    ];

    public function render()
    {
        return view('livewire.modal-info');
    }

    public function getInfoEventHandler($id) 
    {
        $pengumuman = Pengumuman::find($id, ['judul', 'konten']);

        $this->title = $pengumuman->judul;
        $this->content = $pengumuman->konten;
    }

    public function toggleModalEventHandler($value) 
    {
        $this->show = $value;
    }
}
