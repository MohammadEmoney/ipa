<nav class="navbar navbar-light bg-light navbar-expand-xl">
    <a href="{{ route('home') }}" class="navbar-brand ms-3">
        {{-- <h1 class="text-primary display-5">Environs</h1> --}}
        <img src="{{ $logo }}" alt="" class="img-fluid" style="width: 10em;">
        {{-- <img src="{{ asset('Impact/assets/img/ipa_logo.png') }}" alt="" class="img-fluid" style="width: 10em;"> --}}
    </a>
    <button class="navbar-toggler py-2 px-3 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars text-primary"></span>
    </button>
    <div class="collapse navbar-collapse bg-light" id="navbarCollapse">
        <div class="navbar-nav ms-auto">
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
                <livewire:auth.live-logout />
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