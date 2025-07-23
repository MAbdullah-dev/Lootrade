<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('assets/js/jqery_min.js') }}"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>

<body>
    @include('partials.gtm')
    @stack('body-start')

    <main>
        {{ $slot }}
    </main>
    <livewire:inc.footer />
    @livewireScripts
    @stack('js')
    <script>
        document.addEventListener('livewire:navigated', () => {
            console.log("✅ livewire:navigated triggered");
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: "page_view",
                page_path: window.location.pathname,
                page_location: window.location.href,
                page_title: document.title
            });
            console.log("✅ GTM page_view pushed to dataLayer");
        });
    </script>


</body>

</html>
