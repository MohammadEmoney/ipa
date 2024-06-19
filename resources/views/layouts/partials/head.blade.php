<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title', $title ?? env('APP_NAME'))</title>
    <link rel="shortcut icon" type="image/png" href="/panel/src/assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @if (App::isLocale('en'))
        <link rel="stylesheet" href="/panel/src/assets/css/styles-en.min.css" />
    @else
        <link rel="stylesheet" href="/panel/src/assets/css/styles.min.css" />
        <link rel="stylesheet" href="/panel/src/assets/css/custom.css" />
    @endif
    <link rel="stylesheet" href="/panel/src/assets/libs/select2/select2.min.css" />
    {{-- <link rel="stylesheet" href="/panel/src/assets/css/bootstrap.rtl.css" /> --}}
    <link href="/general/flag-icons/css/flag-icons.min.css" rel="stylesheet">
    
    @livewireStyles
    @stack('styles')
</head>
