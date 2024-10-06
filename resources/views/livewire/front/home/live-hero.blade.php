<div class="container-fluid carousel-header vh-100 px-0" dir="ltr" style="margin-top: {{ count($languages) > 1 ? "6rem" : "4rem" }}">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($sliders as $key => $slider)
                <li data-bs-target="#carouselId" data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? "active" : "" }}"></li>
            @endforeach
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
                        @if ($slider->link && $slider->button_title)
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="{{ $slider->link ?: "#about" }}">{{ $slider->button_title }}</a>
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