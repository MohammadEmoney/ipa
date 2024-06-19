<!-- ======= Recent Blog Posts Section ======= -->
<section id="recent-posts" class="recent-posts sections-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
        <h2>{{ __('global.recent_news') }}</h2>
        {{-- <p>Consequatur libero assumenda est voluptatem est quidem illum et officia imilique qui vel architecto accusamus fugit aut qui distinctio</p> --}}
        </div>

        <div class="row gy-4">
            @foreach ($posts as $post)
                <div class="col-xl-4 col-md-6">
                    <article>
        
                        <div class="post-img">
                            <img src="{{ $post->getFirstMediaUrl('mainImage') }}" alt="{{ $post->title }}" class="img-fluid">
                        </div>
        
                        <p class="post-category">{{ $post->mainCategory?->first()?->title }}</p>
            
                        <h2 class="title">
                            <a href="{{ route('front.blog.show', ['post' => $post->slug]) }}">{{ $post->title }}</a>
                        </h2>
            
                        <div class="d-flex align-items-center">
                            {{-- <img src="/Impact/assets/img/blog/blog-author.jpg" alt="" class="img-fluid post-author-img flex-shrink-0"> --}}
                            <div class="post-meta">
                                <p class="post-author">{{ $post->createdBy?->full_name }}</p>
                                <p class="post-date">
                                    <time datetime="2022-01-01">{{ $post->updated_at }}</time>
                                </p>
                            </div>
                        </div>
        
                    </article>
                </div><!-- End post list item -->
            @endforeach

        </div><!-- End recent posts list -->

    </div>
</section><!-- End Recent Blog Posts Section -->