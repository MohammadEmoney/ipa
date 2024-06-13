<!DOCTYPE html>
<html lang="en">

@include('layouts.front_partials.head')

<body>
    @include('layouts.front_partials.navbar')
    @yield('content')
    @include('layouts.front_partials.footer')
    @include('layouts.front_partials.script')
</body>

</html>
