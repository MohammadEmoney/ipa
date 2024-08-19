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
                @can('active_user')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">{{ __('global.documents') }}</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('user.documents.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-notes"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.documents') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('user.circulars.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-license"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.circular') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('user.news.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.news') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('user.critics.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-message-dots"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.critics') }}</span>
                        </a>
                    </li>
                @endcan
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">{{ __('global.settings') }}</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.profile.edit') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">{{ __('global.profile') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.users.password') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-key"></i>
                        </span>
                        <span class="hide-menu">{{ __('global.password') }}</span>
                    </a>
                </li>
                
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">{{ __('global.lang') }}</span>
                </li>
                <li class="sidebar-item">
                    <livewire:admin.settings.live-default-language />
                </li>
            </ul>
        </nav>
        
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
