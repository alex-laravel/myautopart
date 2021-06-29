@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.vehicles.management'))

@section('header')
    <h1>
        <i class="fas fa-car"></i>
        {{ trans('labels.backend.vehicles.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4 class="d-inline-block">{{ trans('labels.backend.vehicles.list') }}</h4>

            <div class="float-right">
                @include('backend.tecdoc-vehicles.partials.header-buttons')
            </div>
        </div>

        <div class="card-body">
            <table id="tecdoc-vehicles-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>slug</th>
                    <th>manuId</th>
                    <th>modelId</th>
                    <th>carId</th>
                    <th>carName</th>
                    <th>carType</th>
                    <th>firstCountry</th>
                </tr>
                </thead>
            </table>

            <strong class="d-block">NOTES:</strong>
            <small>??? carType - P|O|L|POL</small><br>
            <small>??? countriesCarSelection</small><br>
            <small>??? countryGroupFlag</small><br>
            <small>??? favouredList</small><br>
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
                    url: '{{ route('backend.ajax.vehicles.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'td_vehicles.id'},
                    {data: 'slug', name: 'td_vehicles.slug'},
                    {data: 'manuId', name: 'td_vehicles.manuId'},
                    {data: 'modelId', name: 'td_vehicles.modelId'},
                    {data: 'carId', name: 'td_vehicles.carId'},
                    {data: 'carName', name: 'td_vehicles.carName'},
                    {data: 'carType', name: 'td_vehicles.carType'},
                    {data: 'firstCountry', name: 'td_vehicles.firstCountry'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
