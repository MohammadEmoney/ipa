<!-- ======= About Us Section ======= -->
<section id="about" class="about">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
        <h2>{{ $data['title'] }}</h2>
        <p>{{ $data['sub_title'] }}</p>
        </div>

        <div class="row gy-4">
            <div class="col-lg-6">
                {!! $data['first_content'] !!}
            </div>
            <div class="col-lg-6">
                <div class="content ps-0 ps-lg-5">
                    {!! $data['second_content'] !!}
                </div>
            </div>
        </div>
    </div>
</section><!-- End About Us Section -->