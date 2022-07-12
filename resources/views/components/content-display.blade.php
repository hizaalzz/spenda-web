<div>
    {{-- Konten --}}
    @if($konten != null)
        @foreach ($konten as $item)
            @if($item->layout == $layout)
                @if($item->type == 'image')
                    <img src="{{ url('/storage/images/soal/') . '/' . $item->isi }}" alt="" class="md:w-1/2 lg:w-1/2 w-full object-cover">
                @else
                    <audio controls>
                        <source src="{{ url('/storage/audio/') . '/' . $item->isi }}">
                        Browser anda tidak mendukung audio
                    </audio>   
                @endif
            @endif
        @endforeach 
    @endif
</div>