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
    <h1>Марка [{{ $manufacturer->manuName }}] / Модель [{{ $modelSeries->modelname }}]</h1>

    <h2>Обзор по транспортному средству</h2>

    <div class="row">
        @foreach ($vehicles as $vehicle)
            <div class="col-xl-3 col-lg-4 col-md-6 col-12 card-brand">
                <a href="/auto/{{ $manufacturer->manuId }}/{{ $modelSeries->modelId }}/{{ $vehicle->carId }}" class="d-block">
                    <p>{{ $vehicle->carName }}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>

<script src="{{ asset('js/core.js') }}"></script>
</body>
</html>
