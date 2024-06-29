<h5 class="text-center">{{ __('global.verification') }}</h5>
<form wire:submit.prevent="verification">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="firstNameInputtext1" class="form-label">{{ __('global.otp_code') }} *</label>
                <input type="text" class="form-control" wire:model="otp_code"
                    id="firstNameInputtext1" aria-describedby="textHelp" placeholder="{{ __('global.otp_code') }}">
                <div>@error('otp_code') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" >
                <span class="spinner-border spinner-border-sm" wire:loading></span> {{ __('global.continue') }}
            </button>
        </div>
    </div>
</form>
