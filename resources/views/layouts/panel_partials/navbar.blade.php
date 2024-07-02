<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                    <i class="ti ti-bell-ringing"></i>
                    <div class="notification bg-primary rounded-circle"></div>
                </a>
            </li> --}}
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row {{ app()->getLocale() === 'en' ? "ms-auto" : "" }} align-items-center justify-content-end">
                <livewire:dashboard.components.live-notification />
                
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth()->user()?->getFirstMediaUrl('avatar') ?: "/panel/src/assets/images/profile/user-1.jpg" }}" alt="" width="35"
                            height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu {{ app()->getLocale() === 'en' ? "dropdown-menu-end" : "" }} dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            {{--<a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3"></p>
                            </a>
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-mail fs-6"></i>
                                <p class="mb-0 fs-3">My Account</p>
                                </a>
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-list-check fs-6"></i>
                                <p class="mb-0 fs-3">My Task</p>
                                </a> --}}
                            <livewire:admin.auth.live-logout />
                        </div>
                    </div>
                </li>
                
            </ul>
        </div>
    </nav>
</header>

{{-- <header class="">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                    href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                    <i class="ti ti-bell-ringing"></i>
                    <div class="notification bg-primary rounded-circle"></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="{{ route('profile.edit') }}">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">ویرایش اطلاعات</span>
                </a>
            </li>

        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                        aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="javascript:void(0)"
                                class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>
                            <a href="javascript:void(0)"
                                class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-mail fs-6"></i>
                                <p class="mb-0 fs-3">My Account</p>
                            </a>
                            <a href="javascript:void(0)"
                                class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-list-check fs-6"></i>
                                <p class="mb-0 fs-3">My Task</p>
                            </a>
                            <a href="./authentication-login.html"
                                class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="m-auto navbar navbar-dark navbar-expand-lg p-0 w-auto my-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">مدیریت ادمین</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse justify-content-center navbar-collapse" id="navbarNav">
                <ul class="bg-ac-info border d-flex justify-content-between m-0 navbar-nav p-0" dir="rtl">
                    <li class="nav-item border-end">
                        <a class="nav-link nav-icon-hover" href="{{ route('profile.edit') }}">
                            <span>
                                <i class="ti ti-pencil"></i>
                            </span>
                            <span class="hide-menu text-white">ویرایش اطلاعات</span>
                        </a>
                    </li>
                    <li class="nav-item border-end">
                        <a class="nav-link nav-icon-hover" href="{{ route('profile.courses.select') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-calendar-time"></i>
                            </span>
                            <span class="hide-menu text-white">مشاهده برنامه کلاسی</span>
                        </a>
                    </li>
                    @if(auth()->user()->userInfo?->type == "student")
                        <li class="nav-item border-end">
                            <a class="nav-link nav-icon-hover" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cash"></i>
                                </span>
                                <span class="hide-menu text-white">مشاهده وضعیت شهریه</span>
                            </a>
                        </li>
                        <li class="nav-item border-end">
                            <a class="nav-link nav-icon-hover" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-notes"></i>
                                </span>
                                <span class="hide-menu text-white">مشاهده کارنامه</span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->userInfo?->type == "staff")
                        <li class="nav-item border-end">
                            <a class="nav-link nav-icon-hover" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cash"></i>
                                </span>
                                <span class="hide-menu text-white">مشاهده فیش حقوقی</span>
                            </a>
                        </li>
                        <li class="nav-item border-end">
                            <a class="nav-link nav-icon-hover" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-notes"></i>
                                </span>
                                <span class="hide-menu text-white">بارگذاری کارنامه</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link nav-icon-hover border-end border-start" href="#" aria-expanded="false">
                            <span>
                                <i class="ti ti-file-description"></i>
                            </span>
                            <span class="hide-menu text-white"> درخواست های من</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <livewire:auth.live-logout />
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header> --}}
