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
    <h1>Марка [{{ $manufacturer->manuName }}] / Модель [{{ $modelSeries->modelname }}] / Транспортное средство [{{ $vehicle->carName }}]</h1>
    <a href="{{ route('frontend.garage.vehicle.add', [$manufacturer->manuId, $modelSeries->modelId, $vehicle->carId]) }}" role="button" class="btn btn-info w-100 my-2">Добавить в список автомобилей</a>
</div>

<script src="{{ asset('js/core.js') }}"></script>
</body>
</html>
