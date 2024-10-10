<h5 class="text-center">{{ __('global.login') }}</h5>
                        
<form wire:submit.prevent="login">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">{{ __('global.username') }}</label>
        <input type="email" class="form-control" id="exampleInputEmail1" wire:model="email"
            aria-describedby="emailHelp">
        <div>@error('email') {{ $message }} @enderror</div>
    </div>
    <div class="mb-4 position-relative">
        <label for="exampleInputPassword1" class="form-label">{{ __('global.password') }}</label>
        <input type="password" class="form-control" id="exampleInputPassword1" wire:model="password">
        <i class="fa fa-eye password-icon"></i>
        <div>@error('password') {{ $message }} @enderror</div>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="form-check">
            <input class="form-check-input primary" type="checkbox" value="1"
                id="flexCheckChecked" checked wire:model="remember_me">
            <label class="form-check-label text-dark" for="flexCheckChecked">
                {{ __('global.remember_me') }}
            </label>
        </div>
        {{-- <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a> --}}
    </div>
    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" >
        <span class="spinner-border spinner-border-sm" wire:loading></span> {{ __('global.login') }}
    </button>
</form>