{{-- <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100 mt-5">
                <div class="col-md-5 col-xxl-6 mt-5">
                    <div class="card mb-0 form-left h-100">
                        <div class="card-body">
                            <p class="text-center">{{ __('global.login') }}</p>
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
                                    <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" >
                                    <span class="spinner-border spinner-border-sm" wire:loading></span> {{ __('global.login') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ps-0 d-none d-md-block mt-5">
                    <div class="form-right h-100 bg-transparent text-white text-center pt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8 mt-2">
                                <img src="{{ $logo }}" alt="{{ $settings['title'] ?? env('APP_NAME') }}" class="img-fluid">
                            </div>
                        </div>
                        <h2 class="fs-3 text-black mt-3">{{ __('global.welcome') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div>
    @include('livewire.front.components.live-breadcrumb', [
        'title' => $title, 
        'items' => [['title' => __('global.home'), 'route' => route('home')], ['title' => $title]],
        'background' => '',
        'subTitle' => '',
    ])
    @if ($step === 'info')
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <section class="">
                        <div class="container-fluid mb-4">
                            <div class="row">
                                <div class="col-sm-6 text-black">
                                    <div class="d-flex justify-content-center">
                                        <div class="mt-2">
                                            <img src="{{ $logo }}" alt="{{ $settings['title'] ?? env('APP_NAME') }}" width="220px">
                                        </div>
                                    </div>
                                    <div class="h-custom-2 px-5 ms-xl-4 mt-3 pt-5 pt-xl-0 mt-xl-n5">
                                        @includeWhen($step === 'info', 'livewire.dashboard.components.login-form')
                                        <div class="text-center">{!! __('messages.have_no_account', ['link' => route('register')]) !!}</div>
                                    </div>
                        
                                </div>
                                <div class="col-sm-6 px-0 d-none d-sm-block" style="max-width: 30em;">
                                    <img src="{{ $background ?: asset('Impact/assets/img/login.jpg') }}"
                                        alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    @else
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            <div class="position-relative overflow-hidden radial-gradient min-vh-100 align-items-center justify-content-center">
                <div class="align-items-center justify-content-center w-100">
                    <section class="">
                        <div class="container-fluid mb-4">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 m-auto text-black">
                                    <div class="d-flex justify-content-center">
                                        <div class="mt-2">
                                            <img src="{{ $logo }}" alt="{{ $settings['title'] ?? env('APP_NAME') }}" width="220px">
                                        </div>
                                    </div>
                                    <div class="h-custom-2 px-5 ms-xl-4 mt-3 pt-5 pt-xl-0 mt-xl-n5">
                                        @includeWhen($step === 'confirm', 'livewire.dashboard.components.confirm')
                                        @includeWhen($step === 'upload', 'livewire.dashboard.components.upload')
                                        @includeWhen($step === 'payment', 'livewire.dashboard.components.payment')
                                        <div class="text-center">{!! __('messages.have_account', ['link' => route('login')]) !!}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6 px-0 d-none d-sm-block">
                                    <img src="{{ asset('Impact/assets/img/register.jpg') }}"
                                        alt="Register image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                                </div> --}}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    @endif
</div>
@script
<script>
    $wire.on('autoFocus', () => {
        $(document).ready(function () {
            console.log('invalid-input Focus');
            $('.form-control').focus()
        });
    })
</script>
@endscript

@push('scripts')
    <script>
        $('.password-icon').on('click', function() {
            console.log('asdasd');
            
            $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye'); // toggle our classes for the eye icon
            var type = $(this).siblings("input").attr("type");
            // now test it's value
            if( type === 'password' ){
                $(this).siblings("input").attr("type", "text");
            }else{
                $(this).siblings("input").attr("type", "password");
            }
        });
    </script>
@endpush