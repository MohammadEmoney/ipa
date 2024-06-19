<!-- ======= Our Services Section ======= -->
<section id="services" class="services sections-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
        <h2>{{ $data['title'] }}</h2>
        <p>{{ $data['sub_title'] }}</p>
        </div>

        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
            @foreach ($data['items'] as $item)
                {!! $item !!}
            @endforeach
        </div>

    </div>
</section><!-- End Our Services Section -->