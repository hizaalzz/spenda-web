<div class="modal fade soal-modal" tabindex="-1" role="dialog" aria-labelledby="soalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="soalModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="isi">
                    
                </p>
                <div class="d-flex">
                    <span class="font-weight-bold">A.</span>
                    <span class="pilihan-isi ml-2" id="pilA"></span>
                </div>
                <div class="d-flex">
                    <span class="font-weight-bold">B.</span>
                    <span class="pilihan-isi ml-2" id="pilB"></span>
                </div>
                <div class="d-flex" id="pilihan-C">
                    <span class="font-weight-bold">C.</span>
                    <span class="pilihan-isi ml-2" id="pilC"></span>
                </div>
                <div class="d-flex" id="pilihan-D">
                    <span class="font-weight-bold">D.</span>
                    <span class="pilihan-isi ml-2" id="pilD"></span>
                </div>
                <div class="d-flex" id="pilihan-E">
                    <span class="font-weight-bold">E.</span>
                    <span class="pilihan-isi ml-2" id="pilE"></span>
                </div>
                <hr>
                <div class="mt-4">
                    <h6>Kunci jawaban</h6>
                    <p id="kunci-jawaban"></p>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function showDetailSoal(id) {
            const soal = Object.values(@json($soal ?? ''));
            
            let soalDipilih = soal.find(x => x.id == id);

            manipulateModal(soalDipilih);

            $('.soal-modal').modal('show');
        }

        function manipulateModal(data) {
            $('#soalModalLabel').text(`Soal nomor ${data.nomor_soal}`);

            $('#pilA').html(data.pilA);
            $('#pilB').html(data.pilB);
            $('#pilC').html(data.pilC);
            $('#pilD').html(data.pilD);
            $('#pilE').html(data.pilE);
            
            $('#kunci-jawaban').text(data.kunci_jawaban);
            $('.isi').html(data.isi);

        }
    </script>
@endpush