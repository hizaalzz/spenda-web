<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Jawaban;

class CardUjian extends Component

{
    public $currentNumber = 0;

    public $soal;
    public $jadwal;
    public $konten;
    
    //User Information
    public $usernis;
    public $userid;
    public $key;

    public $savedData;

    protected $listeners = [
        'pageChange' => 'pageChangeEventHandler',
        'renderCompleted' => 'renderCompleted'
    ];

    public function render()
    {
        $this->konten = $this->soal[$this->currentNumber]->konten;

        $this->usernis = auth()->user()->murid->nis;
        $this->userid = auth()->user()->murid->id;
        
        return view('livewire.card-ujian');
    }

    public function mount($soal, $jadwal) 
    {
        $this->soal = $soal;
        $this->jadwal = $jadwal;
    }

    public function dehydrateCurrentNumber($value) 
    {
       if($this->savedData === null || $this->savedData === []) {
            $this->savedData = Jawaban::where('murid_id', $this->userid)->where('jadwal_id', $this->jadwal->id)
            ->select('*')->get()->toArray();

            $this->renderCompleted();
       } 
       
    }

    public function pageChangeEventHandler($action = 'next', $index = null, $answer = null, $ragu = null) 
    {
        // Tereksekusi saat page atau nomor soal berubah

        // Jika jawaban tidak kosong atau sudah dipilih akan tersimpan di database
        if($answer != null) $this->saveAnswer($answer, $ragu);

        if($index !== null) {
            // Apabila nomor soal berubah dipilih dari sidebar maka set variable aktif berdasarkan variable index

            $this->currentNumber = $index;
        } else {
            // Set variable aktif berdasarkan aksi next atau back ++ jika next -- jika back

            $action == 'next' ? $this->currentNumber++ : $this->currentNumber--;
        }

        // Set konten gambar atau audio jika ada berdasarkan soal yang aktif
        $this->konten == $this->soal[$this->currentNumber]->konten;

        // Jika transisi perpindahan page sudah selesai jalanakan event tambahan
        $this->renderCompleted();

    }

    public function renderCompleted() {

        // Terapkan settingan size font
        $this->dispatchBrowserEvent('loadFontSettings');

        // Load jawaban dari database berdasarkan nomor soal yang aktif
        $activeAnswer = Jawaban::search($this->userid, $this->jadwal->id, $this->soal[$this->currentNumber]->id)->first();

        // Apabila sudah ada jawaban yang tersimpan
        if($this->savedData !== null) 
        {   
            // Jalankan event dengan passing beberapa data variable ke browser
            $this->dispatchBrowserEvent('savedDataLoaded', [
                'data' => $this->savedData,
                'active' => $activeAnswer,
                'type' => $this->soal[$this->currentNumber]->jenis
            ]);
        }
        
        $this->dispatchBrowserEvent('changeActive', [
            'data' => $this->savedData,
            'selected' => $this->soal[$this->currentNumber]->id
        ]);
    }

    public function saveAnswer($answer, $ragu) 
    {

        // Simpan jawaban ke database diupdate atau di buat baru
        $jawaban = Jawaban::updateOrCreate(
            [
                'soal_id' => $this->soal[$this->currentNumber]->id, 
                'murid_id' => $this->userid, 
                'jadwal_id' => $this->jadwal->id, 
                'paket_id' => $this->soal[$this->currentNumber]->paket_id
            ],
            [
                'jawaban' => $answer,
                'ragu' => $ragu
            ]
        );


        $searchAnswer = array_search($jawaban->soal_id, array_column($this->savedData, 'soal_id'));

        if($searchAnswer !== null) 
        {
            $savedAnswer = array_values(array_filter($this->savedData, function($v, $k) use($jawaban) {
                return $v['soal_id'] !== $jawaban->soal_id;
            }, ARRAY_FILTER_USE_BOTH));

            array_push($savedAnswer, $jawaban);

            $this->savedData = $savedAnswer;

        } else {
            $answerData = array_push($this->savedData, $jawaban);

            $this->savedData = $answerData;
        }
        
    }
}
