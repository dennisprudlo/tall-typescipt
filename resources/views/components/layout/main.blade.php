@php
    $title          = trans('app.name', '');
    $description    = trans('app.description')
    $keywords       = trans('app.keywords', '');
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport"       content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
        <meta name="keywords"       content="@yield('keywords', $keywords)">
        <meta name="description"    content="@yield('description', $description)">
        <meta name="copyright"      content="Copyright &copy; {{ now()->year }} {{ $title }}">
        <meta name="language"       content="{{ app()->getLocale() }}">
        <meta name="robots"         content="none">

        @hasSection('title')
            <title>@yield('title', $title) | {{ $title }}</title>
        @else
            <title>{{ $title }} | {{ $description }}</title>
        @endif

        {{-- Include the site webmanifest --}}
        <link rel="manifest" href="{{ asset('site.webmanifest') }}" />

        <meta name="mobile-web-app-capable"                 content="yes">
        <meta name="apple-mobile-web-app-capable"           content="yes" />
        <meta name="apple-mobile-web-app-title"             content="{{ $title }}">
        <meta name="application-name"                       content="{{ $title }}">
        <meta name="apple-mobile-web-app-status-bar-style"  content="default" />

        {{-- Include main styles --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        {{-- Custom head --}}
        @yield('head')

        {{-- Include Livewire styles --}}
        <livewire:styles />

        {{-- Custom styles --}}
        @stack('styles')
    </head>
    <body>

        {{-- Main application container --}}
        <main id="app">
           {{ $slot }}
        </main>

        {{-- Include Livewire scripts --}}
        <livewire:scripts />
        <livewire:modal-container />

        {{-- Include main scripts --}}
        <script src="{{ mix('js/app.js') }}" charset="utf-8"></script>

        {{-- Custom scripts --}}
        @stack('scripts')
    </body>
</html>
