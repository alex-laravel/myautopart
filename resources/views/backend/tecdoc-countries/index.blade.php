@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.countries.management'))

@section('header')
    <h1>
        <i class="far fa-flag"></i>
        {{ trans('labels.backend.countries.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4>{{ trans('labels.backend.countries.list') }}</h4>
        </div>

        <div class="card-body">
            <table id="tecdoc-countries-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>countryCode</th>
                    <th>countryName</th>
                    <th>usage</th>
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
            $('#tecdoc-countries-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: '{{ route('backend.ajax.countries.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'td_countries.id'},
                    {data: 'countryCode', name: 'td_countries.countryCode'},
                    {data: 'countryName', name: 'td_countries.countryName'},
                    {data: 'usage', name: 'td_countries.usage'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
