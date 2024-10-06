<!-- Navbar start -->
<div class="container-fluid fixed-top px-0">
    <div class="container px-0">
        @if (count($languages) > 1)
            <div class="topbar">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-8">
                        <div class="topbar-info d-flex flex-wrap">
                            {{-- <a href="#" class="text-light me-4"><i class="fas fa-envelope text-white me-2"></i>{{ $settings['email'] ?? "Example@gmail.com" }}</a>
                            <a href="#" class="text-light"><i class="fas fa-phone-alt text-white me-2"></i>{{ $settings['phone'] ?? "+01234567890" }}</a> --}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="topbar-icon d-flex align-items-center justify-content-end">
                            
                                @foreach ($languages as $lang)
                                    <a href="{{ \App\Generators\CustomUrlGenerator::localeRoute($lang) }}" class="btn-square text-white mt-2 {{ $loop->last ? 'me-4' : 'me-2' }}">
                                        <span class="fi fi-{{ ($lang === 'en') ? 'gb' : (($lang === 'fa') ? 'ir' : (($lang === 'ar') ? 'sa' : 'gb')) }}"></span>
                                    </a>
                                @endforeach
                            {{-- <a href="{{ \App\Generators\CustomUrlGenerator::localeRoute('ar') }}" class="btn-square text-white mt-2 me-2"><span class="fi fi-sa"></span></a> --}}
                            {{-- <a href="{{ \App\Generators\CustomUrlGenerator::localeRoute('fa') }}" class="btn-square text-white mt-2 me-4"><span class="fi fi-ir"></span></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <livewire:front.components.live-main-menu />
    </div>
</div>
<!-- Navbar End -->