@extends('frontend.layout.main')

@section('title', 'Frontend')

@section('content')
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-xl-3 col-lg-4 col-md-6 col-12 my-4">
                <strong class="d-block">Мои автомобили:</strong>

                @if (count($garageVehicles))
                    @foreach ($garageVehicles as $garageVehicle)
                        <div class="card my-2 p-2">
                            <div class="d-inline-block text-end pb-2">
                                @if($garageVehicle['selected'])
                                    <span class="badge bg-success" style="width: 24px">A</span>
                                @else
                                    <a href="{{ route('frontend.garage.vehicle.activate', [$garageVehicle['manufacturerId'], $garageVehicle['modelSeriesId'], $garageVehicle['vehicleId']]) }}" class="badge bg-secondary" style="width: 24px">A</a>
                                @endif

                                <a href="{{ route('frontend.garage.vehicle.delete', [$garageVehicle['manufacturerId'], $garageVehicle['modelSeriesId'], $garageVehicle['vehicleId']]) }}" class="badge bg-danger" style="width: 24px">D</a>
                            </div>

                            <small class="d-block">{{ $garageVehicle['manufacturerName'] }} {{ $garageVehicle['modelSeriesName'] }} {{ $garageVehicle['vehicleName'] }}</small>
                        </div>
                    @endforeach
                @else
                    <small class="d-block">нет выбранных автомобилей</small>
                @endif
            </div>
        </div>

        <h1>Обзор по марке</h1>

        <div class="row mb-4">
            @if (count($manufactures))
                @foreach ($manufactures as $manufacture)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 card-brand">
                        <a href="auto/{{ $manufacture->manuId }}" class="d-block">
                            <img src="{{ asset('assets/manufacturers/' . Str::slug($manufacture->manuName) . '.png') }}" alt=""><p>{{ $manufacture->manuName }}</p>
                        </a>
                    </div>
                @endforeach
            @else
                <small class="d-block">нет марок</small>
            @endif
        </div>

        <h2>Обзор по категориям</h2>

        <div class="row mb-4">
            @if (count($categories))
                @foreach ($categories as $category)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 card-brand">
                        <a href="#" class="d-block">
                            <p>{{ $category->shortCutName }} {{ $category->linkingTargetType }}</p>
                        </a>
                    </div>
                @endforeach
            @else
                <small class="d-block">нет категорий</small>
            @endif
        </div>

        <h2>Обзор по сборочным группам</h2>

        @if (count($assemblyGroups))
            <ul>
                @foreach ($assemblyGroups as $assemblyGroup)
                    @include('frontend.home.partials.assembly-group-child', $assemblyGroup)
                @endforeach
            </ul>
        @else
            нет сборочных групп
        @endif
    </div>
@endsection
