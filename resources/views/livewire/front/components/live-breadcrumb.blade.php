<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
    <div class="page-header d-flex align-items-center" style="background-image: url({{ $background ?: "" }});">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center mt-5">
            <h2 class="mt-5">{{ $title ?? "" }}</h2>
            <p>{!! $subTitle ?? "" !!}</p>
          </div>
        </div>
      </div>
    </div>
    <nav>
      <div class="container">
        <ol>
            @foreach ($items as $item)
                @if (isset($item['route']))
                    <li><a href="{{ $item['route'] ?? "#" }}">{{ $item['title'] ?? "" }}</a></li>
                @else
                    <li>{{ $item['title'] ?? "" }}</li>
                @endif
            @endforeach
        </ol>
      </div>
    </nav>
</div><!-- End Breadcrumbs -->