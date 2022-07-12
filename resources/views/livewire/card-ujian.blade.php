<div class="card mb-4">
    <div class="px-4 py-2 flex flex-col md:flex-row lg:flex-row" id="header-card">
        <div class="mr-auto inline-flex font-bold">
            <span class="m-auto mr-2">No. </span>
            <span class="py-2 px-3 bg-blue-500 rounded text-white my-auto">{{ $currentNumber + 1 }}</span>
            <span class="m-auto ml-2">/ {{ count($soal) }}</span>
            <p class="hidden" id="active">{{ $soal[$currentNumber]->id }}</p>
        </div>
        <div class="w-full md:w-auto lg:w-auto md:ml-auto lg:ml-auto flex">
            <div class="flex">
                <span class="my-auto mr-2 text-sm md:text-base lg:text-base">Ukuran teks : </span>
                <div class="opsi-font">
                    <input type="radio" name="ukuranteks" id="kecil" class="hidden" checked onchange="setFontSize(fontvariant.KECIL);">
                    <label for="kecil" class="text-base radio-check-label">A</label>
                </div>
                <div class="opsi-font">
                    <input type="radio" name="ukuranteks" id="sedang" class="hidden" onchange="setFontSize(fontvariant.SEDANG);">
                    <label for="sedang" class="text-lg radio-check-label">A</label>
                </div>
                <div class="opsi-font">
                    <input type="radio" name="ukuranteks" id="besar" class="hidden" onchange="setFontSize(fontvariant.BESAR);">
                    <label for="besar" class="text-xl radio-check-label">A</label>
                </div>
            </div>
            <div class="ml-auto">
                @livewire('countdown')
            </div>
        </div>
    </div>
    <hr class="garis">
    {{-- Loading Indicator --}}
    <div class="w-full py-4 flex justify-center items-center" wire:loading wire:init="renderCompleted">
        <div class="loader">
          <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
          </svg>
        </div>
    </div>
    <div class="px-4 py-2 mt-4 flex flex-col" id="soalContent" wire:loading.remove>
        {{-- Rendering content --}}

        <x-content-display :konten='$konten' layout="top" />

        {{-- Rendering soal --}}

        <p class="my-2">{!! $soal[$currentNumber]->isi !!}</p>

        {{-- Rendering content --}}

        <x-content-display :konten='$konten' layout="bottom" />

        
        {{-- Rendering pilihan ganda --}}
        <x-soal-display :soal="$soal[$currentNumber]" />
    </div>
</div>
@push('scripts')
    <script>
        const type = {
            pilihanGanda: 1,
            essay: 2
        }

        function loadAnswer(data = null, soalType) {            
            soalType = parseInt(soalType);

            let pilihanGandaElement = document.querySelectorAll('input[name="pilihanganda"]');

            switch(soalType) {
                case type.pilihanGanda: 

                    let opsiPilihanGanda = Array.from(pilihanGandaElement);

                    opsiPilihanGanda.forEach((pilihan) => {
                        switch(data) {
                            case null:
                                pilihan.checked = false;
                                break;
                            default:

                                if(pilihan.value == data.jawaban) {
                                    pilihan.checked = true;
                                }
                        }
                    });

                    break;
                case type.essay: 
                    let jawaban = document.querySelector('#jawaban');

                    if(data !== null && jawaban !== "") {
                        jawaban.value = data.jawaban;
                    } else {
                        jawaban.value = '';
                    }
            }
        }
        
        window.addEventListener('savedDataLoaded', event => {
            loadAnswer(event.detail.active, event.detail.type);
        });

        window.addEventListener('errorOnSubmit', event => {
            Swal.fire('Terjadi Kesalahan', 'Tidak dapat mengakhiri ujian', 'error');
        });
    </script>
@endpush