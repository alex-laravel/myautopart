@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.vehicle-details.management'))

@section('header')
    <h1>
        <i class="fas fa-car"></i>
        {{ trans('labels.backend.vehicle-details.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4 class="d-inline-block">{{ trans('labels.backend.vehicle-details.list') }}</h4>

            <div class="float-right">
                @include('backend.tecdoc-vehicle-details.partials.header-buttons')
            </div>
        </div>

        <div class="card-body">
            <table id="tecdoc-vehicles-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>manuId</th>
                    <th>manuName</th>
                    <th>modId</th>
                    <th>modelName</th>
                    <th>carId</th>
                    <th>ccmTech</th>
                    <th>constructionType</th>
                    <th>cylinder</th>
                    <th>cylinderCapacityCcm</th>
                    <th>cylinderCapacityLiter</th>
                    <th>fuelType</th>
                    <th>fuelTypeProcess</th>
                    <th>impulsionType</th>
                </tr>
                </thead>
            </table>

            <strong class="d-block">NOTES:</strong>
            <small>??? country</small><br>
            <small>??? countryGroupFlag</small><br>
            <small>??? countriesCarSelection</small><br>
            <small>??? articleCountry</small><br>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('/js/backend.datatable.js') }}"></script>
    <script>
        $(function () {
            $('#tecdoc-vehicles-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    url: '{{ route('backend.ajax.vehicle-details.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'td_vehicle_details.id'},
                    {data: 'manuId', name: 'td_vehicle_details.manuId'},
                    {data: 'manuName', name: 'td_vehicle_details.manuName'},
                    {data: 'modId', name: 'td_vehicle_details.modId'},
                    {data: 'modelName', name: 'td_vehicle_details.modelName'},
                    {data: 'carId', name: 'td_vehicle_details.carId'},
                    {data: 'ccmTech', name: 'td_vehicle_details.ccmTech'},
                    {data: 'constructionType', name: 'td_vehicle_details.constructionType'},
                    {data: 'cylinder', name: 'td_vehicle_details.cylinder'},
                    {data: 'cylinderCapacityCcm', name: 'td_vehicle_details.cylinderCapacityCcm'},
                    {data: 'cylinderCapacityLiter', name: 'td_vehicle_details.cylinderCapacityLiter'},
                    {data: 'fuelType', name: 'td_vehicle_details.fuelType'},
                    {data: 'fuelTypeProcess', name: 'td_vehicle_details.fuelTypeProcess'},
                    {data: 'impulsionType', name: 'td_vehicle_details.impulsionType'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
