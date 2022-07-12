<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true" id="{{ $modalName }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $content }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitForm('{{ $formName }}');">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function submitForm(formName) {
            let form = $(`#${formName}`);
            form.validate({
                errorPlacement: function errorPlacement(error, element) { element.before(error); }
            });

            if(form.valid()) form.submit();
        }

        function showFormModal(modalName) {
            $(`#${modalName}`).modal('show');
        }


    </script>
@endpush