<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href={{ asset('css/frontend.css') }}>
    </head>
    <body>
        <div class="container">
            <div class="alert alert-success mt-5" role="alert">
                Bootstrap 5 detected!
            </div>
        </div>

        <script src="{{ asset('js/frontend.js') }}"></script>
    </body>
</html>
