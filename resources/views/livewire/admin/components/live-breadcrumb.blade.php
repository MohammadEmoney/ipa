<nav aria-label="breadcrumb" dir="{{ App::isLocale('fa') ? "rtl" : "ltr" }}">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('global.dashboard') }}</a></li>
        @foreach ($items as $item)
            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}"
                @if ($loop->last) aria-current="page" @endif>
                @if (isset($item['route']))
                    <a href="{{ $item['route'] }}">{{ $item['title'] }}</a>
                @else
                    {{ $item['title'] }}
                @endif
            </li>
        @endforeach
    </ol>
</nav>
