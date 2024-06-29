<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="text-nowrap logo-img fs-6">
                {{-- <img src="/panel/src/assets/images/logos/dark-logo.svg" width="180" alt="" /> --}}
                {{ $settings['title'] ?? env('APP_NAME') }}
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">{{ __('global.home') }}</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">{{ __('global.dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">{{ __('global.orders') }}</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.orders.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-cash"></i>
                        </span>
                        <span class="hide-menu">{{ __('global.orders') }}</span>
                    </a>
                </li>
                {{-- <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">{{ __('global.settings') }}</span>
                </li>
                @can('general_settings')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.settings.general') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-settings"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.site_settings') }}</span>
                        </a>
                    </li>
                @endcan --}}
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.users.password') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-key"></i>
                        </span>
                        <span class="hide-menu">{{ __('global.password') }}</span>
                    </a>
                </li>
                @can('language_access')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">{{ __('global.default_language') }}</span>
                    </li>
                    <li class="sidebar-item">
                        <livewire:admin.settings.live-default-language />
                    </li>
                @endcan
            </ul>
        </nav>
        
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
