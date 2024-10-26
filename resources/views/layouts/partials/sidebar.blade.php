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
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">{{ __('global.dashboard') }}</span>
                    </a>
                </li>
                @can('user_index')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">{{ __('global.users') }}</span>
                    </li>
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
                @can('member_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.members.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user-circle"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.member_list') }}</span>
                        </a>
                    </li>
                @endcan
                @can('post_index')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">{{ __('global.posts') }}</span>
                    </li>
                @endcan
                @can('category_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.categories.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-category"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.categories') }}</span>
                        </a>
                    </li>
                @endcan
                @can('post_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.posts.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.posts') }}</span>
                        </a>
                    </li>
                @endcan
                @can('page_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.pages.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-note"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.pages') }}</span>
                        </a>
                    </li>
                @endcan
                @can('document_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.documents.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-notes"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.documents') }}</span>
                        </a>
                    </li>
                @endcan
                @can('circular_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.circulars.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-license"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.circulars') }}</span>
                        </a>
                    </li>
                @endcan
                @can('critic_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.critics.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-message-dots"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.critics') }}</span>
                        </a>
                    </li>
                @endcan
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">{{ __('global.financials') }}</span>
                </li>
                @can('order_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.orders.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-shopping-cart"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.orders') }}</span>
                        </a>
                    </li>
                @endcan
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">{{ __('global.notifications') }}</span>
                </li>
                @can('order_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.notifications.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-bell-ringing-2"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.send_notification') }}</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.notifications.premade') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-bell-plus"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.premade_notifications') }}</span>
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
                @can('airline_index')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.airlines.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-plane-tilt"></i>
                            </span>
                            <span class="hide-menu">{{ __('global.airlines') }}</span>
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
