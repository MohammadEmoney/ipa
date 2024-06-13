<!doctype html>
<html lang="en">

@include('layouts.partials.head')
<body dir="{{ App::isLocale('en') ? "ltr" : "rtl"}}">
    <!--  Body Wrapper -->
    @yield('content')
    @include('layouts.partials.script')
</body>

</html>
