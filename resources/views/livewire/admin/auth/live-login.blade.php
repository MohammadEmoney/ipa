<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            {{-- <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                            </a> --}}
                            <p class="text-center">{{ __('global.admin_login') }}</p>
                            <form wire:submit.prevent="login">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{ __('global.username') }}</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" wire:model="email"
                                        aria-describedby="emailHelp">
                                    <div>@error('email') {{ $message }} @enderror</div>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label">{{ __('global.password') }}</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" wire:model="password">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
