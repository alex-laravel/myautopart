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
    <h1>Марка [{{ $manufacturer->manuName }}]</h1>

    <h2>Обзор по Модели</h2>

    <div class="row">
        @foreach ($modelSeries as $model)
            <div class="col-xl-3 col-lg-4 col-md-6 col-12 card-brand">
                <a href="/auto/{{ $manufacturer->manuId }}/{{ $model->modelId }}" class="d-block">
                    <p>
                        {{ $model->modelname }}
                        <small>{{ $model->yearOfConstrFrom ? $model->yearOfConstrFrom : 'N/A' }} - {{ $model->yearOfConstrTo ? $model->yearOfConstrTo : 'N/A' }}</small>
                    </p>
                </a>
            </div>
        @endforeach
    </div>
</div>

<script src="{{ asset('js/core.js') }}"></script>
</body>
</html>
