<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {!! \App\Meta::render() !!}

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="{{ asset('css/fonts/poppins.css') }}" rel="stylesheet">
        <!--<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />-->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('settings.theme_ga_code') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ config('settings.theme_ga_code') }}');
        </script>

        <!-- Scripts -->
        @include('cookie-consent::index')
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    @if (\Session::has('error'))
        <div class="bg-rose-100 text-rose-600 text-center m-auto p-2">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
            </ul>
        </div>
    @elseif(\Session::has('success'))
        <div class="bg-green-100 text-green-600 text-center m-auto p-2">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
