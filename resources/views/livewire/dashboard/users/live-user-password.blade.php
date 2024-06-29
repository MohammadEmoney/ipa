<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[]" />
        <div class="card">
            <div class="card-body">
                <h3 class="">{{ __('global.change_password') }}</h3>
                <div>
                    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
                        data-sidebar-position="fixed" data-header-position="fixed">
                        <div class="d-flex align-items-center justify-content-center w-100">
                            <div class="row justify-content-center w-100">
                                <div class="col-md-12">
                                    <div class="card mb-3 mt-3">
                                        <div class="card-body">
                                            <form wire:submit.prevent="submit">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-4 position-relative" wire:ignore>
                                                            <label for="exampleInputPassword1" class="form-label">{{ __('global.current_password') }}</label>
                                                            <input type="password" class="form-control password" id="exampleInputPassword1" wire:keyup="checkData" wire:model="data.current_password">
                                                            <i class="ti ti-eye password-icon"></i>
                                                        </div>
                                                        <div>
                                                            @error('data.current_password')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-4 position-relative" wire:ignore>
                                                            <label for="exampleInputPassword1" class="form-label">{{ __('global.password') }}</label>
                                                            <input type="password" class="form-control password" id="exampleInputPassword1" wire:keyup="checkData" wire:model="data.password">
                                                            <i class="ti ti-eye password-icon"></i>
                                                        </div>
                                                        <div>
                                                            @error('data.password')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-4 position-relative" wire:ignore>
                                                            <label for="exampleInputPassword2" class="form-label">{{ __('global.password_confirmation') }}</label>
                                                            <input type="password" class="form-control password" id="exampleInputPassword2" wire:keyup="checkData" wire:model="data.password_confirmation">
                                                            <i class="ti ti-eye password-icon"></i>
                                                        </div>
                                                        <div>
                                                            @error('data.password_confirmation')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="submit"
                                                                class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-0">
                                                                <span class="spinner-border spinner-border-sm"
                                                                wire:loading></span> {{ __('global.submit') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function () {
            $('.password-icon').on('click', function() {
                $(this).toggleClass('ti-eye-off').toggleClass('ti-eye'); // toggle our classes for the eye icon
                var type = $(this).siblings("input").attr("type");
                // now test it's value
                if( type === 'password' ){
                    $(this).siblings("input").attr("type", "text");
                }else{
                    $(this).siblings("input").attr("type", "password");
                }
            });
        });
    </script>
@endpush
