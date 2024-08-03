<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <span>{{ $settings['title'] ?? "IPA" }}</span>
          </a>
          <p>{!! $settings['about_us'] ?? "" !!}</p>
          <div class="social-links d-flex mt-4">
            @foreach ($socialMedia as $item)
              <a href="{{ $item->link }}" class="twitter"><i class="{{ $item->icon }}"></i></a>
            @endforeach
            {{-- <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> --}}
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>{{ __('global.useful_links') }}</h4>
          <ul>
            @foreach ($menu as $item)
                <li><a href="{{ $item->link }}">{{ $item->title }}</a></li>
            @endforeach
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>{{ __('global.recent_news') }}</h4>
          <ul>
            @foreach ($posts as $post)
                <li><a href="{{ route('front.blog.show', ['post' => $post->slug]) }}">{{ $post->title }}</a></li>
            @endforeach
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>{{ __('global.contact_us') }}</h4>
          <p>
            {!! $settings['address'] !!}
            <br>
            <strong>{{ __('global.phone_number') }}:</strong> {{ $settings['phone'] ?? "" }}<br>
            <strong>{{ __('global.email') }}:</strong> {{ $settings['email'] ?? ""}}<br>
          </p>
          <div>
            <a referrerpolicy='origin' target='_blank' href='https://trustseal.enamad.ir/?id=509818&Code=IQw8viVvgnMLPt7vPXGpHaVMJxHc23HT'><img referrerpolicy='origin' src='https://trustseal.enamad.ir/logo.aspx?id=509818&Code=IQw8viVvgnMLPt7vPXGpHaVMJxHc23HT' alt='' style='cursor:pointer' code='IQw8viVvgnMLPt7vPXGpHaVMJxHc23HT'></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>{{ env('APP_NAME')  }}</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Designed by <a href="https://emcode.ir/">Emcode</a> -->
      </div>
    </div>

</footer><!-- End Footer -->
 