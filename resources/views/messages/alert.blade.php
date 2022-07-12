@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
    @foreach($errors->all() as $error)
    {{ $error }} <br>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
    {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
