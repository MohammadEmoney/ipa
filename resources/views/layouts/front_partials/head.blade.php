<head>
    <meta charset="utf-8">
    <title>@yield('title', env('APP_NAME'))</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

     <!-- Favicons -->
    <link href="{{ $favicon ?: "/general/img/favicon-16x16.png" }}" rel="icon">
    <link href="{{ $favicon ?: "/general/img/favicon-16x16.png" }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    @if (App::isLocale('en'))
        <link href="/Impact/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    @else
        <link href="/Impact/assets/vendor/bootstrap/css/bootstrap.rtl.min.css" rel="stylesheet">
    @endif
    
    {{-- <link href="/Impact/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> --}}
    <link href="/Impact/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/Impact/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/Impact/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    @if (App::isLocale('en'))
        <link href="/Impact/assets/css/main.css" rel="stylesheet">
    @else
        <link href="/Impact/assets/css/main-rtl.css" rel="stylesheet">
    @endif
    
    <link href="/general/flag-icons/css/flag-icons.min.css" rel="stylesheet">

    

    <!-- =======================================================
    * Template Name: Impact
    * Updated: Mar 10 2023 with Bootstrap v5.2.3
    * Template URL: https://bootstrapmade.com/Impact-bootstrap-business-website-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    @livewireStyles
    @stack('styles')
</head>
