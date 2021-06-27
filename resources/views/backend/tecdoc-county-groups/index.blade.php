@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.country-groups.management'))

@section('header')
    <h1>
        <i class="fas fa-flag-usa"></i>
        {{ trans('labels.backend.country-groups.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4>{{ trans('labels.backend.country-groups.list') }}</h4>
        </div>

        <div class="card-body">
            <table id="tecdoc-country-groups-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>countryName</th>
                    <th>tecdocCode</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('/js/backend.datatable.js') }}"></script>
    <script>
        $(function () {
            $('#tecdoc-country-groups-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: '{{ route('backend.ajax.country-groups.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'td_country_groups.id'},
                    {data: 'countryName', name: 'td_country_groups.countryName'},
                    {data: 'tecdocCode', name: 'td_country_groups.tecdocCode'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
