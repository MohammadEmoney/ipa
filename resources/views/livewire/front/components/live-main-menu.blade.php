<nav class="navbar navbar-light bg-light navbar-expand-xl">
    <a href="{{ route('home') }}" class="navbar-brand ms-3">
        {{-- <h1 class="text-primary display-5">Environs</h1> --}}
        <img src="{{ $logo }}" alt="" class="img-fluid" style="width: 8em;">
        {{-- <img src="{{ asset('Impact/assets/img/ipa_logo.png') }}" alt="" class="img-fluid" style="width: 10em;"> --}}
    </a>
    <button class="navbar-toggler py-2 px-3 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars text-primary"></span>
    </button>
    <div class="collapse navbar-collapse bg-light" id="navbarCollapse">
        <div class="navbar-nav ms-auto me-5">
            @foreach ($menu as $item)
                @if($item->children()->count())
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ $item->title }}</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            @foreach ($item->children as $child)
                                <a href="{{ $item->link }}" class="dropdown-item">{{ $child->title }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $item->link }}" class="nav-item nav-link {{  request()->is(preg_replace('/^./', '', $item->link)) ? 'active' : '' }}">{{ $item->title }}</a>
                @endif
            @endforeach
            @auth
                <ul class="navbar-nav mb-2 mb-lg-0 profile-menu"> 
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dashboard" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">
                            <i class="fas fa-home fa-fw"></i> <span class="text-black">{{ __('global.dashboard') }}</span></a>
                        </li>
                        {{-- <li><a class="dropdown-item" href="#"><i class="fas fa-cog fa-fw"></i> Settings</a></li> --}}
                        {{-- <li><hr class="dropdown-divider"></li> --}}
                        {{-- <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a></li> --}}
                        <li>
                            <livewire:auth.live-logout />
                        </li>
                    </ul>
                    </li>
                </ul>
                
            @endauth

            @guest
                <a href="{{ route('login') }}" class="nav-item nav-link {{  (request()->is('*/login') || request()->is('*/register')) ? 'active' : '' }}">{{ __('global.register') }}</a>
            @endguest
        </div>
        {{-- <div class="d-flex align-items-center flex-nowrap pt-xl-0" style="margin-left: 15px;">
            <a href="" class="btn-hover-bg btn btn-primary text-white py-2 px-4 me-3">Donate Now</a>
        </div> --}}
    </div>
</nav>