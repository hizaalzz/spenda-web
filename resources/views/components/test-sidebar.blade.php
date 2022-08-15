<div class="sidebar absolute flex flex-col px-3 py-2 right-0 bg-white shadow-lg">
    <div class="flex pb-4 pt-2">
        {{-- <div class="flex flex-col">
            <h3 class="text-xl">Daftar Soal</h3>
            <div class="text-gray-700 text-xs" id="count">
                <span class="text-blue-500" id="answered">0</span> Terjawab,
                <span class="text-yellow-700" id="doubt">0</span> Ragu-ragu,
            </div>
        </div> --}}
        <button class="ml-auto px-2 py-2 bg-transparent hover:bg-gray-100 focus:outline-none closebtn">
            <i class="fas fa-times text-red-500"></i>
        </button>
    </div>
    <hr class="border border-gray-200">
    <div class="flex flex-wrap mt-2">
        @if(isset($soal) && $soal != "")
            @foreach($soal as $item)
            <div class="soal border border-blue-500 cursor-pointer hover:bg-blue-200 flex w-10 h-10 m-2 rounded" data-target="{{ $item->id }}"
                onclick="navigate({{ $loop->index }})">
                    <p class="m-auto">{{ $loop->index + 1 }}</p>
            </div>
            @endforeach
        @endif
    </div>
</div>
@push('scripts')
<script>
    function navigate(target) {
        const soalType = document.querySelector('#type');

        let jawaban = soalType.innerHTML == 1 ? document.querySelector('input[name="pilihanganda"]:checked') : document.querySelector('#jawaban');

        let ragu = document.querySelector('#ragu');

        if(jawaban !== null) {
            Livewire.emit('pageChange', 'next', target, jawaban.value, ragu.checked);
        } else {
            Livewire.emit('pageChange', 'index', target);
        }
    }

</script>
@endpush
