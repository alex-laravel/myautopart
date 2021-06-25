<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link href="{{ asset('/css/backend.css') }}" rel="stylesheet">
    @yield('styles')
</head>
    <body class="c-app">
        @include('backend.include.sidebar')
        <div class="c-wrapper">
            @include('backend.include.header')

            <div class="c-body">
                <main class="c-main">
                    @yield('content')
                </main>
                @include('backend.include.footer')
            </div>
        </div>

        <script src="{{ asset('/js/backend.js') }}"></script>
        @yield('scripts')
    </body>
</html>
