<div>
    <div class="row">
        <h2>{{ __('global.welcome') }}</h2>
    </div>
    <div class="row g-6 mb-6">
        @can('card_status')
            <div class="col-xl-3 col-sm-6 col-12 cursor-pointer" wire:click="redirectTo('admin.users.index')">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="h6 font-semibold text-muted text-sm d-block mb-2">{{ __('global.registerd_users') }}</span>
                                <span class="h3 font-bold mb-0">{{ $users }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="fs-5">
                                    <i class="ti ti-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-3 col-sm-6 col-12 cursor-pointer" wire:click="redirectTo('admin.users.index')">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="h6 font-semibold text-muted text-sm d-block mb-2">کارمندان ثبتنام شده</span>
                                <span class="h3 font-bold mb-0">{{ $staff }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="fs-5">
                                    <i class="ti ti-users"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 mb-0 text-sm">
                            <span class="badge badge-pill bg-soft-success text-success me-2">
                                <i class="bi bi-arrow-up me-1"></i>30%
                            </span>
                            <span class="text-nowrap text-xs text-muted">Since last month</span>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-3 col-sm-6 col-12 cursor-pointer" wire:click="redirectTo('admin.posts.index')">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="h6 font-semibold text-muted text-sm d-block mb-2">{{ __('global.posts') }}</span>
                                <span class="h3 font-bold mb-0">{{ $posts }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="fs-5">
                                    <i class="ti ti-notes"></i>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mt-2 mb-0 text-sm">
                            <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                <i class="bi bi-arrow-down me-1"></i>-5%
                            </span>
                            <span class="text-nowrap text-xs text-muted">Since last month</span>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 cursor-pointer" wire:click="redirectTo('admin.dashboard')">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="h6 font-semibold text-muted text-sm d-block mb-2">{{ __('global.orders') }}</span>
                                <span class="h3 font-bold mb-0">{{ $orders }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="fs-5">
                                    <i class="ti ti-credit-card"></i>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mt-2 mb-0 text-sm">
                            <span class="badge badge-pill bg-soft-success text-success me-2">
                                <i class="bi bi-arrow-up me-1"></i>10%
                            </span>
                            <span class="text-nowrap text-xs text-muted">Since last month</span>
                        </div> --}}
                    </div>
                </div>
            </div>
        @endcan
    </div>
</div>
