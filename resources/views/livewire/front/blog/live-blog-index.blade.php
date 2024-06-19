<div>
    <livewire:front.components.live-breadcrumb :title="__('global.news')" :items="[['title' => __('global.home'), 'route' => route('home')], ['title' => __('global.news')]]" />
  
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
  
          <div class="row gy-4 posts-list">
            @forelse ($posts as $post)
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
                    {{-- <img src="assets/img/blog/blog-author.jpg" alt="" class="img-fluid post-author-img flex-shrink-0"> --}}
                    <div class="post-meta">
                      <p class="post-author-list">{{ $post->createdBy?->full_name }}</p>
                      <p class="post-date">
                        <time datetime="2022-01-01">{{ $post->updated_at }}</time>
                      </p>
                    </div>
                  </div>
    
                </article>
              </div><!-- End post list item -->
            @empty
              <div class="text-center">
                <i class="bi bi-exclamation-triangle fs-2 text-info"></i>
              </div>
              <div class="text-center">{{ __('global.nothings_found') }}</div>
            @endforelse
          </div><!-- End blog posts list -->
  
          <div class="blog-pagination">
              {{ $posts->links("pagination::bootstrap-5") }}
          </div><!-- End blog pagination -->
  
        </div>
    </section><!-- End Blog Section -->
</div>
