<form wire:submit.prevent="submit">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="firstNameInputtext1" class="form-label">{{ __('global.first_name') }} *</label>
                <input type="text" class="form-control" wire:model="data.first_name"
                    id="firstNameInputtext1" aria-describedby="textHelp" placeholder="{{ __('global.your_first_name') }}">
                <div>@error('data.first_name') {{ $message }} @enderror</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="lastNameInputtext1" class="form-label">{{ __('global.last_name') }} *</label>
                <input type="text" class="form-control" wire:model="data.last_name"
                    id="lastNameInputtext1" aria-describedby="textHelp" placeholder="{{ __('global.your_last_name') }}">
                <div>@error('data.last_name') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="phoneInputtext1" class="form-label">{{ __('global.phone_number') }}
                    *</label>
                <input type="text" class="form-control" wire:model="data.phone"
                    id="phoneInputtext1" aria-describedby="textHelp" placeholder="09123456789">
                <div>@error('data.phone') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{ __('global.email') }} *</label>
                <input type="email" autocomplete="username" class="form-control" wire:model="data.email"
                    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@email.com">
                <div>@error('data.email') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-4 position-relative">
            <label for="exampleInputPassword1" class="form-label">{{ __('global.password') }}</label>
            <input type="password" autocomplete="new-password" class="form-control password" id="exampleInputPassword1" wire:model="data.password">
            <i class="ti ti-eye password-icon"></i>
        </div>
        <div>
            @error('data.password')
                {{ $message }}
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-4 position-relative">
            <label for="exampleInputPassword2" class="form-label">{{ __('global.password_confirmation') }}</label>
            <input type="password" autocomplete="new-password" class="form-control password" id="exampleInputPassword2" wire:model="data.password_confirmation">
            <i class="ti ti-eye password-icon"></i>
        </div>
        <div>
            @error('data.password_confirmation')
                {{ $message }}
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" >
                <span class="spinner-border spinner-border-sm" wire:loading></span> {{ __('global.register') }}
            </button>
        </div>
    </div>
</form>
