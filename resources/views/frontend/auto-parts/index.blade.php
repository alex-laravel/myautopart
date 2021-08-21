@extends('frontend.layout.main')

@section('title', 'Запчасти для транспортного средства')

@section('content')
    <div class="container">
        <h1>Запчасти для транспортного средства: Марка [{{ $manufacturer->manuName }}] / Модель [{{ $modelSeries->modelname }}] / Транспортное средство [{{ $vehicle->carName }}]</h1>

    </div>
@endsection
