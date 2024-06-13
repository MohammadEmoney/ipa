<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img fs-6">
                {{-- <img src="/panel/src/assets/images/logos/dark-logo.svg" width="180" alt="" /> --}}
                {{ __('Sarzamin Robots') }}
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
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">{{ __('global.dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">{{ __('global.users') }}</span>
                </li>
                @can('user_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.users.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.users_list') }}</span>
                        </a>
                    </li>
                @endcan
                @can('user_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.users.trash') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user-off"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.deleted_users_list') }}</span>
                        </a>
                    </li>
                @endcan
                @can('post_index')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">{{ __('global.posts') }}</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.categories.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-category"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.categories') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.posts.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-notes"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.posts') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.pages.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-note"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.pages') }}</span>
                        </a>
                    </li>
                @endcan
                <li class="nav-small-cap">
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
                @endcan
                @can('permission_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.roles.permissions') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-alert-octagon"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.permissions') }}</span>
                        </a>
                    </li>
                @endcan
                @can('group_layout_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.group-layouts.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-apps"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.group_layouts') }}</span>
                        </a>
                    </li>
                @endcan
                {{-- @can('layout_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.layouts.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-slideshow"></i>
                                <!-- ti-app-window ti-apps ti-border-all -->
                            </span>
                            <span class="hide-menu">{{ __('global.layouts') }}</span>
                        </a>
                    </li>
                @endcan --}}
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.users.password') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-key"></i>
                        </span>
                        <span class="hide-menu">{{ __('global.password') }}</span>
                    </a>
                </li>


                {{-- <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('profile.edit') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">ویرایش اطلاعات</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/ui-buttons.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">مشاهده برنامه کلاسی</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-alert-circle"></i>
                        </span>
                        <span class="hide-menu">مشاهده وضعیت شهریه</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-cards"></i>
                        </span>
                        <span class="hide-menu">مشاهده کارنامه</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu"> درخواست های من</span>
                    </a>
                </li> --}}
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">{{ __('global.default_language') }}</span>
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
