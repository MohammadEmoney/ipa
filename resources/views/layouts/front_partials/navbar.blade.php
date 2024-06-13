<!-- Navbar start -->
<div class="container-fluid fixed-top px-0">
    <div class="container px-0">
        <div class="topbar">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8">
                    <div class="topbar-info d-flex flex-wrap">
                        <a href="#" class="text-light me-4"><i class="fas fa-envelope text-white me-2"></i>{{ $settings['email'] ?? "Example@gmail.com" }}</a>
                        <a href="#" class="text-light"><i class="fas fa-phone-alt text-white me-2"></i>{{ $settings['phone'] ?? "+01234567890" }}</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="topbar-icon d-flex align-items-center justify-content-end">
                        <a href="{{ \App\Generators\CustomUrlGenerator::localeRoute('en') }}" class="btn-square text-white me-2"><span class="fi fi-gb"></span></a>
                        <a href="{{ \App\Generators\CustomUrlGenerator::localeRoute('ar') }}" class="btn-square text-white me-2"><span class="fi fi-sa"></span></a>
                        <a href="{{ \App\Generators\CustomUrlGenerator::localeRoute('fa') }}" class="btn-square text-white me-2"><span class="fi fi-ir"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-light bg-light navbar-expand-xl">
            <a href="index.html" class="navbar-brand ms-3">
                {{-- <h1 class="text-primary display-5">Environs</h1> --}}
                <img src="{{ asset('Impact/assets/img/logo.png') }}" alt="" class="img-fluid">
            </a>
            <button class="navbar-toggler py-2 px-3 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-light" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="#" class="nav-item nav-link active">{{ __('global.home') }}</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="service.html" class="nav-item nav-link">Services</a>
                    <a href="causes.html" class="nav-item nav-link">Causes</a>
                    <a href="events.html" class="nav-item nav-link">Events</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="blog.html" class="dropdown-item">Blog</a>
                            <a href="gallery.html" class="dropdown-item">Gallery</a>
                            <a href="volunteer.html" class="dropdown-item">Volunteers</a>
                            <a href="donation.html" class="dropdown-item">Donation</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                </div>
                {{-- <div class="d-flex align-items-center flex-nowrap pt-xl-0" style="margin-left: 15px;">
                    <a href="" class="btn-hover-bg btn btn-primary text-white py-2 px-4 me-3">Donate Now</a>
                </div> --}}
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->