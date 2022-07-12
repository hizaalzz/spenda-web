<div class="modal @if(!$show)opacity-0 pointer-events-none @endif fixed w-full h-full top-0 left-0 flex items-center justify-center z-50" id="modal-info">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">{{ $title }}</p>
                <div class="modal-close cursor-pointer z-50" wire:click="toggleModalEventHandler(false)">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>

            <!--Body-->
            <!--Loading Indicator-->
            <div class="w-full flex justify-center" wire:loading>
                <div class="loader">
                    <svg class="circular" viewBox="25 25 50 50">
                      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                    </svg>
                </div>
            </div>
        
            <p wire:loading.remove>{!! Purifier::clean($content) !!}</p>

            <!--Footer-->
            <div class="flex justify-end pt-2">
                <button class="modal-close px-3 bg-indigo-500 py-2 rounded-lg text-white hover:bg-indigo-400" wire:click="toggleModalEventHandler(false)">Tutup</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function toggleModal(state = false, id = null)  {
            let body = document.querySelector('body');
            let modalInfo = document.querySelector('#modal-info');

            modalInfo.classList.toggle('opacity-0');
            modalInfo.classList.toggle('pointer-events-none');
            body.classList.toggle('modal-active');

            Livewire.emit('toggleModalInfo', state);
            Livewire.emit('getInfo', id);
        }
    </script>
@endpush