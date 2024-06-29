<!doctype html>
<html lang="en">

@include('layouts.panel_partials.head')

<body dir="{{ app()->getLocale() === "en" ? "ltr" : "rtl" }}">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.panel_partials.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper" dir="{{ App::isLocale('en') ? "ltr" : "rtl"}}">
            @include('layouts.panel_partials.navbar')
            <!--  Header Start -->
            <!--  Header End -->
            @yield('content')
        </div>
    </div>
@include('layouts.panel_partials.script')
</body>

</html>
