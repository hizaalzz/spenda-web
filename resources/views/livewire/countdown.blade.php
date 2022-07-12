<div class="py-2 px-1 ml-2 border border-gray-800 rounded shadow text-sm">
    <i class="far fa-clock mr-1"></i>
    Waktu : <span class="text-blue-500 mx-1 sisa-waktu">00:59:30</span>
</div>
@push('scripts')
    <script>
        const end = "{{ $end }}";
        const start = "{{ $start }}";

        let timeStart = moment(start, 'hh:mm').toDate();
        // let timeEnd = moment(timeStart).add(end, 'm').toDate();
        let timeEnd = moment(end, 'hh:mm').toDate();

        //const duration 

        let sisaWaktu = document.querySelector('.sisa-waktu');

        const countdownTimer = setInterval(() => {
            const countdownTick = countdown(timeEnd);
            sisaWaktu.innerHTML = `${countdownTick.hours}:${countdownTick.minutes}:${countdownTick.seconds}`;

            if(countdownTick.hours == 0 && countdownTick.minutes == 0 && countdownTick.seconds == 0) {
                clearInterval(countdownTimer);

                Livewire.emit('changeType', 'time');


                Livewire.emit('ujianSelesai');
            }
        }, 1000);


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