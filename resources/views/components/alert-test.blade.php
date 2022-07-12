@if($errors->any()) 
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <span class="my-auto">{{ $error }}</span>
    @endforeach
    <button class="btn-sm bg-transparent hover:bg-gray-300 focus:outline-none ml-auto mr-1 rounded-sm" id="alert-button" onclick="closeAlert()">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif


@push('scripts')
    <script>
        function closeAlert() {
            document.querySelector('.alert').remove();
        }
    </script>
@endpush