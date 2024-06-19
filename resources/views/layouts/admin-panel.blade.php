<!doctype html>
<html lang="en">

@include('layouts.partials.head')

<body dir="{{ app()->getLocale() === "en" ? "ltr" : "rtl" }}">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.partials.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper" dir="{{ App::isLocale('en') ? "ltr" : "rtl"}}">
            @include('layouts.partials.admin-nav')
            <!--  Header Start -->
            <!--  Header End -->
            @yield('content')
        </div>
    </div>
@include('layouts.partials.script')
</body>

</html>
