<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/favicon/favicon-32x32.png') }}/favicon/?v=0.1.0">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/favicon/favicon-16x16.png') }}">
        <link rel="mask-icon" href="{{ Vite::asset('resources/favicon/apple-touch-icon.png') }}/favicon/safari-pinned-tab.svg?v=0.1.0" color="{{ config('app.theme_color') }}">
        <link rel="shortcut icon" href="{{ Vite::asset('resources/favicon/favicon.ico') }}">
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
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
