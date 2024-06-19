<div class="col-lg-4">
  
    <div class="sidebar">

        <div class="sidebar-item search-form" x-data="{isTyped: false}">
            <h3 class="sidebar-title">{{ __('global.search') }}</h3>
            <form wire:submit.prevent="submitSearch" class="mt-3">
                <input type="text" wire:model.live="search" placeholder="{{ __('global.search') }}" 
                x-on:input.debounce.400ms="isTyped = ($event.target.value.length > 3)"
                autocomplete="off">
                <button type="submit"><i class="bi bi-search"></i></button>
            </form>
            <div x-show="isTyped" x-cloak>
                <div>
                      <div>
                          @forelse($searchResult as $article)
                              <div>
                                  <ul>
                                      <li>
                                          <a href="{{route('front.blog.show', ['post' => $article->slug])}}">
                                              {{Str::limit($article->title, 40)}}
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                          @empty
                              <div x-cloak>
                                  {{ __('nothings_found') }}
                              </div>
                          @endforelse
                      </div>
                </div>
          </div>
        </div><!-- End sidebar search formn-->

      <div class="sidebar-item categories">
        <h3 class="sidebar-title">{{ __('global.categories') }}</h3>
        <ul class="mt-3">
            @foreach ($categories as $category)
                <li><a href="{{ route('front.categories.show', ['category' => $category->slug]) }}">{{ $category->title }} <span>({{ $category->posts_count }})</span></a></li>
            @endforeach
        </ul>
      </div><!-- End sidebar categories-->

      <div class="sidebar-item recent-posts">
        <h3 class="sidebar-title">{{ __('global.recent_news') }}</h3>

        <div class="mt-3">
            @foreach ($recentPosts as $post)
                <div class="post-item mt-3">
                <img src="{{ $post->getFirstMediaUrl('mainImage') }}" alt="{{ $post->title }}">
                <div>
                    <h4><a href="{{ route('front.blog.show', ['post' => $post->slug]) }}">{{ $post->title }}</a></h4>
                    <time datetime="2020-01-01">{{ $post->created_at }}</time>
                </div>
                </div><!-- End recent post item-->
            @endforeach
        </div>

      </div><!-- End sidebar recent posts-->

      {{-- <div class="sidebar-item tags">
        <h3 class="sidebar-title">Tags</h3>
        <ul class="mt-3">
          <li><a href="#">App</a></li>
          <li><a href="#">IT</a></li>
          <li><a href="#">Business</a></li>
          <li><a href="#">Mac</a></li>
          <li><a href="#">Design</a></li>
          <li><a href="#">Office</a></li>
          <li><a href="#">Creative</a></li>
          <li><a href="#">Studio</a></li>
          <li><a href="#">Smart</a></li>
          <li><a href="#">Tips</a></li>
          <li><a href="#">Marketing</a></li>
        </ul>
      </div><!-- End sidebar tags--> --}}

    </div><!-- End Blog Sidebar -->

  </div>