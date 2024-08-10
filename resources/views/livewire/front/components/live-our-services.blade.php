<!-- ======= Our Services Section ======= -->
<section id="services" class="services sections-bg">
    @if ($layoutGroup)
        <div class="container" data-aos="fade-up">
            <div class="section-header">
            <h2>{{ $layoutGroup->title }}</h2>
            <p>{!! $layoutGroup->description !!}</p>
            </div>

            <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
                @foreach ($layouts as $layout)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item  position-relative">
                            <div class="icon">
                                <i class="{{ $layout->icon }}"></i>
                            </div>
                            <h3>{{ $layout->title }}</h3>
                            <p>{!! $layout->description !!}</p>
                            <a href="{{ $layout->link }}" class="readmore stretched-link">{{ __('global.read_more') }} <i class="bi bi-arrow-{{ App::isLocale('en') ? "right" : "left" }}"></i></a>
                        </div>
                    </div><!-- End Service Item -->
                @endforeach
            </div>

        </div>
    @endif
</section><!-- End Our Services Section -->