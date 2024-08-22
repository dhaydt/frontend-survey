<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('frontend.layouts.partials._head')
    @livewireStyles()
    @stack('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
</head>

<body>
    {{-- @include('frontend.layouts.partials._navbar') --}}
    <main>
        <div class="container py-4 pt-0 bg-light px-0">
            @yield('content')
        </div>
    </main>

    @include('frontend.layouts.partials._foot')
    @livewireScripts()
    @stack('js')
</body>

</html>
