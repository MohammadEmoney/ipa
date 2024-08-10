<!-- ======= Call To Action Section ======= -->
<section id="call-to-action" class="call-to-action">
    @if ($layout)
        <div class="container text-center" 
            data-aos="zoom-out"
            style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ $layout->getFirstMediaUrl('mainImage') ?: "/Impact/assets/img/cta-bg.jpg" }}') center center;">
            <a href="{{ $layout->data['video_link'] ?? "#" }}" class="glightbox play-btn"></a>
            <h3>{{ $layoutGroup->title }}</h3>
            <div>{!! $layout->description !!}</div>
            <a class="cta-btn" href="{{ $layout->link }}">{{ $layout->data['btn_title'] ?? __('global.call_to_action') }}</a>
        </div>
    @endif
</section><!-- End Call To Action Section -->