<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;800&family=Cormorant:ital,wght@1,700&display=swap" rel="stylesheet">

        <!-- Favicon -->
        <link rel="manifest" href="/site.webmanifest">
        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/favicon/favicon-16x16.png') }}">
        <link rel="shortcut icon" href="{{ Vite::asset('resources/favicon/favicon.ico') }}">
        <link rel="mask-icon" href="{{ Vite::asset('resources/favicon/safari-pinned-tab.svg') }}" color="{{ config('app.theme_color') }}">
        <meta name="msapplication-TileColor" content="{{ config('app.theme_color') }}">
        <meta name="theme-color" content="{{ config('app.theme_color') }}">

        @production
            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-T952524GJS"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'G-T952524GJS');
            </script>
        @endproduction

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
