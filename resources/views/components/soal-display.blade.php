<div>
    @if($soal->jenis == 1)
    <ul class="flex flex-col list-none px-4 my-3">
        <li class="pilihan-ganda">
            <input type="radio" name="pilihanganda" id="A" class="hidden" value="A">
            <label for="A" class="flex w-6 h-6 rounded-full border-2 border-gray-800 radio-check hover:text-gray-600 hover:border-gray-600">
                <label for="A" class="m-auto text-sm">A</label>
            </label>
            <label for="A" class="ml-2 my-auto hover:text-gray-600 radio-check-label">{!! $soal->pilA !!}</label>
        </li>
        <li class="pilihan-ganda">
            <input type="radio" name="pilihanganda" id="B" class="hidden" value="B">
            <label for="B" class="flex w-6 h-6 rounded-full border-2 border-gray-800 radio-check hover:text-gray-600 hover:border-gray-600">
                <label for="B" class="m-auto text-sm">B</label>
            </label>
            <label for="B" class="ml-2 my-auto hover:text-gray-600 radio-check-label">{!! $soal->pilB !!}</label>
        </li>
        @if($soal->pilC)
        <li class="pilihan-ganda">
            <input type="radio" name="pilihanganda" id="C" class="hidden" value="C">
            <label for="C" class="flex w-6 h-6 rounded-full border-2 border-gray-800 radio-check hover:text-gray-600 hover:border-gray-600">
                <label for="C" class="m-auto text-sm">C</label>
            </label>
            <label for="C" class="ml-2 my-auto hover:text-gray-600 radio-check-label">{!! $soal->pilC !!}</label>
        </li>
        @endif
        @if($soal->pilD)
        <li class="pilihan-ganda">
            <input type="radio" name="pilihanganda" id="D" class="hidden" value="D">
            <label for="D" class="flex w-6 h-6 rounded-full border-2 border-gray-800 radio-check hover:text-gray-600 hover:border-gray-600">
                <label for="D" class="m-auto text-sm">D</label>
            </label>
            <label for="D" class="ml-2 my-auto hover:text-gray-600 radio-check-label">{!! $soal->pilD !!}</label>
        </li>
        @endif
        @if($soal->pilE)
        <li class="pilihan-ganda">
            <input type="radio" name="pilihanganda" id="E" class="hidden" value="E">
            <label for="E" class="flex w-6 h-6 rounded-full border-2 border-gray-800 radio-check hover:text-gray-600 hover:border-gray-600">
                <label for="E" class="m-auto text-sm">E</label>
            </label>
            <label for="E" class="ml-2 my-auto hover:text-gray-600 radio-check-label">{!! $soal->pilE !!}</label>
        </li>
        @endif
    </ul>
    @else
        <div class="mt-4">
            <label for="jawaban" class="text-sm">Tulis jawaban</label>
            <textarea name="jawaban" id="jawaban" cols="30" rows="10" class="w-full border border-gray-300 focus:outline-none rounded-sm text-sm p-2"
            placeholder="Tulis jawaban kamu disini.."></textarea>
        </div>
    @endif
</div>