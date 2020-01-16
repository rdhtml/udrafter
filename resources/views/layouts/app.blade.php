<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    @include('layouts.head')

</head>
<body>
    <div id="app">

        @include('layouts.header')

        <main class="py-4">
            @yield('content')
        </main>

        @include('layouts.footer')

    </div>

    @include('layouts.scripts')

    @yield('script')
</body>
</html>
