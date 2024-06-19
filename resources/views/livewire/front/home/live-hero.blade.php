{{-- <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2>Welcome to <span>Impact</span></h2>
          <p>Sed autem laudantium dolores. Voluptatem itaque ea consequatur eveniet. Eum quas beatae cumque eum quaerat.</p>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started">Get Started</a>
            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="/Impact/assets/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>

    <div class="icon-boxes position-relative">
      <div class="container position-relative">
        <div class="row gy-4 mt-5">

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-easel"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Lorem Ipsum</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-gem"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Sed ut perspiciatis</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-geo-alt"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Magni Dolores</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-command"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Nemo Enim</a></h4>
            </div>
          </div><!--End Icon Box -->

        </div>
      </div>
    </div>

    </div>
</section> --}}

<!-- Carousel Start -->
<div class="container-fluid carousel-header vh-100 px-0" dir="ltr">
  <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
      <ol class="carousel-indicators">
          <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
          <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
          <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
              <img src="/Impact/assets/img/carousel-1.jpg" class="img-fluid" alt="Image">
              <div class="carousel-caption">
                  <div class="p-3" style="max-width: 900px;">
                      {{-- <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">WE'll Save Our Planet</h4> --}}
                      <h1 class="fs-1 display-1 text-capitalize text-white mb-4">{{ __('messages.slider_title') }}</h1>
                      <p class="mb-5 fs-5">{{ __('messages.slider_sub_title') }}
                      </p>
                      <div class="d-flex align-items-center justify-content-center">
                          <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="#about">{{ __('global.about_us') }}</a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="carousel-item">
              <img src="/Impact/assets/img/carousel-2.jpg" class="img-fluid" alt="Image">
              <div class="carousel-caption">
                  <div class="p-3" style="max-width: 900px;">
                      {{-- <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">WE'll Save Our Planet</h4> --}}
                      <h1 class="fs-1 display-1 text-capitalize text-white mb-4">{{ __('messages.slider_title') }}</h1>
                      <p class="mb-5 fs-5">{{ __('messages.slider_sub_title') }}
                      </p>
                      <div class="d-flex align-items-center justify-content-center">
                          <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="#about">{{ __('global.about_us') }}</a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="carousel-item">
              <img src="/Impact/assets/img/carousel-3.jpg" class="img-fluid" alt="Image">
              <div class="carousel-caption">
                  <div class="p-3" style="max-width: 900px;">
                      {{-- <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">WE'll Save Our Planet</h4> --}}
                      <h1 class="fs-1 display-1 text-capitalize text-white mb-4">{{ __('messages.slider_title') }}</h1>
                      <p class="mb-5 fs-5">{{ __('messages.slider_sub_title') }}
                      </p>
                      <div class="d-flex align-items-center justify-content-center">
                          <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="#about">{{ __('global.about_us') }}</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
  </div>
</div>
<!-- Carousel End -->