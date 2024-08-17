{{-- <div class="container-fluid carousel-header vh-100 px-0" dir="ltr">
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
                      <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">WE'll Save Our Planet</h4>
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
                      <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">WE'll Save Our Planet</h4>
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
                      <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">WE'll Save Our Planet</h4>
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
</div> --}}

<!-- Carousel Start -->
<div class="container-fluid carousel-header vh-100 px-0" dir="ltr" style="margin-top: 6rem">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          @foreach ($sliders as $key => $slider)
            <div class="carousel-item {{ $loop->first ? "active" : "" }}">
                <img src="{{ $slider->getFirstMediaUrl('mainImage') ?: "/Impact/assets/img/carousel-1.jpg" }}" class="img-fluid" alt="{{ $slider->title ?: env('APP_NAME') }}">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        @if ($slider->title)
                            <h1 class="fs-1 display-1 text-capitalize text-white mb-4">{{ $slider->title }}</h1>
                        @endif
                        @if ($slider->description)
                            <p class="mb-5 fs-5">{!! $slider->description !!}</p>
                        @endif
                        @if ($slider->link)
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="{{ $slider->link ?: "#about" }}">{{ __('global.about_us') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
          @endforeach
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