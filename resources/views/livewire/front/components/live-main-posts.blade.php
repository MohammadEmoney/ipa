<div class="container" data-aos="fade-up">
    @foreach ($layouts as $layout)
    <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-md-12">
            <div class="card mb-3 border-0">
                <div class="row g-0 {{ $loop->odd ? "" : "flex-row-reverse" }}">
                    <div class="col-md-6">
                        <img src="{{ $layout->articles?->getFirstMediaUrl('mainImage') }}" class="img-fluid rounded-{{ $loop->odd ? "start" : "end" }}" alt="{{ $layout->articles?->title }}">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{ $layout->articles?->title }}</h5>
                            <p class="card-text">{{ $layout->articles?->summary }}</p>
                            <a href="{{ route('front.blog.show', ['post' => $layout->articles?->slug]) }}" class="btn btn-primary">{{ __('global.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{-- <div class="row">
        <div class="col-md-6 centered order-md-2">
            <img src="image.jpg" class="img-fluid" alt="Full Image">
        </div>
        <div class="col-md-6 centered order-md-1">
            <div>
            <h2>Title</h2>
            <a href="#" class="btn btn-primary">Read More</a>
            </div>
        </div>
        </div> --}}
    
        {{-- <div class="row my-2">
            <div class="col-md-6">
                <img src="{{ $post->getFirstMediaUrl('mainImage') }}" alt="{{ $post->title }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2>{{ $post->title }}</h2>
                <a href="" class="btn btn-primary">{{ __('global.read_more') }}</a>
            </div>
        </div> --}}
    @endforeach
</div>