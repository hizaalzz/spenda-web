<div>
    <div class="loader" style="width: 24px !important;" wire:loading>
        <svg class="circular" viewBox="25 25 50 50" style="width: 24px;">
          <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <span wire:loading.remove>{{ $nilai }}</span>
</div>
