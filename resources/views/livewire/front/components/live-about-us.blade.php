<!-- ======= About Us Section ======= -->
<section id="about" class="about">
    @if ($layoutGroup)
        <div class="container" data-aos="fade-up">
            <div class="section-header">
            <h2>{{ $layoutGroup->title }}</h2>
            <div>{!! $layoutGroup->description !!}</div>
            </div>

            <div class="row gy-4">
                @foreach ($layouts as $layout)
                    <div class="col-lg-12">
                        <div class="{{ $loop->last ? "content ps-0 ps-lg-5" : "" }} description">
                            {!! $layout->description ?: "" !!}
                            {{-- @if ($loop->last)
                                <div class="position-relative mt-4">
                                    <img src="{{ $layout->getFirstMediaUrl('mainImage') ?: "/Impact/assets/img/about-2.jpg" }}" class="img-fluid rounded-4" alt="">
                                    <a href="{{ $layout->link ?: "#" }}" class="glightbox play-btn"></a>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section><!-- End About Us Section -->