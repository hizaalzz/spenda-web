<div>
    <footer class="flex w-full justify-between bottom-0 bg-white py-2 border border-gray-400">
        <div class="ml-3">
            <p class="hidden" id="number">{{ $active }}</p>
            <p class="hidden" id="type">{{ $soal[$active]->jenis }}</p>
            <button class="px-3 py-2 border border-gray-700 rounded text-gray-700 hover:border-gray-500 hover:text-gray-600 focus:outline-none
                text-xs md:text-base lg:text-base @if(!$previousButtonEnabled) disabled @endif" onclick="previousPage();" @if(!$previousButtonEnabled) disabled @endif>
                <i class="fas fa-long-arrow-alt-left mr-1"></i> Sebelumnya
            </button>
        </div>
        <div>
            <div class="px-3 py-2 bg-yellow-600 rounded cursor-pointer text-white hover:bg-yellow-500 text-xs md:text-base lg:text-base" onclick="checklist()">
                <input type="checkbox" name="ragu" id="ragu" class="mx-1"><i class="fas fa-question mr-1"></i> Ragu-ragu
            </div>
        </div>
        <div class="mr-3">
            <button class="btn-next text-xs md:text-base lg:text-base cursor-pointer" onclick="nextPage();" id="next-button">
                {{ $nextButtonText }} <i class="fas fa-long-arrow-alt-right ml-1"></i>
            </button>
        </div>
    </footer>
</div>
@push('scripts')
    <script>
        let soalIndex = document.querySelectorAll('.soal');

        const soalCount = "{{ count($soal) -1 }}";

        let countAnswer = document.querySelector('#answered');
        let hitungRagu = document.querySelector('#doubt');

        function checklist() {
            ragu.checked = !ragu.checked;
        }

        function nextPage() {
            const soalType = document.querySelector('#type');

            let jawaban = soalType.innerHTML == 1 ? document.querySelector('input[name="pilihanganda"]:checked') : document.querySelector('#jawaban');
            let nextButton = document.querySelector('#next-button');
            let ragu =  document.querySelector('#ragu');


            const currentNumber = document.querySelector('#number');
            const buttonText = nextButton.innerHTML;

            if(buttonText.includes('Selesai') || currentNumber.innerHTML == soalCount) {
                Livewire.emit('changeType', 'finish');

                // Set modal fill

                const ragu = parseInt(hitungRagu.innerHTML);
                const notAnswered = parseInt(soalCount) - parseInt(countAnswer.innerHTML);

                let content = '';

                if(ragu > 0) {
                    content += ` <b>Peringatan: </b> Kamu masih memiliki ${ragu} soal yang ragu-ragu <br><br>`;
                }

                if(notAnswered > 0) {
                    content += ` <b>Peringatan: </b> Kamu masih memiliki ${notAnswered} soal yang belum terjawab<br><br>`;
                }

                content += `Apakah kamu yakin ingin mengakhiri ujian ini?`;

                Livewire.emit('changeContent', 'Akhiri Ujian', content);
                Livewire.emit('toggleModal', true);

            } else {
                if(jawaban !== null) {
                    Livewire.emit('pageChange', 'next', null, jawaban.value, ragu.checked);
                } else {
                    Livewire.emit('pageChange', 'next');
                }
            }
        
        }

        function previousPage() {
            const soalType = document.querySelector('#type');            
            let jawaban = soalType.innerHTML == 1 ? document.querySelector('input[name="pilihanganda"]:checked') : document.querySelector('#jawaban');

            let ragu =  document.querySelector('#ragu');

            if(jawaban !== null) {
                Livewire.emit('pageChange', 'back', null, jawaban.value, ragu.checked);
            } else {
                Livewire.emit('pageChange', 'back');
            }
        }

        function loadState(active = null) {
            let ragu = document.querySelector('#ragu');

            // Set doubt checked or not
            if(active === null) {
                ragu.checked = false;

                return;
            }

            if(active.ragu == 0) {
                ragu.checked = false;
            } else if(active.ragu == 1) {
                ragu.checked = true;
            }

        }

        function loadIndicator(data = null, selected) {
            let pilihan = Array.from(soalIndex);
            let jawaban = data;

            pilihan.forEach((p) => {
                p.classList.remove('active');

                if(selected !== null) 
                {
                    if(p.getAttribute('data-target') == selected) {
                        p.classList.add('active');
                    }   
                }

                p.classList.remove('ragu', 'answered');
 
                if(jawaban !== null && jawaban.length > 0) {

                    const jawabanTerpilih = jawaban.find(j => j.soal_id == p.getAttribute('data-target'));

                    if(jawabanTerpilih != null && jawabanTerpilih.jawaban != null) {
                        if(jawabanTerpilih.ragu === true || jawabanTerpilih.ragu == '1') {
                            p.classList.add('ragu');
                        } else {
                            p.classList.add('answered');
                        }   
                    }
                    
                }

                // Count answered, doubt and not answered
                if(jawaban !== null) {
                    countAnswer.innerHTML = jawaban.filter(j => j.jawaban != null).length;
                    hitungRagu.innerHTML = jawaban.filter(j => j.ragu == true).length;
                }
            });
        }

        window.addEventListener('savedDataLoaded', event => {
            loadState(event.detail.active);
        });

        window.addEventListener('changeActive', event => {
            loadIndicator(event.detail.data, event.detail.selected);
        });

    </script>
@endpush
