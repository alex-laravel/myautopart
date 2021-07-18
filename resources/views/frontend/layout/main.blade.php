<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ config('app.name') }} | @yield('title')</title>
        <link href="{{ mix('/css/frontend.css') }}" rel="stylesheet">
        @yield('styles')
        <script src="{{ mix('/js/frontend.js') }}"></script>
        @yield('scripts')
    </head>
    <body>
        @include('frontend.include.header')

        <main class="py-4">
            @include('frontend.include.messages')
            @yield('content')
        </main>
    </body>
</html>
