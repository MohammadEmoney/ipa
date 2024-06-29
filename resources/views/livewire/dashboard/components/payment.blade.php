<h5 class="text-center">{{ __('global.membership_fee') }}</h5>
<form wire:submit.prevent="pay">
    <div class="row">
        <div class="col-md-12 text-center">
            <p>{{ $settings['membership_description'] ?? "" }}</p>
            <h3><i class="bi bi-cash-stack text-warning"></i> {{ number_format($settings['membership_fee'] ?? 0) }} {{ __('global.toman') }}</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" >
                <span class="spinner-border spinner-border-sm" wire:loading></span> {{ __('global.pay') }}
            </button>
        </div>
    </div>
</form>
