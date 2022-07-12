<div class="card">
    <div class="w-full flex flex-wrap border-b border-gray-300">
        <div class="px-2 pt-1 text-sm md:text-base lg:text-base ">
            <button class="btn-tab hover:bg-gray-200 focus:outline-none @if($tabActive['pengumuman'])active @endif" wire:click="setTabActive('pengumuman')">Pengumuman</button>
            <button class="btn-tab hover:bg-gray-200 focus:outline-none @if($tabActive['ujian'])active @endif" wire:click="setTabActive('ujian')">Ujian</button>
        </div>
    </div>
    <div class="card-body">
        @if($tabActive['pengumuman'])
            <h2 class="header">Pengumuman</h2>
            <hr class="garis">
            <table class="border w-full mt-4">
                <thead>
                    <tr>
                        <th class="px-3 py-2 text-left">Judul</th>
                        <th class="px-3 py-2 text-left">Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @if($pengumuman != null)
                        @forelse ($pengumuman as $item)
                            <tr>
                                <td class="px-3 py-2 bg-gray-100 text-sm">
                                    <a onclick="toggleModal(true, {{ $item->id }});" class="text-blue-500 cursor-pointer">{{ $item->judul }}</a>
                                </td>
                                <td class="px-3 py-2 text-sm">{{ $item->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Tidak ada pengumuman</td>
                            </tr>
                        @endforelse
                        {{ $pengumuman->links() }}
                    @endif
                </tbody>
            </table>
        @endif
        @if($tabActive['ujian'])
            @if($pelaksanaan == null || $jadwal == null || $status == null)
                <div class="flex flex-col justify-center items-center">
                    <h3 class="text-3xl">Anda tidak memiliki ujian aktif</h3>
                    <img src="{{ asset('/images/notfound.svg') }}" alt="" class="w-1/2">
                    <a href="{{ route('logout') }}" class="btn btn-blue hover:bg-blue-400">Logout</a>
                </div>
            @else 
                <h2 class="header">Tata Tertib Ujian</h2>
                <hr class="garis">
                <div class="p-4">
                    {!! Purifier::clean($tata_tertib) ?? '-' !!}
                </div>
                
                <h2 class="header mt-2">Informasi Ujian</h2>
                <hr class="garis">
                <table class="w-full mt-4">
                    <tr>
                        <td class="w-1/4">Nama Siswa</td>
                        <td>: <span class="ml-4">{{ Auth::user()->murid->nama }}</span></td>
                    </tr>
                    <tr>
                        <td class="w-1/4">Kelas</td>
                        <td>: <span class="ml-4">{{ Auth::user()->murid->kelas->nama_kelas }}</span></td>
                    </tr>
                    <tr>
                        <td class="w-1/4">Mata Pelajaran</td>
                        <td>: <span class="ml-4">{{ $jadwal->matapelajaran->nama ?? '' }}</span></td>
                    </tr>
                    <tr>
                        <td class="w-1/4">Sesi</td>
                        <td>: <span class="ml-4">{{ $pelaksanaan->sesi->nama }}</span></td>
                    </tr>
                </table>
                
                <h2 class="header mt-2">Mulai Ujian</h2>
                <hr class="garis">
                @if($status->token != null)
                    <p class="mt-4">Masukkan token yang diberikan oleh petugas</p>
                    {!! Form::open(['route' => 'ujian.verifikasi', 'class' => 'flex flex-col items-center my-8']) !!}
                    {!! Form::hidden('jadwal_id', $jadwal->id) !!}
                    {!! Form::hidden('sesi_id', $pelaksanaan->sesi_id) !!}
                    {!! Form::text('token', null, ['class' => 'px-2 py-1 border border-gray-500 focus:outline-none rounded', 
                    'placeholder' => 'Token ujian', 'autocomplete' => 'off', 'required']) !!}
                    {!! Form::submit('Mulai', ['class' => 'btn btn-blue hover:bg-blue-400 mt-1 disabled', 'id' => 'mulaibtn', 'disabled']) !!}
                    {!! Form::close() !!}
                @else 
                    <div class="flex justify-center my-4">
                        <button wire:click="redirectToUjian" class="btn btn-blue hover:bg-blue-400 disabled" id="mulaibtn" disabled>Mulai</button>
                    </div>
                @endif
            @endif
        @endif
    </div>
</div>
@push('scripts')
<script>
    window.addEventListener('startCountdown', event => {
        let mulaitBtn = document.querySelector('#mulaibtn');
        const sesi = "{{ $pelaksanaan->sesi ?? null }}";

        if(sesi !== null) {
            let sesiStart = "{{ $pelaksanaan->sesi->start ?? '-' }}";

            console.log(sesiStart);
            const date = "{{ TimeHelper::convert($jadwal->tanggal ?? '', 'Y-m-d') ?? '-' }}";

            const start = `${date} ${sesiStart}`;

            console.log(start);

            let timeEnd = moment(start, 'YYYY-MM-DD hh:mm').toDate();

            const countdownTimer = setInterval(() => {
                const countdownTick = countdown(timeEnd);

                if(countdownTick.hours <= 0 && countdownTick.minutes <= 0 && countdownTick.seconds <= 0) {
                    clearInterval(countdownTimer);

                    if(mulaitBtn) {
                        mulaitBtn.removeAttribute('disabled');
                        mulaitBtn.classList.remove('disabled');
                    }
                }

            }, 1000);
        }
       
    });

    function countdown(endtime) {
        const totalDate = Date.parse(endtime) - Date.parse(new Date());
        const seconds = Math.floor((totalDate / 1000) % 60);
        const minutes = Math.floor((totalDate / 1000/ 60) % 60);
        const hours = Math.floor((totalDate / (1000 * 60 * 60)) % 24);
        const days = Math.floor(totalDate/(1000*60*60*24));

        return {
            totalDate,
            seconds,
            minutes,
            hours,
            days
        };
    }
</script>
@endpush