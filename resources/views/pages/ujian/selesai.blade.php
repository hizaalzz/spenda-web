@extends('layouts.test')
@section('title', 'Ujian Selesai')
@section('content')
    <div id="container">
        <x-alert-test />
        <div class="card">
            <div class="card-body">
                <div class="flex flex-col justify-center items-center mt-4">
                    <p class="text-lg font-semibold">
                        Ujian telah selesai, semoga nilai kamu memuaskan. 
                        Jangan lupa untuk terus belajar dirumah 
                    </p>
                    <img src="{{ asset('/images/book.svg') }}" alt="" class="md:w-1/2 lg:w-1/2 w-full">
                    "Barang siapa bersungguh-sungguh, maka dia akan mendapatkan kesuksesan."
                    <a href="{{ route('logout') }}" class="btn btn-blue hover:bg-blue-400 my-4">Logout</a>

                </div>
               
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', event => {
            localStorage.clear();
        });
    </script>
@endpush